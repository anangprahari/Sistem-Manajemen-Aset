@extends('layouts.tabler')

@section('title', 'Tambah Barang')

@section('content')

<style>
    .klasifikasi-barang label{
      border-color: blue;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Tambah Barang Inventaris
                        </h3>
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary" style ="margin-left: 8px;">
                            <i class="fas fa-arrow-left mr-1" style="margin-left : 5px;" ></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-circle mr-2"></i>Terjadi Kesalahan:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" id="formBarang">
                        @csrf
                        
                        <!-- Section 1: Klasifikasi Barang -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-sitemap mr-2"></i>
                                    1. Klasifikasi Barang
                                </h5>
                            </div>
                            <div class="klasifikasi-barang">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="akun_id">Akun <span class="text-danger">*</span></label>
                                            <select class="form-control @error('akun_id') is-invalid @enderror" 
                                                    id="akun_id" name="akun_id" required>
                                                <option value="">Pilih Akun</option>
                                                @foreach($akuns as $akun)
                                                    <option value="{{ $akun->id }}" {{ old('akun_id') == $akun->id ? 'selected' : '' }}>
                                                        {{ $akun->kode }} - {{ $akun->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('akun_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="kelompok_id">Kelompok <span class="text-danger">*</span></label>
                                            <select class="form-control @error('kelompok_id') is-invalid @enderror" 
                                                    id="kelompok_id" name="kelompok_id" required disabled>
                                                <option value="">Pilih Kelompok</option>
                                            </select>
                                            @error('kelompok_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="jenis_id">Jenis <span class="text-danger">*</span></label>
                                            <select class="form-control @error('jenis_id') is-invalid @enderror" 
                                                    id="jenis_id" name="jenis_id" required disabled>
                                                <option value="">Pilih Jenis</option>
                                            </select>
                                            @error('jenis_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="objek_id">Objek <span class="text-danger">*</span></label>
                                            <select class="form-control @error('objek_id') is-invalid @enderror" 
                                                    id="objek_id" name="objek_id" required disabled>
                                                <option value="">Pilih Objek</option>
                                            </select>
                                            @error('objek_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="rincian_objek_id">Rincian Objek <span class="text-danger">*</span></label>
                                            <select class="form-control @error('rincian_objek_id') is-invalid @enderror" 
                                                    id="rincian_objek_id" name="rincian_objek_id" required disabled>
                                                <option value="">Pilih Rincian Objek</option>
                                            </select>
                                            @error('rincian_objek_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="sub_rincian_objek_id">Sub Rincian Objek <span class="text-danger">*</span></label>
                                            <select class="form-control @error('sub_rincian_objek_id') is-invalid @enderror" 
                                                    id="sub_rincian_objek_id" name="sub_rincian_objek_id" required disabled>
                                                <option value="">Pilih Sub Rincian Objek</option>
                                            </select>
                                            @error('sub_rincian_objek_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="nama_bidang_barang">Nama Bidang Barang <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_bidang_barang') is-invalid @enderror" 
                                                   id="nama_bidang_barang" name="nama_bidang_barang" 
                                                   value="{{ old('nama_bidang_barang') }}" readonly>
                                            @error('nama_bidang_barang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="kode_barang">Kode Barang <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" 
                                                   id="kode_barang" name="kode_barang" 
                                                   value="{{ old('kode_barang') }}" readonly>
                                            @error('kode_barang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Section 2: Informasi Barang -->
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    2. Informasi Barang
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="register">Register <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('register') is-invalid @enderror" 
                                                   id="register" name="register" value="{{ old('register') }}" required>
                                            @error('register')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                                                   id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                                            @error('nama_barang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="merk_type">Merk/Type</label>
                                            <input type="text" class="form-control @error('merk_type') is-invalid @enderror" 
                                                   id="merk_type" name="merk_type" value="{{ old('merk_type') }}">
                                            @error('merk_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="no_sertifikat">No. Sertifikat</label>
                                            <input type="text" class="form-control @error('no_sertifikat') is-invalid @enderror" 
                                                   id="no_sertifikat" name="no_sertifikat" value="{{ old('no_sertifikat') }}">
                                            @error('no_sertifikat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="no_plat_kendaraan">No. Plat Kendaraan</label>
                                            <input type="text" class="form-control @error('no_plat_kendaraan') is-invalid @enderror" 
                                                   id="no_plat_kendaraan" name="no_plat_kendaraan" value="{{ old('no_plat_kendaraan') }}">
                                            @error('no_plat_kendaraan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                  <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="no_pabrik">No. Pabrik</label>
                                            <input type="text" class="form-control @error('no_pabrik') is-invalid @enderror" 
                                                   id="no_pabrik" name="no_pabrik" value="{{ old('no_pabrik') }}">
                                            @error('no_pabrik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="no_casis">No. Casis</label>
                                            <input type="text" class="form-control @error('no_casis') is-invalid @enderror" 
                                                   id="no_casis" name="no_casis" value="{{ old('no_casis') }}">
                                            @error('no_casis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="bahan">Bahan</label>
                                            <input type="text" class="form-control @error('bahan') is-invalid @enderror" 
                                                   id="bahan" name="bahan" value="{{ old('bahan') }}">
                                            @error('bahan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="asal_perolehan">Asal Perolehan <span class="text-danger">*</span></label>
                                            <select class="form-control @error('asal_perolehan') is-invalid @enderror" 
                                                    id="asal_perolehan" name="asal_perolehan" required>
                                                <option value="">Pilih Asal Perolehan</option>
                                                <option value="Hibah" {{ old('asal_perolehan') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                                                <option value="Pembelian" {{ old('asal_perolehan') == 'Pembelian' ? 'selected' : '' }}>Pembelian</option>
                                                <option value="Wakaf" {{ old('asal_perolehan') == 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
                                                <option value="Bantuan" {{ old('asal_perolehan') == 'Bantuan' ? 'selected' : '' }}>Bantuan</option>
                                                <option value="Sumbangan" {{ old('asal_perolehan') == 'Sumbangan' ? 'selected' : '' }}>Sumbangan</option>
                                                <option value="Lainnya" {{ old('asal_perolehan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('asal_perolehan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="tahun_perolehan">Tahun Perolehan <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('tahun_perolehan') is-invalid @enderror" 
                                                   id="tahun_perolehan" name="tahun_perolehan" 
                                                   value="{{ old('tahun_perolehan') }}" 
                                                   min="1900" max="{{ date('Y') }}" required>
                                            @error('tahun_perolehan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" class="form-control @error('ukuran') is-invalid @enderror" 
                                                   id="ukuran" name="ukuran" value="{{ old('ukuran') }}" 
                                                   placeholder="contoh: 10x20 cm">
                                            @error('ukuran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                  <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="satuan">Satuan <span class="text-danger">*</span></label>
                                            <select class="form-control @error('satuan') is-invalid @enderror" 
                                                    id="satuan" name="satuan" required>
                                                <option value="">Pilih Satuan</option>
                                                <option value="Unit" {{ old('satuan') == 'Unit' ? 'selected' : '' }}>Unit</option>
                                                <option value="Buah" {{ old('satuan') == 'Buah' ? 'selected' : '' }}>Buah</option>
                                                <option value="Set" {{ old('satuan') == 'Set' ? 'selected' : '' }}>Set</option>
                                                <option value="Paket" {{ old('satuan') == 'Paket' ? 'selected' : '' }}>Paket</option>
                                                <option value="Meter" {{ old('satuan') == 'Meter' ? 'selected' : '' }}>Meter</option>
                                                <option value="Kilogram" {{ old('satuan') == 'Kilogram' ? 'selected' : '' }}>Kilogram</option>
                                                <option value="Liter" {{ old('satuan') == 'Liter' ? 'selected' : '' }}>Liter</option>
                                                <option value="Lembar" {{ old('satuan') == 'Lembar' ? 'selected' : '' }}>Lembar</option>
                                                <option value="Kotak" {{ old('satuan') == 'Kotak' ? 'selected' : '' }}>Kotak</option>
                                                <option value="Botol" {{ old('satuan') == 'Botol' ? 'selected' : '' }}>Botol</option>
                                            </select>
                                            @error('satuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="keadaan_barang">Keadaan Barang <span class="text-danger">*</span></label>
                                            <select class="form-control @error('keadaan_barang') is-invalid @enderror" 
                                                    id="keadaan_barang" name="keadaan_barang" required>
                                                <option value="">Pilih Keadaan Barang</option>
                                                <option value="Baik" {{ old('keadaan_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                                <option value="Rusak Ringan" {{ old('keadaan_barang') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                                <option value="Rusak Berat" {{ old('keadaan_barang') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                            </select>
                                            @error('keadaan_barang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="jumlah_barang">Jumlah Barang <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('jumlah_barang') is-invalid @enderror" 
                                                   id="jumlah_barang" name="jumlah_barang" 
                                                   value="{{ old('jumlah_barang') }}" min="1" required>
                                            @error('jumlah_barang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label for="harga_satuan">Harga Satuan <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" 
                                                       id="harga_satuan" name="harga_satuan" 
                                                       value="{{ old('harga_satuan') }}" min="0" required>
                                            </div>
                                            @error('harga_satuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   <div class="col-md-6 row mb-3">
                                        <div class="form-group">
                                            <label>Total Harga</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" id="total_harga" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Dokumen Pendukung -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-file-upload mr-2"></i>
                                    3. Dokumen Pendukung
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bukti_barang">Bukti Barang (Foto)</label>
                                            <input type="file" class="form-control-file @error('bukti_barang') is-invalid @enderror" 
                                                   id="bukti_barang" name="bukti_barang" accept="image/*">
                                            <small class="form-text text-muted">
                                                Format: JPG, PNG, JPEG. Maksimal 2MB
                                            </small>
                                            @error('bukti_barang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bukti_berita">Bukti Berita (Dokumen)</label>
                                            <input type="file" class="form-control-file @error('bukti_berita') is-invalid @enderror" 
                                                   id="bukti_berita" name="bukti_berita" accept=".pdf">
                                            <small class="form-text text-muted">
                                                Format: PDF. Maksimal 2MB
                                            </small>
                                            @error('bukti_berita')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary mr-2">
                                <i class="fas fa-undo mr-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Cascading Dropdown
    $('#akun_id').change(function() {
        var akunId = $(this).val();
        resetDropdowns(['kelompok_id', 'jenis_id', 'objek_id', 'rincian_objek_id', 'sub_rincian_objek_id']);
        
        if (akunId) {
            loadDropdownData('kelompok', akunId, 'kelompok_id');
        }
    });

    $('#kelompok_id').change(function() {
        var kelompokId = $(this).val();
        resetDropdowns(['jenis_id', 'objek_id', 'rincian_objek_id', 'sub_rincian_objek_id']);
        
        if (kelompokId) {
            loadDropdownData('jenis', kelompokId, 'jenis_id');
        }
    });

    $('#jenis_id').change(function() {
        var jenisId = $(this).val();
        resetDropdowns(['objek_id', 'rincian_objek_id', 'sub_rincian_objek_id']);
        
        if (jenisId) {
            loadDropdownData('objek', jenisId, 'objek_id');
        }
    });

    $('#objek_id').change(function() {
        var objekId = $(this).val();
        resetDropdowns(['rincian_objek_id', 'sub_rincian_objek_id']);
        
        if (objekId) {
            loadDropdownData('rincian-objek', objekId, 'rincian_objek_id');
        }
    });

    $('#rincian_objek_id').change(function() {
        var rincianObjekId = $(this).val();
        resetDropdowns(['sub_rincian_objek_id']);
        
        if (rincianObjekId) {
            loadDropdownData('sub-rincian-objek', rincianObjekId, 'sub_rincian_objek_id');
        }
    });

    // Generate kode barang setelah semua dropdown terisi
    $('#sub_rincian_objek_id').change(function() {
        generateKodeBarang();
    });

    // Hitung total harga
    $('#jumlah_barang, #harga_satuan').on('input', function() {
        calculateTotal();
    });

    // Functions
    function resetDropdowns(dropdowns) {
        dropdowns.forEach(function(dropdown) {
            $('#' + dropdown).html('<option value="">Pilih ' + dropdown.replace('_', ' ').replace('id', '') + '</option>');
            $('#' + dropdown).prop('disabled', true);
        });
        
        // Reset kode barang dan nama bidang
        $('#kode_barang').val('');
        $('#nama_bidang_barang').val('');
    }

    function loadDropdownData(type, parentId, targetId) {
        $.ajax({
            url: '/api/dropdown/' + type + '/' + parentId,
            type: 'GET',
            success: function(data) {
                var select = $('#' + targetId);
                select.html('<option value="">Pilih ' + type.replace('-', ' ') + '</option>');
                
                $.each(data, function(key, value) {
                    select.append('<option value="' + value.id + '">' + value.kode + ' - ' + value.nama + '</option>');
                });
                
                select.prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error loading dropdown data:', error);
                alert('Gagal memuat data dropdown');
            }
        });
    }

    function generateKodeBarang() {
        var formData = {
            akun_id: $('#akun_id').val(),
            kelompok_id: $('#kelompok_id').val(),
            jenis_id: $('#jenis_id').val(),
            objek_id: $('#objek_id').val(),
            rincian_objek_id: $('#rincian_objek_id').val(),
            sub_rincian_objek_id: $('#sub_rincian_objek_id').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

       $.ajax({
            url: '/api/dropdown/generate-kode-barang',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#kode_barang').val(response.kode_barang);
                    $('#nama_bidang_barang').val(response.nama_bidang_barang);
                } else {
                    alert('Gagal generate kode barang');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error generating kode barang:', error);
                alert('Gagal generate kode barang');
            }
        });
    }

    function calculateTotal() {
        var jumlah = parseFloat($('#jumlah_barang').val()) || 0;
        var harga = parseFloat($('#harga_satuan').val()) || 0;
        var total = jumlah * harga;
        
        $('#total_harga').val(total.toLocaleString('id-ID'));
    }

    // Validasi form sebelum submit
    $('#formBarang').on('submit', function(e) {
        var isValid = true;
        var errorMessages = [];

        // Validasi dropdown cascade
        if (!$('#akun_id').val()) {
            errorMessages.push('Akun harus dipilih');
            isValid = false;
        }
        if (!$('#kelompok_id').val()) {
            errorMessages.push('Kelompok harus dipilih');
            isValid = false;
        }
        if (!$('#jenis_id').val()) {
            errorMessages.push('Jenis harus dipilih');
            isValid = false;
        }
        if (!$('#objek_id').val()) {
            errorMessages.push('Objek harus dipilih');
            isValid = false;
        }
        if (!$('#rincian_objek_id').val()) {
            errorMessages.push('Rincian Objek harus dipilih');
            isValid = false;
        }
        if (!$('#sub_rincian_objek_id').val()) {
            errorMessages.push('Sub Rincian Objek harus dipilih');
            isValid = false;
        }

        // Validasi kode barang auto-generated
        if (!$('#kode_barang').val()) {
            errorMessages.push('Kode barang belum ter-generate');
            isValid = false;
        }

        // Validasi tahun perolehan
        var tahun = parseInt($('#tahun_perolehan').val());
        var currentYear = new Date().getFullYear();
        if (tahun < 1900 || tahun > currentYear) {
            errorMessages.push('Tahun perolehan tidak valid');
            isValid = false;
        }

        // Validasi file upload
        var buktiBarang = $('#bukti_barang')[0].files[0];
        var buktiBerita = $('#bukti_berita')[0].files[0];
        
        if (buktiBarang && buktiBarang.size > 2048000) {
            errorMessages.push('Ukuran file bukti barang maksimal 2MB');
            isValid = false;
        }
        
        if (buktiBerita && buktiBerita.size > 2048000) {
            errorMessages.push('Ukuran file bukti berita maksimal 2MB');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            alert('Terdapat kesalahan:\n' + errorMessages.join('\n'));
        }
    });

    // Preview gambar bukti barang
    $('#bukti_barang').change(function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Hapus preview sebelumnya jika ada
                $('#preview_bukti_barang').remove();
                
                // Tambahkan preview baru
                var preview = '<div id="preview_bukti_barang" class="mt-2">' +
                             '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">' +
                             '</div>';
                $('#bukti_barang').parent().append(preview);
            };
            reader.readAsDataURL(file);
        }
    });

    // Format input harga dengan ribuan
    $('#harga_satuan').on('input', function() {
        var value = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(value);
        calculateTotal();
    });

    // Auto-fill tahun perolehan dengan tahun saat ini
    if (!$('#tahun_perolehan').val()) {
        $('#tahun_perolehan').val(new Date().getFullYear());
    }

    // Konfirmasi reset form
    $('button[type="reset"]').click(function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin mereset semua data?')) {
            document.getElementById('formBarang').reset();
            resetDropdowns(['kelompok_id', 'jenis_id', 'objek_id', 'rincian_objek_id', 'sub_rincian_objek_id']);
            $('#preview_bukti_barang').remove();
            $('#total_harga').val('');
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.card {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border: none;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.125);
}

.card-header h5 {
    margin: 0;
    font-weight: 600;
}

.form-group label {
    font-weight: 600;
    color: #495057;
}

.text-danger {
    color: #dc3545 !important;
}

.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.alert {
    border-radius: 0.375rem;
    border: none;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

.btn {
    border-radius: 0.375rem;
    font-weight: 500;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-control[readonly] {
    background-color: #e9ecef;
    opacity: 1;
}

.input-group-text {
    background-color: #e9ecef;
    border-color: #ced4da;
}

.form-control-file {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 0.375rem 0.75rem;
}

.form-text {
    font-size: 0.875em;
    color: #6c757d;
}

.img-thumbnail {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 0.25rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-header .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .card-header .btn {
        margin-top: 10px;
    }
    
    .d-flex.justify-content-end {
        flex-direction: column;
    }
    
    .d-flex.justify-content-end .btn {
        margin-bottom: 10px;
        margin-right: 0 !important;
    }
}

/* Loading state */
.loading {
    position: relative;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid #ccc;
    border-top: 2px solid #333;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Custom select styling */
select.form-control {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23666' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 8px center;
    background-size: 8px 10px;
    padding-right: 30px;
}

select.form-control:focus {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23007bff' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E");
}

/* Section headers */
.card-header.bg-primary {
    background-color: #007bff !important;
}

.card-header.bg-success {
    background-color: #28a745 !important;
}

.card-header.bg-warning {
    background-color: #ffc107 !important;
    color: #212529 !important;
}

/* Form validation feedback */
.was-validated .form-control:valid {
    border-color: #28a745;
}

.was-validated .form-control:invalid {
    border-color: #dc3545;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
@endpush
