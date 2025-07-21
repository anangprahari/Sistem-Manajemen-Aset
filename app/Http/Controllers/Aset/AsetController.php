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
            'jumlah_barang' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'bukti_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_berita' => 'nullable|mimes:pdf|max:10240',
            'kode_barang' => 'required|string',
        ]);

        try {
            return DB::transaction(function () use ($validated, $request) {
                // Handle file uploads
                if ($request->hasFile('bukti_barang')) {
                    $fileName = time() . '_' . $request->file('bukti_barang')->getClientOriginalName();
                    $request->file('bukti_barang')->storeAs('bukti_barang', $fileName, 'public');
                    $validated['bukti_barang'] = $fileName;
                }

                if ($request->hasFile('bukti_berita')) {
                    $fileName = time() . '_' . $request->file('bukti_berita')->getClientOriginalName();
                    $request->file('bukti_berita')->storeAs('bukti_berita', $fileName, 'public');
                    $validated['bukti_berita'] = $fileName;
                }

                // Remove hierarchy fields that are not part of the asets table
                $asetData = $validated;
                unset(
                    $asetData['akun_id'],
                    $asetData['kelompok_id'],
                    $asetData['jenis_id'],
                    $asetData['objek_id'],
                    $asetData['rincian_objek_id'],
                    $asetData['sub_rincian_objek_id']
                );

                $aset = Aset::create($asetData);

                return redirect()->route('asets.index')
                    ->with('success', "Aset berhasil ditambahkan dengan kode: {$validated['kode_barang']}");
            });
        } catch (\Exception $e) {
            Log::error('Error creating aset: ' . $e->getMessage(), [
                'request' => $validated,
                'trace' => $e->getTraceAsString()
            ]);

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
        $akuns = Akun::orderBy('nama')->get();

        return view('asets.edit', compact('aset', 'hierarchy', 'akuns'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset): RedirectResponse
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
            'jumlah_barang' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'bukti_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bukti_berita' => 'nullable|mimes:pdf|max:10240',
            'kode_barang' => 'required|string',
        ]);

        try {
            return DB::transaction(function () use ($validated, $aset, $request) {
                // Handle file uploads
                if ($request->hasFile('bukti_barang')) {
                    // Delete old file if exists
                    if ($aset->bukti_barang) {
                        Storage::disk('public')->delete('bukti_barang/' . $aset->bukti_barang);
                    }

                    $fileName = time() . '_' . $request->file('bukti_barang')->getClientOriginalName();
                    $request->file('bukti_barang')->storeAs('bukti_barang', $fileName, 'public');
                    $validated['bukti_barang'] = $fileName;
                } else {
                    unset($validated['bukti_barang']);
                }

                if ($request->hasFile('bukti_berita')) {
                    // Delete old file if exists
                    if ($aset->bukti_berita) {
                        Storage::disk('public')->delete('bukti_berita/' . $aset->bukti_berita);
                    }

                    $fileName = time() . '_' . $request->file('bukti_berita')->getClientOriginalName();
                    $request->file('bukti_berita')->storeAs('bukti_berita', $fileName, 'public');
                    $validated['bukti_berita'] = $fileName;
                } else {
                    unset($validated['bukti_berita']);
                }

                // Remove hierarchy fields that are not part of the asets table
                unset(
                    $validated['akun_id'],
                    $validated['kelompok_id'],
                    $validated['jenis_id'],
                    $validated['objek_id'],
                    $validated['rincian_objek_id'],
                    $validated['sub_rincian_objek_id']
                );

                $aset->update($validated);

                return redirect()->route('asets.index')
                    ->with('success', 'Aset berhasil diperbarui');
            });
        } catch (\Exception $e) {
            Log::error('Error updating aset: ' . $e->getMessage(), [
                'aset_id' => $aset->id,
                'request' => $validated,
                'trace' => $e->getTraceAsString()
            ]);

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
