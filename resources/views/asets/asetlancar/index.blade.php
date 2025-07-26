@extends('layouts.tabler')

@section('title', 'Daftar Aset Lancar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Daftar Aset Lancar</h4>
                    <a href="{{ route('aset-lancar.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Aset Lancar
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="asetLancarTable" class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Rekening</th>
                                    <th>Uraian Barang</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Saldo Awal</th>
                                    <th>Saldo Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($asetLancars as $index => $aset)
                                <tr>
                                    <td>{{ $asetLancars->firstItem() + $index }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $aset->kodeRekening->kode_lengkap }}</span>
                                        <br>
                                        <small class="text-muted">{{ $aset->kodeRekening->uraian }}</small>
                                    </td>
                                    <td>{{ $aset->uraian_barang }}</td>
                                    <td>{{ $aset->nama_kegiatan }}</td>
                                    <td>
                                        <span class="fw-bold">{{ number_format($aset->saldo_awal_unit) }} unit</span>
                                        <br>
                                        <small class="text-success">Rp {{ number_format($aset->saldo_awal_total, 0, ',', '.') }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ number_format($aset->saldo_akhir_unit) }} unit</span>
                                        <br>
                                        <small class="text-success">Rp {{ number_format($aset->saldo_akhir_total, 0, ',', '.') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('aset-lancar.show', $aset) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('aset-lancar.edit', $aset) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $aset->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $aset->id }}" action="{{ route('aset-lancar.destroy', $aset) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $asetLancars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush