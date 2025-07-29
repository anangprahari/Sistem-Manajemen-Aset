@extends('layouts.tabler')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Aset Lancar</h1>
        <div class="d-flex">
            <a href="{{ route('aset-lancars.export', request()->query()) }}" class="btn btn-success btn-sm me-2">
                <i class="fas fa-file-excel fa-sm text-white-50"></i> Export Excel
            </a>
            <a href="{{ route('aset-lancars.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Aset Lancar
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search and Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('aset-lancars.index') }}" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Cari berdasarkan nama kegiatan, uraian, jenis barang, kode rekening..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    @if(request('search'))
                        <a href="{{ route('aset-lancars.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- DataTales Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Aset Lancar</h6>
        </div>
        <div class="card-body">
            @if($asetLancars->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Kode Rekening</th>
                                <th width="15%">Uraian Rekening</th>
                                <th width="15%">Nama Kegiatan</th>
                                <th width="10%">Jenis Barang</th>
                                <th width="8%">Saldo Awal Unit</th>
                                <th width="10%">Saldo Awal Total</th>
                                <th width="8%">Saldo Akhir Unit</th>
                                <th width="10%">Saldo Akhir Total</th>
                                <th width="9%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asetLancars as $index => $aset)
                                <tr>
                                    <td class="text-center">{{ $asetLancars->firstItem() + $index }}</td>
                                    <td>
                                        <span class="badge bg-info text-white">
                                            {{ $aset->rekeningUraian->kode_rekening }}
                                        </span>
                                    </td>
                                    <td>{{ $aset->rekeningUraian->uraian }}</td>
                                    <td>
                                        <strong>{{ $aset->nama_kegiatan }}</strong>
                                        @if($aset->uraian_kegiatan)
                                            <br><small class="text-muted">{{ Str::limit($aset->uraian_kegiatan, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $aset->uraian_jenis_barang ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ number_format($aset->saldo_awal_unit) }}</span>
                                    </td>
                                    <td class="text-end">{{ 'Rp ' . number_format($aset->saldo_awal_total, 2) }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ number_format($aset->saldo_akhir_unit) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <strong class="text-success">{{ 'Rp ' . number_format($aset->saldo_akhir_total, 2) }}</strong>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('aset-lancars.show', $aset) }}" 
                                               class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('aset-lancars.edit', $aset) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    onclick="confirmDelete({{ $aset->id }})" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <small class="text-muted">
                            Menampilkan {{ $asetLancars->firstItem() }} sampai {{ $asetLancars->lastItem() }} 
                            dari {{ $asetLancars->total() }} data
                        </small>
                    </div>
                    <div>
                        {{ $asetLancars->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada data aset lancar</h5>
                    <p class="text-muted">Silakan tambah data aset lancar baru.</p>
                    <a href="{{ route('aset-lancars.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Aset Lancar
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data aset lancar ini?</p>
                <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(id) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `{{ route('aset-lancars.index') }}/${id}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Auto hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    });
});
</script>
@endpush
@endsection