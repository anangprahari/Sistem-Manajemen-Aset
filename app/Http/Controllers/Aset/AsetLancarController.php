<?php

namespace App\Http\Controllers\Aset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsetLancarController extends Controller
{
    public function index()
    {
        // Tampilkan halaman daftar aset lancar
        return view('asets.asetlancar.index');
    }

    public function create()
    {
        // Tampilkan form tambah aset lancar
        return view('asets.asetlancar.create');
    }

    public function store(Request $request)
    {
        // Simpan data aset lancar
        // Validasi dan simpan ke database sesuai kebutuhan
        return redirect()->route('aset-lancar.index')->with('success', 'Aset Lancar berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Tampilkan detail aset lancar
        return view('asets.asetlancar.show', compact('id'));
    }

    public function edit($id)
    {
        // Tampilkan form edit aset lancar
        return view('asets.asetlancar.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update data aset lancar
        return redirect()->route('aset-lancar.index')->with('success', 'Aset Lancar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus data aset lancar
        return redirect()->route('aset-lancar.index')->with('success', 'Aset Lancar berhasil dihapus.');
    }
}
