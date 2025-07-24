<?php

namespace App\Http\Controllers\Aset;

use App\Http\Controllers\Controller;
use App\Models\{Akun, Kelompok, Jenis, Objek, RincianObjek, SubRincianObjek, SubSubRincianObjek, Aset};
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Http\Response;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Aset::with([
            'subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
        ]);

        // Mesin pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_bidang_barang', 'like', "%{$search}%")
                    ->orWhere('nama_jenis_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%")
                    ->orWhere('register', 'like', "%{$search}%");
            });
        }

        // Filter tahun perolehan
        if ($request->filled('tahun_perolehan')) {
            $query->where('tahun_perolehan', $request->tahun_perolehan);
        }

        // Filter keadaan barang
        if ($request->filled('keadaan_barang')) {
            $query->where('keadaan_barang', $request->keadaan_barang);
        }

        $asets = $query->latest()->paginate(15);

        return view('asets.index', compact('asets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $akuns = Akun::orderBy('nama')->get();
        return view('asets.create', compact('akuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'akun_id' => 'required|exists:akuns,id',
            'kelompok_id' => 'required|exists:kelompoks,id',
            'jenis_id' => 'required|exists:jenis,id',
            'objek_id' => 'required|exists:objeks,id',
            'rincian_objek_id' => 'required|exists:rincian_objeks,id',
            'sub_rincian_objek_id' => 'required|exists:sub_rincian_objeks,id',
            'sub_sub_rincian_objek_id' => 'required|exists:sub_sub_rincian_objeks,id',
            'nama_bidang_barang' => 'required|string|max:255',
            'register' => 'required|string|max:255',
            'nama_jenis_barang' => 'required|string|max:255',
            'merk_type' => 'nullable|string|max:255',
            'no_sertifikat' => 'nullable|string|max:255',
            'no_plat_kendaraan' => 'nullable|string|max:255',
            'no_pabrik' => 'nullable|string|max:255',
            'no_casis' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'asal_perolehan' => 'required|string|max:255',
            'tahun_perolehan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'ukuran_barang_konstruksi' => 'nullable|string|max:255',
            'satuan' => 'required|string|max:100',
            'keadaan_barang' => ['required', Rule::in(['Baik', 'Kurang Baik', 'Rusak Berat'])],
            'jumlah_barang' => 'required|integer|min:1|max:100',
            'harga_satuan' => 'required|numeric|min:0',
            'bukti_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_berita' => 'nullable|mimes:pdf|max:10240',
            'kode_barang' => 'required|string',
        ]);

        try {
            return DB::transaction(function () use ($validated, $request) {
                // Handle file uploads
                $buktiBarangFileName = null;
                $buktiBeritaFileName = null;

                if ($request->hasFile('bukti_barang')) {
                    $buktiBarangFileName = 'bukti_barang_' . time() . '.' . $request->file('bukti_barang')->extension();
                    $request->file('bukti_barang')->storeAs('bukti_barang', $buktiBarangFileName, 'public');
                }

                if ($request->hasFile('bukti_berita')) {
                    $buktiBeritaFileName = 'bukti_berita_' . time() . '.' . $request->file('bukti_berita')->extension();
                    $request->file('bukti_berita')->storeAs('bukti_berita', $buktiBeritaFileName, 'public');
                }

                // Prepare base data (data yang sama untuk semua item)
                $baseData = [
                    'sub_sub_rincian_objek_id' => $validated['sub_sub_rincian_objek_id'],
                    'nama_bidang_barang' => $validated['nama_bidang_barang'],
                    'nama_jenis_barang' => $validated['nama_jenis_barang'],
                    'merk_type' => $validated['merk_type'],
                    'no_sertifikat' => $validated['no_sertifikat'],
                    'no_plat_kendaraan' => $validated['no_plat_kendaraan'],
                    'no_pabrik' => $validated['no_pabrik'],
                    'no_casis' => $validated['no_casis'],
                    'bahan' => $validated['bahan'],
                    'asal_perolehan' => $validated['asal_perolehan'],
                    'tahun_perolehan' => $validated['tahun_perolehan'],
                    'ukuran_barang_konstruksi' => $validated['ukuran_barang_konstruksi'],
                    'satuan' => $validated['satuan'],
                    'keadaan_barang' => $validated['keadaan_barang'],
                    'jumlah_barang' => 1, // Setiap record individual memiliki jumlah 1
                    'harga_satuan' => $validated['harga_satuan'],
                ];

                $jumlahBarang = (int)$validated['jumlah_barang'];
                $baseRegister = $validated['register'];
                $baseKodeBarang = $validated['kode_barang'];
                $createdAssets = [];

                // Buat multiple assets berdasarkan jumlah_barang
                for ($i = 1; $i <= $jumlahBarang; $i++) {
                    $assetData = $baseData;
                    $sequence = str_pad($i, 3, '0', STR_PAD_LEFT); // 001, 002, 003, dst

                    // Generate register berurutan
                    $assetData['register'] = $this->generateSequentialIdentifier($baseRegister, $sequence);

                    // Kode barang TETAP SAMA untuk semua asset
                    $assetData['kode_barang'] = $baseKodeBarang;

                    // SEMUA asset mendapat file attachment
                    $assetData['bukti_barang'] = $buktiBarangFileName;
                    $assetData['bukti_berita'] = $buktiBeritaFileName;

                    $createdAsset = Aset::create($assetData);
                    $createdAssets[] = $createdAsset->register; // Ubah ke register untuk pesan
                }

                $message = $jumlahBarang > 1
                    ? "Berhasil menambahkan {$jumlahBarang} aset. Register: " . implode(', ', array_slice($createdAssets, 0, 3)) .
                    ($jumlahBarang > 3 ? ' dan ' . ($jumlahBarang - 3) . ' lainnya' : '')
                    : "Aset berhasil ditambahkan dengan register: {$createdAssets[0]}";

                return redirect()->route('asets.index')->with('success', $message);
            });
        } catch (\Exception $e) {
            Log::error('Error creating aset: ' . $e->getMessage(), [
                'request' => $validated,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset): View
    {
        $aset->load(['subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun']);
        return view('asets.show', compact('aset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aset $aset): View
    {
        // Load semua relasi terlebih dahulu
        $aset->load(['subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun']);

        // Extract hierarchy untuk form
        $hierarchy = $this->extractHierarchy($aset);

        // Get all dropdown data based on current selections
        $akuns = Akun::orderBy('nama')->get();
        $kelompoks = Kelompok::where('akun_id', $hierarchy['akun']->id)->orderBy('nama')->get();
        $jenis = Jenis::where('kelompok_id', $hierarchy['kelompok']->id)->orderBy('nama')->get();
        $objeks = Objek::where('jenis_id', $hierarchy['jenis']->id)->orderBy('nama')->get();
        $rincianObjeks = RincianObjek::where('objek_id', $hierarchy['objek']->id)->orderBy('nama')->get();
        $subRincianObjeks = SubRincianObjek::where('rincian_objek_id', $hierarchy['rincianObjek']->id)->orderBy('nama')->get();
        $subSubRincianObjeks = SubSubRincianObjek::where('sub_rincian_objek_id', $hierarchy['subRincianObjek']->id)->orderBy('nama_barang')->get();

        // Tambahkan selected values untuk memudahkan pre-populate form
        $selectedValues = [
            'akun_id' => $hierarchy['akun']->id,
            'kelompok_id' => $hierarchy['kelompok']->id,
            'jenis_id' => $hierarchy['jenis']->id,
            'objek_id' => $hierarchy['objek']->id,
            'rincian_objek_id' => $hierarchy['rincianObjek']->id,
            'sub_rincian_objek_id' => $hierarchy['subRincianObjek']->id,
            'sub_sub_rincian_objek_id' => $hierarchy['subSubRincianObjek']->id,
        ];

        return view('asets.edit', compact(
            'aset',
            'hierarchy',
            'akuns',
            'kelompoks',
            'jenis',
            'objeks',
            'rincianObjeks',
            'subRincianObjeks',
            'subSubRincianObjeks',
            'selectedValues'
        ));
    }
    
    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset): RedirectResponse
    {
        Log::info('Update request received', [
            'aset_id' => $aset->id,
            'request_data' => $request->except(['bukti_barang', 'bukti_berita'])
        ]);

        $validated = $request->validate([
            'akun_id' => 'required|exists:akuns,id',
            'kelompok_id' => 'required|exists:kelompoks,id',
            'jenis_id' => 'required|exists:jenis,id',
            'objek_id' => 'required|exists:objeks,id',
            'rincian_objek_id' => 'required|exists:rincian_objeks,id',
            'sub_rincian_objek_id' => 'required|exists:sub_rincian_objeks,id',
            'sub_sub_rincian_objek_id' => 'required|exists:sub_sub_rincian_objeks,id',
            'nama_bidang_barang' => 'required|string|max:255',
            'register' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($aset) {
                    if ($value !== $aset->register && Aset::where('register', $value)->exists()) {
                        $fail('Register sudah digunakan.');
                    }
                }
            ],
            'nama_jenis_barang' => 'required|string|max:255',
            'merk_type' => 'nullable|string|max:255',
            'no_sertifikat' => 'nullable|string|max:255',
            'no_plat_kendaraan' => 'nullable|string|max:255',
            'no_pabrik' => 'nullable|string|max:255',
            'no_casis' => 'nullable|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'asal_perolehan' => 'required|string|max:255',
            'tahun_perolehan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'ukuran_barang_konstruksi' => 'nullable|string|max:255',
            'satuan' => 'required|string|max:100',
            'keadaan_barang' => ['required', Rule::in(['Baik', 'Kurang Baik', 'Rusak Berat'])],
            'jumlah_barang' => 'required|integer|min:1|max:100',
            'harga_satuan' => 'required|numeric|min:0',
            'bukti_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_berita' => 'nullable|mimes:pdf|max:10240',
            'kode_barang' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($aset) {
                    if ($value !== $aset->kode_barang && Aset::where('kode_barang', $value)->exists()) {
                        $fail('Kode barang sudah digunakan.');
                    }
                }
            ],
        ], [
            'akun_id.required' => 'Akun harus dipilih',
            'kelompok_id.required' => 'Kelompok harus dipilih',
            'jenis_id.required' => 'Jenis harus dipilih',
            'objek_id.required' => 'Objek harus dipilih',
            'rincian_objek_id.required' => 'Rincian objek harus dipilih',
            'sub_rincian_objek_id.required' => 'Sub rincian objek harus dipilih',
            'sub_sub_rincian_objek_id.required' => 'Sub sub rincian objek harus dipilih',
            'register.unique' => 'Register sudah digunakan',
            'kode_barang.unique' => 'Kode barang sudah digunakan',
            'tahun_perolehan.digits' => 'Tahun perolehan harus 4 digit',
            'tahun_perolehan.max' => 'Tahun perolehan tidak boleh melebihi tahun sekarang',
            'jumlah_barang.max' => 'Jumlah barang maksimal 100',
            'bukti_barang.max' => 'Ukuran file gambar maksimal 2MB',
            'bukti_berita.max' => 'Ukuran file PDF maksimal 10MB',
        ]);

        Log::info('Validation passed', ['validated_data' => array_keys($validated)]);

        try {
            return DB::transaction(function () use ($validated, $request, $aset) {
                $fileUpdates = [];

                // Handle bukti_barang upload
                if ($request->hasFile('bukti_barang')) {
                    $file = $request->file('bukti_barang');
                    if ($file->isValid()) {
                        // Delete old file if exists
                        if ($aset->bukti_barang && Storage::disk('public')->exists('bukti_barang/' . $aset->bukti_barang)) {
                            Storage::disk('public')->delete('bukti_barang/' . $aset->bukti_barang);
                            Log::info('Old bukti_barang deleted', ['filename' => $aset->bukti_barang]);
                        }

                        $fileName = 'bukti_barang_' . $aset->id . '_' . time() . '.' . $file->extension();
                        $file->storeAs('bukti_barang', $fileName, 'public');
                        $fileUpdates['bukti_barang'] = $fileName;
                        Log::info('Bukti barang uploaded', ['filename' => $fileName]);
                    } else {
                        Log::error('Invalid bukti_barang file');
                        throw new \Exception('File bukti barang tidak valid');
                    }
                }

                // Handle bukti_berita upload
                if ($request->hasFile('bukti_berita')) {
                    $file = $request->file('bukti_berita');
                    if ($file->isValid()) {
                        // Delete old file if exists
                        if ($aset->bukti_berita && Storage::disk('public')->exists('bukti_berita/' . $aset->bukti_berita)) {
                            Storage::disk('public')->delete('bukti_berita/' . $aset->bukti_berita);
                            Log::info('Old bukti_berita deleted', ['filename' => $aset->bukti_berita]);
                        }

                        $fileName = 'bukti_berita_' . $aset->id . '_' . time() . '.' . $file->extension();
                        $file->storeAs('bukti_berita', $fileName, 'public');
                        $fileUpdates['bukti_berita'] = $fileName;
                        Log::info('Bukti berita uploaded', ['filename' => $fileName]);
                    } else {
                        Log::error('Invalid bukti_berita file');
                        throw new \Exception('File bukti berita tidak valid');
                    }
                }

                // Prepare update data
                $updateData = [
                    'sub_sub_rincian_objek_id' => $validated['sub_sub_rincian_objek_id'],
                    'nama_bidang_barang' => $validated['nama_bidang_barang'],
                    'register' => $validated['register'],
                    'kode_barang' => $validated['kode_barang'],
                    'nama_jenis_barang' => $validated['nama_jenis_barang'],
                    'merk_type' => $validated['merk_type'],
                    'no_sertifikat' => $validated['no_sertifikat'],
                    'no_plat_kendaraan' => $validated['no_plat_kendaraan'],
                    'no_pabrik' => $validated['no_pabrik'],
                    'no_casis' => $validated['no_casis'],
                    'bahan' => $validated['bahan'],
                    'asal_perolehan' => $validated['asal_perolehan'],
                    'tahun_perolehan' => $validated['tahun_perolehan'],
                    'ukuran_barang_konstruksi' => $validated['ukuran_barang_konstruksi'],
                    'satuan' => $validated['satuan'],
                    'keadaan_barang' => $validated['keadaan_barang'],
                    'jumlah_barang' => $validated['jumlah_barang'],
                    'harga_satuan' => $validated['harga_satuan'],
                ];

                // Merge file updates
                $updateData = array_merge($updateData, $fileUpdates);

                // Log data before update
                Log::info('Attempting to update asset', ['aset_id' => $aset->id, 'update_data' => $updateData]);

                // Update the asset
                $updated = $aset->update($updateData);

                // Check if update was successful
                if (!$updated) {
                    Log::error('Failed to update asset', ['aset_id' => $aset->id]);
                    throw new \Exception('Gagal mengupdate data aset');
                }

                Log::info('Asset updated successfully', ['aset_id' => $aset->id]);

                return redirect()->route('asets.index')
                    ->with('success', 'Aset berhasil diperbarui');
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in update', [
                'aset_id' => $aset->id,
                'errors' => $e->errors()
            ]);

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating aset', [
                'aset_id' => $aset->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data aset: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset): RedirectResponse
    {
        try {
            // Delete associated files
            if ($aset->bukti_barang) {
                Storage::disk('public')->delete('bukti_barang/' . $aset->bukti_barang);
            }
            if ($aset->bukti_berita) {
                Storage::disk('public')->delete('bukti_berita/' . $aset->bukti_berita);
            }

            $aset->delete();

            return redirect()->route('asets.index')
                ->with('success', 'Aset berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting aset: ' . $e->getMessage(), [
                'aset_id' => $aset->id,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus aset.');
        }
    }

    private function generateSequentialIdentifier($base, $sequence, $isKodeBarang = false)
    {
        if ($isKodeBarang) {
            // Untuk kode_barang, tambahkan sequence di akhir dengan separator
            return $base . '.' . $sequence;
        } else {
            // Untuk register, pastikan format 3 digit berurutan
            // Hapus suffix angka jika ada, lalu tambahkan sequence baru
            $cleanBase = preg_replace('/\d+$/', '', $base);
            return $cleanBase . $sequence;
        }
    }

    private function cleanRegisterNumber(string $register): string
    {
        // Hapus suffix angka 3 digit jika ada
        return preg_replace('/\d{3}$/', '', $register);
    }

    /**
     * Generate unique kode barang with sequence
     */
    private function generateUniqueRegister($baseRegister, $sequence)
    {
        $newRegister = $this->generateSequentialIdentifier($baseRegister, $sequence);

        // Cek apakah register sudah ada
        while (Aset::where('register', $newRegister)->exists()) {
            // Jika sudah ada, increment sequence
            $sequenceNum = (int)$sequence + 1;
            $sequence = str_pad($sequenceNum, 3, '0', STR_PAD_LEFT);
            $newRegister = $this->generateSequentialIdentifier($baseRegister, $sequence);
        }

        return $newRegister;
    }


    /**
     * Get asset hierarchy data for AJAX calls (used in edit form)
     */
    public function getAssetHierarchy(Aset $aset): JsonResponse
    {
        try {
            $hierarchy = $this->extractHierarchy($aset);

            return response()->json([
                'success' => true,
                'data' => [
                    'akun' => [
                        'id' => $hierarchy['akun']->id,
                        'nama' => $hierarchy['akun']->nama,
                        'kode' => $hierarchy['akun']->kode
                    ],
                    'kelompok' => [
                        'id' => $hierarchy['kelompok']->id,
                        'nama' => $hierarchy['kelompok']->nama,
                        'kode' => $hierarchy['kelompok']->kode
                    ],
                    'jenis' => [
                        'id' => $hierarchy['jenis']->id,
                        'nama' => $hierarchy['jenis']->nama,
                        'kode' => $hierarchy['jenis']->kode
                    ],
                    'objek' => [
                        'id' => $hierarchy['objek']->id,
                        'nama' => $hierarchy['objek']->nama,
                        'kode' => $hierarchy['objek']->kode
                    ],
                    'rincianObjek' => [
                        'id' => $hierarchy['rincianObjek']->id,
                        'nama' => $hierarchy['rincianObjek']->nama,
                        'kode' => $hierarchy['rincianObjek']->kode
                    ],
                    'subRincianObjek' => [
                        'id' => $hierarchy['subRincianObjek']->id,
                        'nama' => $hierarchy['subRincianObjek']->nama,
                        'kode' => $hierarchy['subRincianObjek']->kode
                    ],
                    'subSubRincianObjek' => [
                        'id' => $hierarchy['subSubRincianObjek']->id,
                        'nama_barang' => $hierarchy['subSubRincianObjek']->nama_barang,
                        'kode' => $hierarchy['subSubRincianObjek']->kode
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting asset hierarchy: ' . $e->getMessage(), ['aset_id' => $aset->id]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil hierarki data aset.'
            ], 500);
        }
    }

    /**
     * Get complete dropdown data for create/edit forms
     */
    public function getCompleteDropdownData(Request $request): JsonResponse
    {
        try {
            $data = [];

            // Always get akuns
            $data['akuns'] = Akun::orderBy('nama')->get(['id', 'nama', 'kode']);

            // Get kelompoks if akun_id provided
            if ($request->filled('akun_id')) {
                $data['kelompoks'] = Kelompok::where('akun_id', $request->akun_id)
                    ->orderBy('nama')->get(['id', 'nama', 'kode']);
            }

            // Get jenis if kelompok_id provided
            if ($request->filled('kelompok_id')) {
                $data['jenis'] = Jenis::where('kelompok_id', $request->kelompok_id)
                    ->orderBy('nama')->get(['id', 'nama', 'kode']);
            }

            // Get objeks if jenis_id provided
            if ($request->filled('jenis_id')) {
                $data['objeks'] = Objek::where('jenis_id', $request->jenis_id)
                    ->orderBy('nama')->get(['id', 'nama', 'kode']);
            }

            // Get rincian objeks if objek_id provided
            if ($request->filled('objek_id')) {
                $data['rincianObjeks'] = RincianObjek::where('objek_id', $request->objek_id)
                    ->orderBy('nama')->get(['id', 'nama', 'kode']);
            }

            // Get sub rincian objeks if rincian_objek_id provided
            if ($request->filled('rincian_objek_id')) {
                $data['subRincianObjeks'] = SubRincianObjek::where('rincian_objek_id', $request->rincian_objek_id)
                    ->orderBy('nama')->get(['id', 'nama', 'kode']);
            }

            // Get sub sub rincian objeks if sub_rincian_objek_id provided
            if ($request->filled('sub_rincian_objek_id')) {
                $data['subSubRincianObjeks'] = SubSubRincianObjek::where('sub_rincian_objek_id', $request->sub_rincian_objek_id)
                    ->orderBy('nama_barang')->get(['id', 'nama_barang', 'kode']);
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting complete dropdown data: ' . $e->getMessage(), [
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data dropdown.'
            ], 500);
        }
    }

    // ===================================
    // DROPDOWN API METHODS
    // ===================================

    /**
     * Get kelompoks by akun_id
     */
    public function getKelompoks(int $akunId): JsonResponse
    {
        try {
            $kelompoks = Kelompok::where('akun_id', $akunId)
                ->orderBy('nama')
                ->get(['id', 'nama', 'kode']);

            return response()->json([
                'success' => true,
                'data' => $kelompoks
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting kelompoks: ' . $e->getMessage(), ['akun_id' => $akunId]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kelompok.'
            ], 500);
        }
    }

    /**
     * Get jenis by kelompok_id
     */
    public function getJenis(int $kelompokId): JsonResponse
    {
        try {
            $jenis = Jenis::where('kelompok_id', $kelompokId)
                ->orderBy('nama')
                ->get(['id', 'nama', 'kode']);

            return response()->json([
                'success' => true,
                'data' => $jenis
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting jenis: ' . $e->getMessage(), ['kelompok_id' => $kelompokId]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data jenis.'
            ], 500);
        }
    }

    /**
     * Get objeks by jenis_id
     */
    public function getObjeks(int $jenisId): JsonResponse
    {
        try {
            $objeks = Objek::where('jenis_id', $jenisId)
                ->orderBy('nama')
                ->get(['id', 'nama', 'kode']);

            return response()->json([
                'success' => true,
                'data' => $objeks
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting objeks: ' . $e->getMessage(), ['jenis_id' => $jenisId]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data objek.'
            ], 500);
        }
    }

    /**
     * Get rincian objeks by objek_id
     */
    public function getRincianObjeks(int $objekId): JsonResponse
    {
        try {
            $rincianObjeks = RincianObjek::where('objek_id', $objekId)
                ->orderBy('nama')
                ->get(['id', 'nama', 'kode']);

            return response()->json([
                'success' => true,
                'data' => $rincianObjeks
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting rincian objeks: ' . $e->getMessage(), ['objek_id' => $objekId]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data rincian objek.'
            ], 500);
        }
    }

    /**
     * Get sub rincian objeks by rincian_objek_id
     */
    public function getSubRincianObjeks(int $rincianObjekId): JsonResponse
    {
        try {
            $subRincianObjeks = SubRincianObjek::where('rincian_objek_id', $rincianObjekId)
                ->orderBy('nama')
                ->get(['id', 'nama', 'kode']);

            return response()->json([
                'success' => true,
                'data' => $subRincianObjeks
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting sub rincian objeks: ' . $e->getMessage(), ['rincian_objek_id' => $rincianObjekId]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data sub rincian objek.'
            ], 500);
        }
    }

    /**
     * Get sub sub rincian objeks by sub_rincian_objek_id
     */
    public function getSubSubRincianObjeks(int $subRincianObjekId): JsonResponse
    {
        try {
            $subSubRincianObjeks = SubSubRincianObjek::where('sub_rincian_objek_id', $subRincianObjekId)
                ->orderBy('nama_barang')
                ->get(['id', 'nama_barang', 'kode']);

            return response()->json([
                'success' => true,
                'data' => $subSubRincianObjeks
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting sub sub rincian objeks: ' . $e->getMessage(), ['sub_rincian_objek_id' => $subRincianObjekId]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data sub sub rincian objek.'
            ], 500);
        }
    }

    /**
     * Generate kode barang preview for AJAX
     */
    public function generateKodeBarangPreview(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'sub_sub_rincian_objek_id' => 'required|exists:sub_sub_rincian_objeks,id'
            ]);

            $kodeBarang = $this->generateKodeBarang($request->sub_sub_rincian_objek_id);

            return response()->json([
                'success' => true,
                'kode_barang' => $kodeBarang
            ]);
        } catch (\Exception $e) {
            Log::error('Error generating kode barang preview: ' . $e->getMessage(), [
                'sub_sub_rincian_objek_id' => $request->input('sub_sub_rincian_objek_id')
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal generate kode barang: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===================================
    // PRIVATE HELPER METHODS
    // ===================================

    /**
     * Generate kode barang otomatis berdasarkan hierarki
     * Format: 1.2.5.01.05.01.01.001
     */
    /**
     * Generate kode barang automatically based on hierarchy
     */
    public function generateKodeBarang(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'akun_id' => 'required|exists:akuns,id',
                'kelompok_id' => 'required|exists:kelompoks,id',
                'jenis_id' => 'required|exists:jenis,id',
                'objek_id' => 'required|exists:objeks,id',
                'rincian_objek_id' => 'required|exists:rincian_objeks,id',
                'sub_rincian_objek_id' => 'required|exists:sub_rincian_objeks,id',
                'sub_sub_rincian_objek_id' => 'required|exists:sub_sub_rincian_objeks,id',
            ]);

            // Load all hierarchy data
            $akun = Akun::find($request->akun_id);
            $kelompok = Kelompok::find($request->kelompok_id);
            $jenis = Jenis::find($request->jenis_id);
            $objek = Objek::find($request->objek_id);
            $rincianObjek = RincianObjek::find($request->rincian_objek_id);
            $subRincianObjek = SubRincianObjek::find($request->sub_rincian_objek_id);
            $subSubRincianObjek = SubSubRincianObjek::find($request->sub_sub_rincian_objek_id);

            // Generate kode barang: AKUN.KELOMPOK.JENIS.OBJEK.RINCIAN.SUBRINCIAN.SUBSUBRINCIAN
            $kodeBarang = implode('.', [
                $akun->kode,
                $kelompok->kode,
                $jenis->kode,
                $objek->kode,
                $rincianObjek->kode,
                $subRincianObjek->kode,
                $subSubRincianObjek->kode
            ]);

            // Check if kode already exists, if yes add sequence number
            $originalKode = $kodeBarang;
            $sequence = 1;
            while (Aset::where('kode_barang', $kodeBarang)->exists()) {
                $kodeBarang = $originalKode . '.' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
                $sequence++;
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'kode_barang' => $kodeBarang,
                    'hierarchy_info' => [
                        'akun' => $akun->nama,
                        'kelompok' => $kelompok->nama,
                        'jenis' => $jenis->nama,
                        'objek' => $objek->nama,
                        'rincian_objek' => $rincianObjek->nama,
                        'sub_rincian_objek' => $subRincianObjek->nama,
                        'sub_sub_rincian_objek' => $subSubRincianObjek->nama_barang
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error generating kode barang: ' . $e->getMessage(), [
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat generate kode barang.'
            ], 500);
        }
    }

    /**
     * Check if kode barang is unique (for validation)
     */
    public function checkKodeBarangUnique(Request $request): JsonResponse
    {
        try {
            $kodeBarang = $request->get('kode_barang');
            $excludeId = $request->get('exclude_id'); // For edit form

            if (!$kodeBarang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode barang harus diisi.'
                ]);
            }

            $query = Aset::where('kode_barang', $kodeBarang);

            // Exclude current record if editing
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            $exists = $query->exists();

            return response()->json([
                'success' => true,
                'data' => [
                    'is_unique' => !$exists,
                    'exists' => $exists,
                    'message' => $exists ? 'Kode barang sudah digunakan.' : 'Kode barang tersedia.'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error checking kode barang uniqueness: ' . $e->getMessage(), [
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat validasi kode barang.'
            ], 500);
        }
    }

    /**
     * Check if register is unique (for validation)
     */
    public function checkRegisterUnique(Request $request): JsonResponse
    {
        try {
            $register = $request->get('register');
            $excludeId = $request->get('exclude_id'); // For edit form

            if (!$register) {
                return response()->json([
                    'success' => false,
                    'message' => 'Register harus diisi.'
                ]);
            }

            $query = Aset::where('register', $register);

            // Exclude current record if editing
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            $exists = $query->exists();

            return response()->json([
                'success' => true,
                'data' => [
                    'is_unique' => !$exists,
                    'exists' => $exists,
                    'message' => $exists ? 'Register sudah digunakan.' : 'Register tersedia.'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error checking register uniqueness: ' . $e->getMessage(), [
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat validasi register.'
            ], 500);
        }
    }

    /**
     * Extract hierarchy from aset for editing
     */
    private function extractHierarchy(Aset $aset): array
    {
        return $this->extractHierarchyFromSubSubRincianObjek($aset->subSubRincianObjek);
    }

    /**
     * Extract hierarchy from SubSubRincianObjek
     */
    private function extractHierarchyFromSubSubRincianObjek(SubSubRincianObjek $subSubRincianObjek): array
    {
        return [
            'akun' => $subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis->kelompok->akun,
            'kelompok' => $subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis->kelompok,
            'jenis' => $subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis,
            'objek' => $subSubRincianObjek->subRincianObjek->rincianObjek->objek,
            'rincianObjek' => $subSubRincianObjek->subRincianObjek->rincianObjek,
            'subRincianObjek' => $subSubRincianObjek->subRincianObjek,
            'subSubRincianObjek' => $subSubRincianObjek,
        ];
    }

    /**
     * Download PDF report for specific asset
     */
    public function downloadPdf(int $id)
    {
        try {
            // Get asset with all related data
            $aset = Aset::with([
                'subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
            ])->findOrFail($id);

            // Generate PDF with asset information and image
            $pdf = $this->generateAssetInfoPdf($aset);
            $pdfContent = $pdf->output();

            // If there's bukti_berita PDF, merge it
            if ($aset->bukti_berita && Storage::disk('public')->exists('bukti_berita/' . $aset->bukti_berita)) {
                $buktiBeritaPath = storage_path('app/public/bukti_berita/' . $aset->bukti_berita);
                $pdfContent = $this->mergePdfFiles($pdfContent, $buktiBeritaPath);
            }

            $fileName = 'aset_' . $aset->register . '_' . date('Y-m-d_H-i-s') . '.pdf';

            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            Log::error('Error generating PDF for asset: ' . $e->getMessage(), [
                'asset_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengunduh PDF: ' . $e->getMessage());
        }
    }

    /**
     * Generate PDF with asset information and image
     */
    private function generateAssetInfoPdf(Aset $aset): \Barryvdh\DomPDF\PDF
    {
        // Check if bukti_barang image exists
        $imagePath = null;
        $imageBase64 = null;

        if ($aset->bukti_barang && Storage::disk('public')->exists('bukti_barang/' . $aset->bukti_barang)) {
            $imagePath = storage_path('app/public/bukti_barang/' . $aset->bukti_barang);

            // Convert image to base64 for PDF
            if (file_exists($imagePath)) {
                $imageData = file_get_contents($imagePath);
                $imageBase64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
            }
        }

        // Extract hierarchy for display
        $hierarchy = $this->extractHierarchy($aset);

        $data = [
            'aset' => $aset,
            'hierarchy' => $hierarchy,
            'imageBase64' => $imageBase64,
            'generatedAt' => now()->format('d F Y H:i:s')
        ];

        // Generate PDF using view template
        $pdf = Pdf::loadView('asets.pdf', $data);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        return $pdf;
    }

    /**
     * Merge two PDF files using FPDI
     */
    private function mergePdfFiles(string $mainPdfContent, string $buktiBeritaPath): string
    {
        try {
            $fpdi = new Fpdi();

            // Add pages from main PDF (asset info)
            $tempMainFile = tempnam(sys_get_temp_dir(), 'main_pdf_');
            file_put_contents($tempMainFile, $mainPdfContent);

            $pageCount = $fpdi->setSourceFile($tempMainFile);
            for ($pageNum = 1; $pageNum <= $pageCount; $pageNum++) {
                $tpl = $fpdi->importPage($pageNum);
                $fpdi->AddPage();
                $fpdi->useTemplate($tpl);
            }

            // Add pages from bukti_berita PDF
            if (file_exists($buktiBeritaPath)) {
                $pageCount = $fpdi->setSourceFile($buktiBeritaPath);
                for ($pageNum = 1; $pageNum <= $pageCount; $pageNum++) {
                    $tpl = $fpdi->importPage($pageNum);
                    $fpdi->AddPage();
                    $fpdi->useTemplate($tpl);
                }
            }

            // Clean up temp file
            unlink($tempMainFile);

            return $fpdi->Output('', 'S'); // Return as string

        } catch (\Exception $e) {
            Log::warning('Failed to merge PDF files, returning main PDF only: ' . $e->getMessage());
            return $mainPdfContent; // Return main PDF if merge fails
        }
    }
}