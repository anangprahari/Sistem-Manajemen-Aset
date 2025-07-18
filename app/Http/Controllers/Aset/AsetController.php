<?php

namespace App\Http\Controllers\Aset;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Kelompok;
use App\Models\Jenis;
use App\Models\Objek;
use App\Models\RincianObjek;
use App\Models\SubRincianObjek;
use App\Models\SubSubRincianObjek;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $asets = Aset::with([
            'subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
        ])->paginate(10);

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
        $validator = Validator::make($request->all(), [
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
            'ukuran_barang_konstruksi' => 'nullable|string|max:255',
            'satuan' => 'required|string|max:255',
            'keadaan_barang' => 'required|in:Baik,Kurang Baik,Rusak Berat',
            'jumlah_barang' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'bukti_barang' => 'nullable|string|max:255',
            'bukti_berita' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Generate kode barang otomatis
            $kodeBarang = $this->generateKodeBarang($request->sub_sub_rincian_objek_id);

            $aset = Aset::create([
                'sub_sub_rincian_objek_id' => $request->sub_sub_rincian_objek_id,
                'kode_barang' => $kodeBarang,
                'nama_bidang_barang' => $request->nama_bidang_barang,
                'register' => $request->register,
                'nama_jenis_barang' => $request->nama_jenis_barang,
                'merk_type' => $request->merk_type,
                'no_sertifikat' => $request->no_sertifikat,
                'no_plat_kendaraan' => $request->no_plat_kendaraan,
                'no_pabrik' => $request->no_pabrik,
                'no_casis' => $request->no_casis,
                'bahan' => $request->bahan,
                'asal_perolehan' => $request->asal_perolehan,
                'ukuran_barang_konstruksi' => $request->ukuran_barang_konstruksi,
                'satuan' => $request->satuan,
                'keadaan_barang' => $request->keadaan_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_satuan' => $request->harga_satuan,
                'bukti_barang' => $request->bukti_barang,
                'bukti_berita' => $request->bukti_berita,
            ]);

            DB::commit();

            return redirect()->route('asets.index')
                ->with('success', 'Aset berhasil ditambahkan dengan kode: ' . $kodeBarang);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating aset: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data aset.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset): View
    {
        $aset->load([
            'subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
        ]);

        return view('asets.show', compact('aset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aset $aset): View
    {
        $aset->load([
            'subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
        ]);

        $akuns = Akun::orderBy('nama')->get();

        // Load related data for editing
        $selectedAkun = $aset->subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis->kelompok->akun;
        $selectedKelompok = $aset->subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis->kelompok;
        $selectedJenis = $aset->subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis;
        $selectedObjek = $aset->subSubRincianObjek->subRincianObjek->rincianObjek->objek;
        $selectedRincianObjek = $aset->subSubRincianObjek->subRincianObjek->rincianObjek;
        $selectedSubRincianObjek = $aset->subSubRincianObjek->subRincianObjek;
        $selectedSubSubRincianObjek = $aset->subSubRincianObjek;

        return view('asets.edit', compact(
            'aset',
            'akuns',
            'selectedAkun',
            'selectedKelompok',
            'selectedJenis',
            'selectedObjek',
            'selectedRincianObjek',
            'selectedSubRincianObjek',
            'selectedSubSubRincianObjek'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
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
            'ukuran_barang_konstruksi' => 'nullable|string|max:255',
            'satuan' => 'required|string|max:255',
            'keadaan_barang' => 'required|in:Baik,Kurang Baik,Rusak Berat',
            'jumlah_barang' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'bukti_barang' => 'nullable|string|max:255',
            'bukti_berita' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Check if sub_sub_rincian_objek_id changed, regenerate kode if needed
            $kodeBarang = $aset->kode_barang;
            if ($aset->sub_sub_rincian_objek_id != $request->sub_sub_rincian_objek_id) {
                $kodeBarang = $this->generateKodeBarang($request->sub_sub_rincian_objek_id);
            }

            $aset->update([
                'sub_sub_rincian_objek_id' => $request->sub_sub_rincian_objek_id,
                'kode_barang' => $kodeBarang,
                'nama_bidang_barang' => $request->nama_bidang_barang,
                'register' => $request->register,
                'nama_jenis_barang' => $request->nama_jenis_barang,
                'merk_type' => $request->merk_type,
                'no_sertifikat' => $request->no_sertifikat,
                'no_plat_kendaraan' => $request->no_plat_kendaraan,
                'no_pabrik' => $request->no_pabrik,
                'no_casis' => $request->no_casis,
                'bahan' => $request->bahan,
                'asal_perolehan' => $request->asal_perolehan,
                'ukuran_barang_konstruksi' => $request->ukuran_barang_konstruksi,
                'satuan' => $request->satuan,
                'keadaan_barang' => $request->keadaan_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_satuan' => $request->harga_satuan,
                'bukti_barang' => $request->bukti_barang,
                'bukti_berita' => $request->bukti_berita,
            ]);

            DB::commit();

            return redirect()->route('asets.index')
                ->with('success', 'Aset berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating aset: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data aset.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset): RedirectResponse
    {
        try {
            $aset->delete();
            return redirect()->route('asets.index')
                ->with('success', 'Aset berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting aset: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data aset.');
        }
    }

    // ===================================
    // DROPDOWN API METHODS
    // ===================================

    /**
     * Get kelompoks by akun_id
     */
    public function getKelompoks($akunId): JsonResponse
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
            Log::error('Error getting kelompoks: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kelompok.'
            ], 500);
        }
    }

    /**
     * Get jenis by kelompok_id
     */
    public function getJenis($kelompokId): JsonResponse
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
            Log::error('Error getting jenis: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data jenis.'
            ], 500);
        }
    }

    /**
     * Get objeks by jenis_id
     */
    public function getObjeks($jenisId): JsonResponse
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
            Log::error('Error getting objeks: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data objek.'
            ], 500);
        }
    }

    /**
     * Get rincian objeks by objek_id
     */
    public function getRincianObjeks($objekId): JsonResponse
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
            Log::error('Error getting rincian objeks: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data rincian objek.'
            ], 500);
        }
    }

    /**
     * Get sub rincian objeks by rincian_objek_id
     */
    public function getSubRincianObjeks($rincianObjekId): JsonResponse
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
            Log::error('Error getting sub rincian objeks: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data sub rincian objek.'
            ], 500);
        }
    }

    /**
     * Get sub sub rincian objeks by sub_rincian_objek_id
     */
    public function getSubSubRincianObjeks($subRincianObjekId): JsonResponse
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
            Log::error('Error getting sub sub rincian objeks: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data sub sub rincian objek.'
            ], 500);
        }
    }

    /**
     * Generate kode barang otomatis berdasarkan hierarki
     * Format: 1.2.5.01.05.01.01.001
     */
    private function generateKodeBarang($subSubRincianObjekId): string
    {
        try {
            // Get hierarchy data
            $subSubRincianObjek = SubSubRincianObjek::with([
                'subRincianObjek.rincianObjek.objek.jenis.kelompok.akun'
            ])->findOrFail($subSubRincianObjekId);

            $akun = $subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis->kelompok->akun;
            $kelompok = $subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis->kelompok;
            $jenis = $subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis;
            $objek = $subSubRincianObjek->subRincianObjek->rincianObjek->objek;
            $rincianObjek = $subSubRincianObjek->subRincianObjek->rincianObjek;
            $subRincianObjek = $subSubRincianObjek->subRincianObjek;

            // Get next sequence number for this sub_sub_rincian_objek
            $lastAset = Aset::where('sub_sub_rincian_objek_id', $subSubRincianObjekId)
                ->orderBy('id', 'desc')
                ->first();

            $nextSequence = 1;
            if ($lastAset) {
                $lastKode = $lastAset->kode_barang;
                $parts = explode('.', $lastKode);
                $lastSequence = intval(end($parts));
                $nextSequence = $lastSequence + 1;
            }

            // Build kode barang
            $kodeBarang = sprintf(
                '%s.%s.%s.%s.%s.%s.%s.%03d',
                $akun->kode,
                $kelompok->kode,
                $jenis->kode,
                $objek->kode,
                $rincianObjek->kode,
                $subRincianObjek->kode,
                $subSubRincianObjek->kode,
                $nextSequence
            );

            return $kodeBarang;
        } catch (\Exception $e) {
            Log::error('Error generating kode barang: ' . $e->getMessage());
            throw new \Exception('Gagal generate kode barang');
        }
    }

    /**
     * Generate kode barang preview for AJAX
     */
    public function generateKodeBarangPreview(Request $request): JsonResponse
    {
        try {
            $subSubRincianObjekId = $request->input('sub_sub_rincian_objek_id');

            if (!$subSubRincianObjekId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sub Sub Rincian Objek ID required'
                ], 400);
            }

            $kodeBarang = $this->generateKodeBarang($subSubRincianObjekId);

            return response()->json([
                'success' => true,
                'kode_barang' => $kodeBarang
            ]);
        } catch (\Exception $e) {
            Log::error('Error generating kode barang preview: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal generate kode barang'
            ], 500);
        }
    }
}
