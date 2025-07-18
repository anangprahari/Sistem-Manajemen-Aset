@extends('layouts.tabler')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Seluruh Aset</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('asets.create') }}" class="btn btn-primary">+ Tambah Aset</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Kode Barang</th>
                    <th>Nama Bidang Barang</th>
                    <th>Register</th>
                    <th>Nama Jenis Barang</th>
                    <th>Merk / Type</th>
                    <th>No. Sertifikat</th>
                    <th>No. Plat Kendaraan</th>
                    <th>No. Pabrik</th>
                    <th>No. Casis</th>
                    <th>Bahan</th>
                    <th>Asal Perolehan</th>
                    <th>Ukuran Barang / Konstruksi</th>
                    <th>Satuan</th>
                    <th>Keadaan Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                    <th>Bukti Barang</th>
                    <th>Bukti Berita</th>
                    <th>Kode Sub Sub Rincian Objek</th>
                    <th>Nama Barang (SubSub)</th>
                    <th>Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asets as $index => $aset)
                    <tr>
                        <td class="text-center">{{ ($asets->currentPage() - 1) * $asets->perPage() + $index + 1 }}</td>
                        <td>{{ $aset->kode_barang }}</td>
                        <td>{{ $aset->nama_bidang_barang }}</td>
                        <td>{{ $aset->register }}</td>
                        <td>{{ $aset->nama_jenis_barang }}</td>
                        <td>{{ $aset->merk_type ?? '-' }}</td>
                        <td>{{ $aset->no_sertifikat ?? '-' }}</td>
                        <td>{{ $aset->no_plat_kendaraan ?? '-' }}</td>
                        <td>{{ $aset->no_pabrik ?? '-' }}</td>
                        <td>{{ $aset->no_casis ?? '-' }}</td>
                        <td>{{ $aset->bahan ?? '-' }}</td>
                        <td>{{ $aset->asal_perolehan }}</td>
                        <td>{{ $aset->ukuran_barang_konstruksi ?? '-' }}</td>
                        <td class="text-center">{{ $aset->satuan }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $aset->keadaan_barang === 'Baik' ? 'success' : ($aset->keadaan_barang === 'Kurang Baik' ? 'warning' : 'danger') }}">
                                {{ $aset->keadaan_barang }}
                            </span>
                        </td>
                        <td class="text-center">{{ $aset->jumlah_barang }}</td>
                        <td class="text-end">{{ $aset->formatted_harga }}</td>
                        <td class="text-end">{{ $aset->formatted_total_harga }}</td>
                        <td class="text-center">
                            @if($aset->bukti_barang_url)
                                <a href="{{ $aset->bukti_barang_url }}" target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if($aset->bukti_berita_url)
                                <a href="{{ $aset->bukti_berita_url }}" target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $aset->subSubRincianObjek->kode ?? '-' }}</td>
                        <td>{{ $aset->subSubRincianObjek->nama_barang ?? '-' }}</td>
                        <td>{{ $aset->subSubRincianObjek->subRincianObjek->rincianObjek->objek->jenis->kelompok->akun->nama ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('asets.show', $aset->id) }}" class="btn btn-sm btn-info">Lihat</a>
                            <a href="{{ route('asets.edit', $aset->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('asets.destroy', $aset->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="24" class="text-center text-muted">Belum ada data aset.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $asets->links() }}
    </div>
</div>
@endsection
