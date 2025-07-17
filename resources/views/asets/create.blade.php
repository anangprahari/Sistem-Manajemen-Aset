@extends('layouts.tabler')

@section('title', 'Tambah Aset Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Aset Barang</h3>
                    <div class="card-tools">
                        <a href="{{ route('asets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('asets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Dropdown 7 Tingkat Berjenjang -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-sitemap"></i> Klasifikasi Barang
                                </h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="akun_id">1. Akun <span class="text-danger">*</span></label>
                                   <select id="akun_id" name="akun_id" class="form-control" required>
                                        <option value="">-- Pilih Akun --</option>
                                        @foreach($akuns as $akun)
                                            <option value="{{ $akun->id }}">{{ $akun->kode }} - {{ $akun->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kelompok_id">2. Kelompok <span class="text-danger">*</span></label>
                                    <select id="kelompok_id" name="kelompok_id" class="form-control" required disabled>
                                        <option value="">-- Pilih Kelompok --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenis_id">3. Jenis <span class="text-danger">*</span></label>
                                    <select id="jenis_id" name="jenis_id" class="form-control" required disabled>
                                        <option value="">-- Pilih Jenis --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="objek_id">4. Objek <span class="text-danger">*</span></label>
                                    <select id="objek_id" name="objek_id" class="form-control" required disabled>
                                        <option value="">-- Pilih Objek --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rincian_objek_id">5. Rincian Objek <span class="text-danger">*</span></label>
                                   <select id="rincian_objek_id" name="rincian_objek_id" class="form-control" required disabled>
                                        <option value="">-- Pilih Rincian Objek --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sub_rincian_objek_id">6. Sub Rincian Objek <span class="text-danger">*</span></label>
                                    <select id="sub_rincian_objek_id" name="sub_rincian_objek_id" class="form-control" required disabled>
                                        <option value="">-- Pilih Sub Rincian Objek --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_sub_rincian_objek_id">7. Sub-sub Rincian Objek <span class="text-danger">*</span></label>
                                   <select id="sub_sub_rincian_objek_id" name="sub_sub_rincian_objek_id" class="form-control" required disabled>
                                        <option value="">-- Pilih Sub-sub Rincian Objek --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_preview">Kode Barang (Preview)</label>
                                    <input type="text" id="kode_preview" class="form-control" readonly placeholder="Akan tergenerate otomatis">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Data Barang -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-info-circle"></i> Informasi Barang
                                </h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_bidang_barang">Nama Bidang Barang <span class="text-danger">*</span></label>
                                    <input type="text" id="nama_bidang_barang" name="nama_bidang_barang" class="form-control" 
                                           value="{{ old('nama_bidang_barang') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="register">Register <span class="text-danger">*</span></label>
                                    <input type="text" id="register" name="register" class="form-control" 
                                           value="{{ old('register') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_jenis_barang">Nama Jenis Barang <span class="text-danger">*</span></label>
                                    <input type="text" id="nama_jenis_barang" name="nama_jenis_barang" class="form-control" 
                                           value="{{ old('nama_jenis_barang') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="merk_type">Merk/Type</label>
                                    <input type="text" id="merk_type" name="merk_type" class="form-control" 
                                           value="{{ old('merk_type') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_sertifikat">No. Sertifikat</label>
                                    <input type="text" id="no_sertifikat" name="no_sertifikat" class="form-control" 
                                           value="{{ old('no_sertifikat') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_plat_kendaraan">No. Plat Kendaraan</label>
                                    <input type="text" id="no_plat_kendaraan" name="no_plat_kendaraan" class="form-control" 
                                           value="{{ old('no_plat_kendaraan') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_pabrik">No. Pabrik</label>
                                    <input type="text" id="no_pabrik" name="no_pabrik" class="form-control" 
                                           value="{{ old('no_pabrik') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_casis">No. Casis</label>
                                    <input type="text" id="no_casis" name="no_casis" class="form-control" 
                                           value="{{ old('no_casis') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bahan">Bahan</label>
                                    <input type="text" id="bahan" name="bahan" class="form-control" 
                                           value="{{ old('bahan') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="asal_perolehan">Asal Perolehan <span class="text-danger">*</span></label>
                                    <select id="asal_perolehan" name="asal_perolehan" class="form-control" required>
                                        <option value="">-- Pilih Asal Perolehan --</option>
                                        <option value="Pembelian Langsung" {{ old('asal_perolehan') == 'Pembelian Langsung' ? 'selected' : '' }}>Pembelian Langsung</option>
                                        <option value="Tender Terbuka" {{ old('asal_perolehan') == 'Tender Terbuka' ? 'selected' : '' }}>Tender Terbuka</option>
                                        <option value="Tender Terbatas" {{ old('asal_perolehan') == 'Tender Terbatas' ? 'selected' : '' }}>Tender Terbatas</option>
                                        <option value="Pengadaan Langsung" {{ old('asal_perolehan') == 'Pengadaan Langsung' ? 'selected' : '' }}>Pengadaan Langsung</option>
                                        <option value="Kontrak Payung" {{ old('asal_perolehan') == 'Kontrak Payung' ? 'selected' : '' }}>Kontrak Payung</option>
                                        <option value="Hibah" {{ old('asal_perolehan') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                                        <option value="Bantuan" {{ old('asal_perolehan') == 'Bantuan' ? 'selected' : '' }}>Bantuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ukuran_barang_konstruksi">Ukuran/Konstruksi</label>
                                    <input type="text" id="ukuran_barang_konstruksi" name="ukuran_barang_konstruksi" class="form-control" 
                                           value="{{ old('ukuran_barang_konstruksi') }}" placeholder="Contoh: 4.5m x 1.8m x 1.4m">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="satuan">Satuan <span class="text-danger">*</span></label>
                                    <select id="satuan" name="satuan" class="form-control" required>
                                        <option value="">-- Pilih Satuan --</option>
                                        <option value="Unit" {{ old('satuan') == 'Unit' ? 'selected' : '' }}>Unit</option>
                                        <option value="Buah" {{ old('satuan') == 'Buah' ? 'selected' : '' }}>Buah</option>
                                        <option value="Set" {{ old('satuan') == 'Set' ? 'selected' : '' }}>Set</option>
                                        <option value="Paket" {{ old('satuan') == 'Paket' ? 'selected' : '' }}>Paket</option>
                                        <option value="Meter" {{ old('satuan') == 'Meter' ? 'selected' : '' }}>Meter</option>
                                        <option value="M²" {{ old('satuan') == 'M²' ? 'selected' : '' }}>M²</option>
                                        <option value="M³" {{ old('satuan') == 'M³' ? 'selected' : '' }}>M³</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="keadaan_barang">Keadaan Barang <span class="text-danger">*</span></label>
                                    <select id="keadaan_barang" name="keadaan_barang" class="form-control" required>
                                        <option value="">-- Pilih Keadaan --</option>
                                        <option value="Baik" {{ old('keadaan_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Kurang Baik" {{ old('keadaan_barang') == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
                                        <option value="Rusak Berat" {{ old('keadaan_barang') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jumlah_barang">Jumlah Barang <span class="text-danger">*</span></label>
                                    <input type="number" id="jumlah_barang" name="jumlah_barang" class="form-control" 
                                           value="{{ old('jumlah_barang') }}" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="harga_satuan">Harga Satuan <span class="text-danger">*</span></label>
                                    <input type="number" id="harga_satuan" name="harga_satuan" class="form-control" 
                                           value="{{ old('harga_satuan') }}" min="0" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Upload Files -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-upload"></i> Upload Dokumen
                                </h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bukti_barang">Bukti Barang (Foto)</label>
                                    <input type="file" id="bukti_barang" name="bukti_barang" class="form-control" 
                                           accept="image/jpeg,image/jpg,image/png">
                                    <small class="form-text text-muted">
                                        Format: JPG, JPEG, PNG. Maksimal 2MB.
                                    </small>
                                    <div id="preview_bukti_barang" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bukti_berita">Bukti Berita (PDF)</label>
                                    <input type="file" id="bukti_berita" name="bukti_berita" class="form-control" 
                                           accept="application/pdf">
                                    <small class="form-text text-muted">
                                        Format: PDF. Maksimal 5MB.
                                    </small>
                                    <div id="preview_bukti_berita" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                        <a href="{{ route('asets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Debugging: Cek apakah jQuery dan elemen sudah siap
    console.log('Document ready, jQuery version:', $.fn.jquery);
    console.log('Akun dropdown found:', $('#akun_id').length);

    // Setup CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function untuk load dropdown dengan error handling yang lebih baik
    function loadDropdown(url, targetSelector, placeholder, nameField = 'nama') {
        console.log('Loading dropdown:', url, 'Target:', targetSelector);
        
        // Tampilkan loading
        const select = $(targetSelector);
        select.html('<option value="">Loading...</option>');
        select.prop('disabled', true);
        
        $.ajax({
            url: url,
            method: 'GET',
            timeout: 15000, // 15 detik timeout
            dataType: 'json',
            success: function(data) {
                console.log('Success loading', placeholder, 'Data:', data);
                
                select.html('<option value="">-- Pilih ' + placeholder + ' --</option>');
                
                if (data && Array.isArray(data) && data.length > 0) {
                    data.forEach(function(item) {
                        const optionText = item.kode + ' - ' + item[nameField];
                        const option = $('<option></option>')
                            .attr('value', item.id)
                            .attr('data-kode', item.kode)
                            .text(optionText);
                        select.append(option);
                    });
                    
                    select.prop('disabled', false);
                    console.log(placeholder + ' dropdown enabled with', data.length, 'items');
                } else {
                    select.html('<option value="">-- Tidak ada data --</option>');
                    select.prop('disabled', true);
                    console.log('No data found for', placeholder);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading', placeholder);
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                console.error('URL:', url);
                
                select.html('<option value="">-- Error loading data --</option>');
                select.prop('disabled', true);
                
                // Tampilkan alert untuk debugging
                if (xhr.status === 404) {
                    console.error('Route not found. Check your API routes.');
                    alert('API Route tidak ditemukan: ' + url + '\nPastikan route API sudah benar.');
                } else if (xhr.status === 500) {
                    console.error('Server error. Check your controller.');
                    alert('Server error. Cek controller dan database.');
                } else {
                    console.error('Unknown error:', xhr.responseText);
                    alert('Error: ' + status + ' - ' + error);
                }
            }
        });
    }

    // Function untuk reset dropdown
    function resetDropdowns(selectors) {
        selectors.forEach(function(selector) {
            const friendlyName = selector.replace('_id', '').replace(/_/g, ' ');
            const capitalizedName = friendlyName.charAt(0).toUpperCase() + friendlyName.slice(1);
            
            $('#' + selector)
                .html('<option value="">-- Pilih ' + capitalizedName + ' --</option>')
                .prop('disabled', true);
        });
        $('#kode_preview').val('');
        console.log('Reset dropdowns:', selectors);
    }

    // Dropdown bertingkat - Level 1: Akun
    $('#akun_id').change(function() {
        console.log('Akun changed, value:', $(this).val());
        
        const akunId = $(this).val();
        resetDropdowns(['kelompok_id', 'jenis_id', 'objek_id', 'rincian_objek_id', 'sub_rincian_objek_id', 'sub_sub_rincian_objek_id']);
        
        if (akunId) {
            loadDropdown('/api/kelompoks/' + akunId, '#kelompok_id', 'Kelompok');
        }
    });

    // Level 2: Kelompok
    $('#kelompok_id').change(function() {
        console.log('Kelompok changed, value:', $(this).val());
        
        const kelompokId = $(this).val();
        resetDropdowns(['jenis_id', 'objek_id', 'rincian_objek_id', 'sub_rincian_objek_id', 'sub_sub_rincian_objek_id']);
        
        if (kelompokId) {
            loadDropdown('/api/jenis/' + kelompokId, '#jenis_id', 'Jenis');
        }
    });

    // Level 3: Jenis
    $('#jenis_id').change(function() {
        console.log('Jenis changed, value:', $(this).val());
        
        const jenisId = $(this).val();
        resetDropdowns(['objek_id', 'rincian_objek_id', 'sub_rincian_objek_id', 'sub_sub_rincian_objek_id']);
        
        if (jenisId) {
            loadDropdown('/api/objeks/' + jenisId, '#objek_id', 'Objek');
        }
    });

    // Level 4: Objek
    $('#objek_id').change(function() {
        console.log('Objek changed, value:', $(this).val());
        
        const objekId = $(this).val();
        resetDropdowns(['rincian_objek_id', 'sub_rincian_objek_id', 'sub_sub_rincian_objek_id']);
        
        if (objekId) {
            loadDropdown('/api/rincian-objeks/' + objekId, '#rincian_objek_id', 'Rincian Objek');
        }
    });

    // Level 5: Rincian Objek
    $('#rincian_objek_id').change(function() {
        console.log('Rincian Objek changed, value:', $(this).val());
        
        const rincianObjekId = $(this).val();
        resetDropdowns(['sub_rincian_objek_id', 'sub_sub_rincian_objek_id']);
        
        if (rincianObjekId) {
            loadDropdown('/api/sub-rincian-objeks/' + rincianObjekId, '#sub_rincian_objek_id', 'Sub Rincian Objek');
        }
    });

    // Level 6: Sub Rincian Objek
    $('#sub_rincian_objek_id').change(function() {
        console.log('Sub Rincian Objek changed, value:', $(this).val());
        
        const subRincianObjekId = $(this).val();
        resetDropdowns(['sub_sub_rincian_objek_id']);
        
        if (subRincianObjekId) {
            loadDropdown('/api/sub-sub-rincian-objeks/' + subRincianObjekId, '#sub_sub_rincian_objek_id', 'Sub-sub Rincian Objek', 'nama_barang');
        }
    });

    // Level 7: Sub-sub Rincian Objek (Final)
    $('#sub_sub_rincian_objek_id').change(function() {
        console.log('Sub-sub Rincian Objek changed, value:', $(this).val());
        
        const selectedOption = $(this).find('option:selected');
        const kode = selectedOption.data('kode');
        
        if (kode) {
            // Preview kode barang (akan ditambah nomor urut otomatis di backend)
            $('#kode_preview').val(kode + '.xxx');
            console.log('Kode preview set to:', kode + '.xxx');
        } else {
            $('#kode_preview').val('');
        }
    });

    // Preview file upload
    $('#bukti_barang').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_bukti_barang').html('<img src="' + e.target.result + '" class="img-thumbnail" width="200">');
            };
            reader.readAsDataURL(file);
        }
    });

    $('#bukti_berita').change(function() {
        const file = this.files[0];
        if (file) {
            $('#preview_bukti_berita').html('<p class="text-success"><i class="fas fa-file-pdf"></i> ' + file.name + '</p>');
        }
    });

    // Format input harga
    $('#harga_satuan').on('input', function() {
        let value = $(this).val();
        if (value) {
            const formatted = new Intl.NumberFormat('id-ID').format(value);
            $(this).attr('title', 'Rp ' + formatted);
        }
    });

    // Test koneksi API saat halaman dimuat
    setTimeout(function() {
        console.log('Testing API connection...');
        
        // Test API endpoint yang ada
        $.ajax({
            url: '/api/dropdown/health-check',
            method: 'GET',
            success: function(data) {
                console.log('API health check successful:', data);
            },
            error: function(xhr, status, error) {
                console.error('API health check failed:', status, error);
                console.error('Response:', xhr.responseText);
            }
        });

        // Test endpoint kelompok dengan ID dummy
        $.ajax({
            url: '/api/kelompoks/1',
            method: 'GET',
            success: function(data) {
                console.log('Kelompok test successful:', data);
            },
            error: function(xhr, status, error) {
                console.error('Kelompok test failed:', status, error);
                console.error('Response:', xhr.responseText);
            }
        });
    }, 1000);
});
</script>
@endpush
@endsection