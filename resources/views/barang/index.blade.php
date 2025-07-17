@extends('layouts.tabler')

@section('title', 'Data Barang')

@section('content')

<style>
    thead.thead-dark th {
       background: linear-gradient(135deg, #005eff 0%, #0047cc 100%);
        color: white;             
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-boxes mr-2"></i>
                            Data Barang Inventaris
                        </h3>
                        <a href="{{ route('barang.create') }}" class="btn btn-primary" style="margin-left: 8px;">
                                     <i class="fas fa-plus mr-1"></i> Tambah Barang
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Filter dan Search -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterAkun">Filter Akun:</label>
                                <select class="form-control" id="filterAkun">
                                    <option value="">Semua Akun</option>
                                    @foreach($barangs->unique('akun.kode') as $barang)
                                        <option value="{{ $barang->akun->kode }}">
                                            {{ $barang->akun->kode }} - {{ $barang->akun->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterKeadaan">Filter Keadaan:</label>
                                <select class="form-control" id="filterKeadaan">
                                    <option value="">Semua Keadaan</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="filterTahun">Filter Tahun:</label>
                                <select class="form-control" id="filterTahun">
                                    <option value="">Semua Tahun</option>
                                    @for($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="searchBarang">Cari Barang:</label>
                                <input type="text" class="form-control" id="searchBarang" placeholder="Nama barang, kode, atau merk...">
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data Barang -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="barangTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 12%">Nama Bidang Barang</th>
                                    <th style="width: 15%">Kode Barang</th>
                                    <th style="width: 10%">Registrasi</th>
                                    <th style="width: 10%">Klasifikasi</th>
                                    <th style="width: 8%">Tahun</th>
                                    <th style="width: 8%">Jumlah</th>
                                    <th style="width: 10%">Harga Satuan</th>
                                    <th style="width: 8%">Keadaan</th>
                                    <th style="width: 14%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barangs as $index => $barang)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $barang->kode_barang }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $barang->nama_barang }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $barang->nama_bidang_barang }}</small>
                                        </td>
                                        <td>{{ $barang->merk_type ?? '-' }}</td>
                                        <td>
                                            <small>
                                                {{ $barang->akun->kode }}<br>
                                                {{ $barang->kelompok->nama }}
                                            </small>
                                        </td>
                                        <td>{{ $barang->tahun_perolehan }}</td>
                                        <td>{{ number_format($barang->jumlah_barang) }} {{ $barang->satuan }}</td>
                                        <td>Rp {{ number_format($barang->harga_satuan, 0, ',', '.') }}</td>
                                        <td>
                                            @if($barang->keadaan_barang == 'Baik')
                                                <span class="badge badge-success">{{ $barang->keadaan_barang }}</span>
                                            @elseif($barang->keadaan_barang == 'Rusak Ringan')
                                                <span class="badge badge-warning">{{ $barang->keadaan_barang }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $barang->keadaan_barang }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-info" onclick="showDetail({{ $barang->id }})" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteBarang({{ $barang->id }})" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                                <br>
                                                <h5 class="text-muted">Belum ada data barang</h5>
                                                <p class="text-muted">Silakan tambah data barang terlebih dahulu</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($barangs->count() > 0)
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <small class="text-muted">
                                    Menampilkan {{ $barangs->count() }} dari {{ $barangs->count() }} data
                                </small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Barang -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Detail Barang
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2 text-danger"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data barang ini?</p>
                <p class="text-danger"><small>Data yang sudah dihapus tidak dapat dikembalikan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#barangTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });

    // Filter berdasarkan akun
    $('#filterAkun').change(function() {
        table.column(4).search(this.value).draw();
    });

    // Filter berdasarkan keadaan
    $('#filterKeadaan').change(function() {
        table.column(8).search(this.value).draw();
    });

    // Filter berdasarkan tahun
    $('#filterTahun').change(function() {
        table.column(5).search(this.value).draw();
    });

    // Search global
    $('#searchBarang').on('keyup', function() {
        table.search(this.value).draw();
    });
});

// Fungsi untuk menampilkan detail barang
function showDetail(id) {
    $('#detailModal').modal('show');
    
    $.ajax({
        url: '/barang/' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContent').html(response.html);
        },
        error: function(xhr, status, error) {
            $('#detailContent').html('<div class="alert alert-danger">Gagal memuat detail barang</div>');
        }
    });
}

// Fungsi untuk menghapus barang
function deleteBarang(id) {
    $('#deleteForm').attr('action', '/barang/' + id);
    $('#deleteModal').modal('show');
}

// Auto hide alert
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);
</script>
@endpush

@push('styles')
<style>
.card {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.table th {
    background-color: #343a40;
    color: white;
    font-weight: 600;
}

.btn-group .btn {
    margin-right: 2px;
}

.badge {
    font-size: 0.8em;
}

.table-responsive {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.form-group label {
    font-weight: 600;
    color: #495057;
}

.alert {
    border-radius: 0.375rem;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
</style>
@endpush