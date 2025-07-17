@extends('layouts.tabler')

@section('title', 'Daftar Aset Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Aset Barang Milik Daerah</h3>
                    <div class="card-tools">
                        <a href="{{ route('asets.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Aset
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Merk/Type</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Keadaan</th>
                                    <th>Bukti</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($asets as $index => $aset)
                                <tr>
                                    <td>{{ $asets->firstItem() + $index }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $aset->kode_barang }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $aset->nama_bidang_barang }}</strong><br>
                                        <small class="text-muted">{{ $aset->register }}</small>
                                    </td>
                                    <td>{{ $aset->nama_jenis_barang }}</td>
                                    <td>{{ $aset->merk_type ?? '-' }}</td>
                                    <td>{{ $aset->satuan }}</td>
                                    <td>{{ number_format($aset->jumlah_barang) }}</td>
                                    <td>{{ $aset->formatted_harga }}</td>
                                    <td>
                                        @if($aset->keadaan_barang == 'Baik')
                                            <span class="badge bg-success">{{ $aset->keadaan_barang }}</span>
                                        @elseif($aset->keadaan_barang == 'Kurang Baik')
                                            <span class="badge bg-warning">{{ $aset->keadaan_barang }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $aset->keadaan_barang }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if($aset->bukti_barang)
                                                <a href="{{ $aset->bukti_barang_url }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat Foto">
                                                    <i class="fas fa-image"></i>
                                                </a>
                                            @endif
                                            @if($aset->bukti_berita)
                                                <a href="{{ $aset->bukti_berita_url }}" target="_blank" class="btn btn-sm btn-outline-danger" title="Lihat PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('asets.show', $aset) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('asets.edit', $aset) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('asets.destroy', $aset) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada data aset barang.</p>
                                            <a href="{{ route('asets.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Tambah Aset Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Menampilkan {{ $asets->firstItem() ?? 0 }} sampai {{ $asets->lastItem() ?? 0 }} 
                            dari {{ $asets->total() }} data
                        </div>
                        <div>
                            {{ $asets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Image -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Bukti Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" class="img-fluid" alt="Bukti Barang">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview image in modal
    $(document).on('click', '.btn-outline-primary', function(e) {
        e.preventDefault();
        const imageUrl = $(this).attr('href');
        $('#previewImage').attr('src', imageUrl);
        $('#imageModal').modal('show');
    });
</script>
@endpush
@endsection