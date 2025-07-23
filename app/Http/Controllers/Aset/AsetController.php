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

        // Add search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_bidang_barang', 'like', "%{$search}%")
                    ->orWhere('nama_jenis_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%");
            });
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

        return view('asets.edit', compact(
            'aset', 
            'hierarchy', 
            'akuns', 
            'kelompoks', 
            'jenis', 
            'objeks', 
            'rincianObjeks', 
            'subRincianObjeks', 
            'subSubRincianObjeks'
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
                Rule::unique('asets')->ignore($aset->id)
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
                Rule::unique('asets')->ignore($aset->id)
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
    private function generateKodeBarang(int $subSubRincianObjekId): string
    {
        $subSubRincianObjek = SubSubRincianObjek::with([
            'subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
        ])->findOrFail($subSubRincianObjekId);

        $hierarchy = $this->extractHierarchyFromSubSubRincianObjek($subSubRincianObjek);

        // Get next sequence number for this sub_sub_rincian_objek
        $nextSequence = Aset::where('sub_sub_rincian_objek_id', $subSubRincianObjekId)
            ->max(DB::raw('CAST(SUBSTRING_INDEX(kode_barang, ".", -1) AS UNSIGNED)')) + 1;

        // Build kode barang
        return sprintf(
            '%s.%s.%s.%s.%s.%s.%s.%03d',
            $hierarchy['akun']->kode,
            $hierarchy['kelompok']->kode,
            $hierarchy['jenis']->kode,
            $hierarchy['objek']->kode,
            $hierarchy['rincianObjek']->kode,
            $hierarchy['subRincianObjek']->kode,
            $hierarchy['subSubRincianObjek']->kode,
            $nextSequence
        );
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
}