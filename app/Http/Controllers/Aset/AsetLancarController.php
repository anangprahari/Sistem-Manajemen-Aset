<?php

namespace App\Http\Controllers\Aset;

use App\Models\AsetLancar;
use App\Models\KodeRekening;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AsetLancarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asetLancars = AsetLancar::with('kodeRekening')->latest()->paginate(10);
        return view('asets.asetlancar.index', compact('asetLancars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data akun untuk dropdown pertama
        $akuns = KodeRekening::distinctAkun()->get();
        return view('asets.asetlancar.create', compact('akuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_rekening_id' => 'required|exists:kode_rekenings,id',
            'uraian_barang' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'uraian_kegiatan' => 'required|string',
            'uraian_jenis_barang' => 'required|string',
            'saldo_awal_unit' => 'required|integer|min:0',
            'saldo_awal_harga_satuan' => 'required|numeric|min:0',
            'mutasi_tambah_unit' => 'nullable|integer|min:0',
            'mutasi_tambah_harga' => 'nullable|numeric|min:0',
            'mutasi_kurang_unit' => 'nullable|integer|min:0',
            'mutasi_kurang_nilai' => 'nullable|numeric|min:0',
        ]);

        // Hitung nilai otomatis
        $validated['saldo_awal_total'] = $validated['saldo_awal_unit'] * $validated['saldo_awal_harga_satuan'];
        $validated['mutasi_tambah_nilai'] = ($validated['mutasi_tambah_unit'] ?? 0) * ($validated['mutasi_tambah_harga'] ?? 0);

        // Hitung saldo akhir
        $validated['saldo_akhir_unit'] = $validated['saldo_awal_unit'] + ($validated['mutasi_tambah_unit'] ?? 0) - ($validated['mutasi_kurang_unit'] ?? 0);
        $validated['saldo_akhir_total'] = $validated['saldo_awal_total'] + $validated['mutasi_tambah_nilai'] - ($validated['mutasi_kurang_nilai'] ?? 0);

        AsetLancar::create($validated);

        return redirect()->route('aset-lancar.index')->with('success', 'Aset lancar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AsetLancar $asetLancar)
    {
        $asetLancar->load('kodeRekening');
        return view('asets.asetlancar.show', compact('asetLancar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsetLancar $asetLancar)
    {
        $asetLancar->load('kodeRekening');
        $akuns = KodeRekening::distinctAkun()->get();
        return view('asets.asetlancar.edit', compact('asetLancar', 'akuns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsetLancar $asetLancar)
    {
        $validated = $request->validate([
            'kode_rekening_id' => 'required|exists:kode_rekenings,id',
            'uraian_barang' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'uraian_kegiatan' => 'required|string',
            'uraian_jenis_barang' => 'required|string',
            'saldo_awal_unit' => 'required|integer|min:0',
            'saldo_awal_harga_satuan' => 'required|numeric|min:0',
            'mutasi_tambah_unit' => 'nullable|integer|min:0',
            'mutasi_tambah_harga' => 'nullable|numeric|min:0',
            'mutasi_kurang_unit' => 'nullable|integer|min:0',
            'mutasi_kurang_nilai' => 'nullable|numeric|min:0',
        ]);

        // Hitung nilai otomatis
        $validated['saldo_awal_total'] = $validated['saldo_awal_unit'] * $validated['saldo_awal_harga_satuan'];
        $validated['mutasi_tambah_nilai'] = ($validated['mutasi_tambah_unit'] ?? 0) * ($validated['mutasi_tambah_harga'] ?? 0);

        // Hitung saldo akhir
        $validated['saldo_akhir_unit'] = $validated['saldo_awal_unit'] + ($validated['mutasi_tambah_unit'] ?? 0) - ($validated['mutasi_kurang_unit'] ?? 0);
        $validated['saldo_akhir_total'] = $validated['saldo_awal_total'] + $validated['mutasi_tambah_nilai'] - ($validated['mutasi_kurang_nilai'] ?? 0);

        $asetLancar->update($validated);

        return redirect()->route('aset-lancar.index')->with('success', 'Aset lancar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsetLancar $asetLancar)
    {
        $asetLancar->delete();
        return redirect()->route('aset-lancar.index')->with('success', 'Aset lancar berhasil dihapus.');
    }

    /**
     * AJAX Methods untuk dropdown dinamis
     */

    /**
     * Get kelompok berdasarkan akun
     */
    public function getKelompok(Request $request): JsonResponse
    {
        $akun = $request->get('akun');

        if (!$akun) {
            return response()->json([]);
        }

        $kelompoks = KodeRekening::kelompokByAkun($akun)->get();

        $result = $kelompoks->map(function ($item) {
            return [
                'value' => $item->kelompok,
                'text' => $item->kelompok . ' ' . $item->nama_kelompok
            ];
        });

        return response()->json($result);
    }

    /**
     * Get jenis berdasarkan akun dan kelompok
     */
    public function getJenis(Request $request): JsonResponse
    {
        $akun = $request->get('akun');
        $kelompok = $request->get('kelompok');

        if (!$akun || !$kelompok) {
            return response()->json([]);
        }

        $jenises = KodeRekening::jenisByAkunKelompok($akun, $kelompok)->get();

        $result = $jenises->map(function ($item) {
            return [
                'value' => $item->jenis,
                'text' => $item->jenis . ' ' . $item->nama_jenis
            ];
        });

        return response()->json($result);
    }

    /**
     * Get objek berdasarkan akun, kelompok, dan jenis
     */
    public function getObjek(Request $request): JsonResponse
    {
        $akun = $request->get('akun');
        $kelompok = $request->get('kelompok');
        $jenis = $request->get('jenis');

        if (!$akun || !$kelompok || !$jenis) {
            return response()->json([]);
        }

        $objeks = KodeRekening::objekByAkunKelompokJenis($akun, $kelompok, $jenis)->get();

        $result = $objeks->map(function ($item) {
            return [
                'value' => $item->objek,
                'text' => $item->objek . ' ' . $item->nama_objek
            ];
        });

        return response()->json($result);
    }

    /**
     * Get nomor rekening berdasarkan akun, kelompok, jenis, dan objek
     */
    public function getNomorRekening(Request $request): JsonResponse
    {
        $akun = $request->get('akun');
        $kelompok = $request->get('kelompok');
        $jenis = $request->get('jenis');
        $objek = $request->get('objek');

        if (!$akun || !$kelompok || !$jenis || !$objek) {
            return response()->json([]);
        }

        $nomorRekenings = KodeRekening::nomorByFilter($akun, $kelompok, $jenis, $objek)->get();

        $result = $nomorRekenings->map(function ($item) {
            return [
                'id' => $item->id,
                'value' => $item->nomor,
                'text' => $item->kode_lengkap . ' - ' . $item->uraian,
                'uraian' => $item->uraian
            ];
        });

        return response()->json($result);
    }

    /**
     * Get uraian berdasarkan kode rekening id
     */
    public function getUraian(Request $request): JsonResponse
    {
        $kodeRekeningId = $request->get('kode_rekening_id');

        if (!$kodeRekeningId) {
            return response()->json(['uraian' => '']);
        }

        $kodeRekening = KodeRekening::find($kodeRekeningId);

        if (!$kodeRekening) {
            return response()->json(['uraian' => '']);
        }

        return response()->json([
            'uraian' => $kodeRekening->uraian,
            'kode_lengkap' => $kodeRekening->kode_lengkap
        ]);
    }
}
