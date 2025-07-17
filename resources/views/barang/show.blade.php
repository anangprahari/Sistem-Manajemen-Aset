<div class="row">
    <div class="col-md-6">
        <h5>Informasi Dasar</h5>
        <table class="table table-borderless">
            <tr>
                <td><strong>Kode Barang:</strong></td>
                <td>{{ $barang->kode_barang }}</td>
            </tr>
            <tr>
                <td><strong>Nama Barang:</strong></td>
                <td>{{ $barang->nama_barang }}</td>
            </tr>
            <tr>
                <td><strong>Merk/Type:</strong></td>
                <td>{{ $barang->merk_type ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Register:</strong></td>
                <td>{{ $barang->register }}</td>
            </tr>
            <tr>
                <td><strong>Keadaan:</strong></td>
                <td>
                    @if($barang->keadaan_barang == 'B')
                        <span class="badge badge-success">Baik</span>
                    @elseif($barang->keadaan_barang == 'KG')
                        <span class="badge badge-warning">Kurang Baik</span>
                    @elseif($barang->keadaan_barang == 'RB')
                        <span class="badge badge-danger">Rusak Berat</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Jumlah:</strong></td>
                <td>{{ number_format($barang->jumlah_barang) }} {{ $barang->satuan }}</td>
            </tr>
            <tr>
                <td><strong>Harga Satuan:</strong></td>
                <td>Rp {{ number_format($barang->harga_satuan) }}</td>
            </tr>
        </table>
    </div>
    
    <div class="col-md-6">
        <h5>Klasifikasi</h5>
        <table class="table table-borderless">
            <tr>
                <td><strong>Akun:</strong></td>
                <td>{{ $barang->akun->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Kelompok:</strong></td>
                <td>{{ $barang->kelompok->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Jenis:</strong></td>
                <td>{{ $barang->jenis->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Objek:</strong></td>
                <td>{{ $barang->objek->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Rincian Objek:</strong></td>
                <td>{{ $barang->rincianObjek->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Sub Rincian Objek:</strong></td>
                <td>{{ $barang->subRincianObjek->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Nama Bidang Barang:</strong></td>
                <td>{{ $barang->nama_bidang_barang }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <h5>Informasi Tambahan</h5>
        <table class="table table-borderless">
            <tr>
                <td><strong>No. Sertifikat:</strong></td>
                <td>{{ $barang->no_sertifikat ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>No. Plat Kendaraan:</strong></td>
                <td>{{ $barang->no_plat_kendaraan ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>No. Pabrik:</strong></td>
                <td>{{ $barang->no_pabrik ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>No. Casis:</strong></td>
                <td>{{ $barang->no_casis ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Bahan:</strong></td>
                <td>{{ $barang->bahan ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Asal Perolehan:</strong></td>
                <td>{{ $barang->asal_perolehan }}</td>
            </tr>
            <tr>
                <td><strong>Tahun Perolehan:</strong></td>
                <td>{{ $barang->tahun_perolehan }}</td>
            </tr>
            <tr>
                <td><strong>Ukuran:</strong></td>
                <td>{{ $barang->ukuran ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

@if($barang->bukti_barang || $barang->bukti_berita)
<div class="row mt-3">
    <div class="col-md-12">
        <h5>Bukti Dokumen</h5>
        <div class="row">
            @if($barang->bukti_barang)
            <div class="col-md-6">
                <p><strong>Bukti Barang:</strong></p>
                <img src="{{ asset('storage/' . $barang->bukti_barang) }}" 
                     alt="Bukti Barang" 
                     class="img-fluid img-thumbnail" 
                     style="max-height: 200px;">
            </div>
            @endif
            
            @if($barang->bukti_berita)
            <div class="col-md-6">
                <p><strong>Bukti Berita:</strong></p>
                <a href="{{ asset('storage/' . $barang->bukti_berita) }}" 
                   target="_blank" 
                   class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> Lihat PDF
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endif