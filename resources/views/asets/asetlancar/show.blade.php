@extends('layouts.tabler')

@section('title', 'Detail Aset Lancar')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Detail Aset Lancar</h4>
                        <div>
                            <a href="{{ route('aset-lancar.edit', $asetLancar) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('aset-lancar.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <!-- Kode Rekening Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary border-bottom pb-2">Informasi Kode Rekening</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Kode Lengkap</h6>
                                    <h5 class="text-primary mb-0">{{ $asetLancar->kodeRekening->kode_lengkap }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Uraian Rekening</h6>
                                    <p class="mb-0">{{ $asetLancar->kodeRekening->uraian }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label text-muted">Akun:</label>
                            <p class="fw-bold">{{ $asetLancar->kodeRekening->akun }} - {{ $asetLancar->kodeRekening->nama_akun }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Kelompok:</label>
                            <p class="fw-bold">{{ $asetLancar->kodeRekening->kelompok }} - {{ $asetLancar->kodeRekening->nama_kelompok }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Jenis:</label>
                            <p class="fw-bold">{{ $asetLancar->kodeRekening->jenis }} - {{ $asetLancar->kodeRekening->nama_jenis }}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Objek:</label>
                            <p class="fw-bold">{{ $asetLancar->kodeRekening->objek }} - {{ $asetLancar->kodeRekening->nama_objek }}</p>
                        </div>
                    </div>

                    <!-- Informasi Barang Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary border-bottom pb-2">Informasi Barang & Kegiatan</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Uraian Barang:</label>
                            <p class="fw-bold">{{ $asetLancar->uraian_barang }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Nama Kegiatan:</label>
                            <p class="fw-bold">{{ $asetLancar->nama_kegiatan }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Uraian Kegiatan:</label>
                            <div class="border rounded p-3 bg-light">
                                <p class="mb-0">{{ $asetLancar->uraian_kegiatan }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Uraian Jenis Barang:</label>
                            <div class="border rounded p-3 bg-light">
                                <p class="mb-0">{{ $asetLancar->uraian_jenis_barang }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Saldo Awal</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Unit:</span>
                                        <strong>{{ number_format($asetLancar->saldo_awal_unit) }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Harga Satuan:</span>
                                        <strong>Rp {{ number_format($asetLancar->saldo_awal_harga_satuan, 0, ',', '.') }}</strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span><strong>Total:</strong></span>
                                        <strong class="text-primary">Rp {{ number_format($asetLancar->saldo_awal_total, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">Mutasi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-success">Tambah:</small>
                                            <div>Unit: <strong>{{ number_format($asetLancar->mutasi_tambah_unit ?? 0) }}</strong></div>
                                            <div>Nilai: <strong>Rp {{ number_format($asetLancar->mutasi_tambah_nilai ?? 0, 0, ',', '.') }}</strong></div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-danger">Kurang:</small>
                                            <div>Unit: <strong>{{ number_format($asetLancar->mutasi_kurang_unit ?? 0) }}</strong></div>
                                            <div>Nilai: <strong>Rp {{ number_format($asetLancar->mutasi_kurang_nilai ?? 0, 0, ',', '.') }}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Saldo Akhir</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Unit:</span>
                                        <strong>{{ number_format($asetLancar->saldo_akhir_unit) }}</strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span><strong>Total:</strong></span>
                                        <strong class="text-info">Rp {{ number_format($asetLancar->saldo_akhir_total, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Information Table -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-primary border-bottom pb-2">Detail Perhitungan</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th rowspan="2" class="align-middle text-center">Keterangan</th>
                                            <th colspan="3" class="text-center">Saldo Awal</th>
                                            <th colspan="3" class="text-center">Mutasi Tambah</th>
                                            <th colspan="2" class="text-center">Mutasi Kurang</th>
                                            <th colspan="2" class="text-center">Saldo Akhir</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Nilai</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Nilai</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">{{ $asetLancar->uraian_barang }}</td>
                                            <td class="text-end">{{ number_format($asetLancar->saldo_awal_unit) }}</td>
                                            <td class="text-end">{{ number_format($asetLancar->saldo_awal_harga_satuan, 0, ',', '.') }}</td>
                                            <td class="text-end fw-bold text-primary">{{ number_format($asetLancar->saldo_awal_total, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($asetLancar->mutasi_tambah_unit ?? 0) }}</td>
                                            <td class="text-end">{{ number_format($asetLancar->mutasi_tambah_harga ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-end text-success">{{ number_format($asetLancar->mutasi_tambah_nilai ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($asetLancar->mutasi_kurang_unit ?? 0) }}</td>
                                            <td class="text-end text-danger">{{ number_format($asetLancar->mutasi_kurang_nilai ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-end fw-bold">{{ number_format($asetLancar->saldo_akhir_unit) }}</td>
                                            <td class="text-end fw-bold text-info">{{ number_format($asetLancar->saldo_akhir_total, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('aset-lancar.edit', $asetLancar) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $asetLancar->id }})">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                                <a href="{{ route('aset-lancar.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-list"></i> Daftar Aset Lancar
                                </a>
                            </div>
                            <form id="delete-form-{{ $asetLancar->id }}" action="{{ route('aset-lancar.destroy', $asetLancar) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.table-bordered {
    border: 2px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dipulihkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#asetLancarTable').DataTable({
        "pageLength": 10,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
        }
    });
});

function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dipulihkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush
