<?php

namespace App\Http\Controllers\Aset;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\Akun;
use App\Models\Kelompok;
use App\Models\Jenis;
use App\Models\Objek;
use App\Models\RincianObjek;
use App\Models\SubRincianObjek;
use App\Models\SubSubRincianObjek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asets = Aset::with('subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun')
            ->latest()
            ->paginate(10);

        return view('asets.index', compact('asets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akuns = Akun::all();

        return view('asets.create', compact('akuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
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
            'bukti_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bukti_berita' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = $request->all();

        // Generate kode barang berdasarkan sub_sub_rincian_objek_id
        $subSubRincianObjek = SubSubRincianObjek::with('subRincianObjek.rincianObjek.objek.jenis.kelompok.akun')
            ->find($request->sub_sub_rincian_objek_id);

        // Ambil nomor urut terakhir untuk kode barang yang sama
        $lastAset = Aset::where('sub_sub_rincian_objek_id', $request->sub_sub_rincian_objek_id)
            ->latest('id')
            ->first();

        $nomorUrut = $lastAset ? (int) substr($lastAset->kode_barang, -3) + 1 : 1;
        $data['kode_barang'] = $subSubRincianObjek->kode . '.' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        // Handle file upload bukti barang (foto)
        if ($request->hasFile('bukti_barang')) {
            $file = $request->file('bukti_barang');
            $filename = time() . '_' . Str::slug($request->nama_bidang_barang) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bukti_barang', $filename, 'public');
            $data['bukti_barang'] = $filename;
        }

        // Handle file upload bukti berita (PDF)
        if ($request->hasFile('bukti_berita')) {
            $file = $request->file('bukti_berita');
            $filename = time() . '_berita_' . Str::slug($request->nama_bidang_barang) . '.pdf';
            $file->storeAs('bukti_berita', $filename, 'public');
            $data['bukti_berita'] = $filename;
        }

        Aset::create($data);

        return redirect()->route('asets.index')
            ->with('success', 'Data aset berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset)
    {
        $aset->load('subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun');

        return view('asets.show', compact('aset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aset $aset)
    {
        $akuns = Akun::all();
        $aset->load('subSubRincianObjek.subRincianObjek.rincianObjek.objek.jenis.kelompok.akun');

        return view('asets.edit', compact('aset', 'akuns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset)
    {
        $request->validate([
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
            'bukti_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bukti_berita' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = $request->all();

        // Handle file upload bukti barang (foto)
        if ($request->hasFile('bukti_barang')) {
            // Hapus file lama
            if ($aset->bukti_barang) {
                Storage::disk('public')->delete('bukti_barang/' . $aset->bukti_barang);
            }

            $file = $request->file('bukti_barang');
            $filename = time() . '_' . Str::slug($request->nama_bidang_barang) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bukti_barang', $filename, 'public');
            $data['bukti_barang'] = $filename;
        }

        // Handle file upload bukti berita (PDF)
        if ($request->hasFile('bukti_berita')) {
            // Hapus file lama
            if ($aset->bukti_berita) {
                Storage::disk('public')->delete('bukti_berita/' . $aset->bukti_berita);
            }

            $file = $request->file('bukti_berita');
            $filename = time() . '_berita_' . Str::slug($request->nama_bidang_barang) . '.pdf';
            $file->storeAs('bukti_berita', $filename, 'public');
            $data['bukti_berita'] = $filename;
        }

        $aset->update($data);

        return redirect()->route('asets.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset)
    {
        // Hapus file bukti barang
        if ($aset->bukti_barang) {
            Storage::disk('public')->delete('bukti_barang/' . $aset->bukti_barang);
        }

        // Hapus file bukti berita
        if ($aset->bukti_berita) {
            Storage::disk('public')->delete('bukti_berita/' . $aset->bukti_berita);
        }

        $aset->delete();

        return redirect()->route('asets.index')
            ->with('success', 'Data aset berhasil dihapus.');
    }

    public function getKelompoks($akunId)
    {
        return response()->json(Kelompok::where('akun_id', $akunId)->get());
    }

    public function getJenis($kelompokId)
    {
        return response()->json(Jenis::where('kelompok_id', $kelompokId)->get());
    }

    public function getObjeks($jenisId)
    {
        return response()->json(Objek::where('jenis_id', $jenisId)->get());
    }

    public function getRincianObjeks($objekId)
    {
        return response()->json(RincianObjek::where('objek_id', $objekId)->get());
    }

    public function getSubRincianObjeks($rincianObjekId)
    {
        return response()->json(SubRincianObjek::where('rincian_objek_id', $rincianObjekId)->get());
    }

    public function getSubSubRincianObjeks($subRincianObjekId)
    {
        return response()->json(SubSubRincianObjek::where('sub_rincian_objek_id', $subRincianObjekId)->get());
    }
}
