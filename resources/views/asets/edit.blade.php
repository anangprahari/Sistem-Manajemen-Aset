<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Aset</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.css" rel="stylesheet">
     <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #059669;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --info-color: #0891b2;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            padding: 2rem 0;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-container h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .dropdown-section {
            background: var(--light-color);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }

        .dropdown-section h4 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
        }

        .dropdown-item {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .dropdown-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .required-field {
            color: var(--danger-color);
            font-weight: bold;
        }

        .form-select, .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
            outline: none;
        }

        .form-select:disabled {
            background-color: #f1f5f9;
            opacity: 0.7;
        }

        .loading {
            display: none;
            color: var(--primary-color);
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .error-message {
            display: none;
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-weight: 500;
        }

        .hierarchy-display {
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            border: 2px solid var(--info-color);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .hierarchy-display h6 {
            color: var(--info-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hierarchy-item {
            background: white;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            border-left: 4px solid var(--info-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .hierarchy-level {
            font-weight: 600;
            color: var(--primary-color);
        }

        .kode-preview {
            background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);
            border: 2px solid var(--success-color);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .kode-preview i {
            color: var(--success-color);
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        #kode-barang-text {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--success-color);
            font-family: 'Courier New', monospace;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #6b7280 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(100, 116, 139, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(100, 116, 139, 0.4);
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .auto-filled {
            background-color: #f0f9ff !important;
            border-color: #0891b2 !important;
        }

        .file-preview {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 0.5rem;
        }

        .file-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 1.5rem;
            }
            
            .dropdown-section, .section-card {
                padding: 1.5rem;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container-fluid main-container">
        <div class="form-container">
            <div class="text-center mb-4">
                <h2>
                    <i class="fas fa-edit text-warning"></i> Form Edit Aset
                </h2>
                <p class="text-muted">Update informasi aset yang sudah ada</p>
            </div>
            
            <form id="assetForm" method="POST" action="{{ route('asets.update', $aset->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Dropdown Hierarki Section -->
                <div class="dropdown-section">
                    <h4 class="mb-3">
                        <i class="fas fa-sitemap"></i> Pilih Hierarki Aset
                    </h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="dropdown-item">
                                <label class="dropdown-label">1. Akun <span class="required-field">*</span></label>
                                <select class="form-select" id="akun" name="akun_id" required>
                                    <option value="">Pilih Akun</option>
                                    <option value="1" data-kode="01" {{ old('akun_id', $aset->akun_id) == '1' ? 'selected' : '' }}>01 - Aset Lancar</option>
                                    <option value="2" data-kode="02" {{ old('akun_id', $aset->akun_id) == '2' ? 'selected' : '' }}>02 - Investasi Jangka Panjang</option>
                                    <option value="3" data-kode="03" {{ old('akun_id', $aset->akun_id) == '3' ? 'selected' : '' }}>03 - Aset Tetap</option>
                                    <option value="4" data-kode="04" {{ old('akun_id', $aset->akun_id) == '4' ? 'selected' : '' }}>04 - Dana Cadangan</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-akun"></i>
                                <div class="error-message" id="error-akun"></div>
                            </div>
                            
                            <div class="dropdown-item">
                                <label class="dropdown-label">2. Kelompok <span class="required-field">*</span></label>
                                <select class="form-select" id="kelompok" name="kelompok_id" required>
                                    <option value="">Pilih Kelompok</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-kelompok"></i>
                                <div class="error-message" id="error-kelompok"></div>
                            </div>
                            
                            <div class="dropdown-item">
                                <label class="dropdown-label">3. Jenis <span class="required-field">*</span></label>
                                <select class="form-select" id="jenis" name="jenis_id" required>
                                    <option value="">Pilih Jenis</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-jenis"></i>
                                <div class="error-message" id="error-jenis"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="dropdown-item">
                                <label class="dropdown-label">4. Objek <span class="required-field">*</span></label>
                                <select class="form-select" id="objek" name="objek_id" required>
                                    <option value="">Pilih Objek</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-objek"></i>
                                <div class="error-message" id="error-objek"></div>
                            </div>
                            
                            <div class="dropdown-item">
                                <label class="dropdown-label">5. Rincian Objek <span class="required-field">*</span></label>
                                <select class="form-select" id="rincian_objek" name="rincian_objek_id" required>
                                    <option value="">Pilih Rincian Objek</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-rincian-objek"></i>
                                <div class="error-message" id="error-rincian-objek"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="dropdown-item">
                                <label class="dropdown-label">6. Sub Rincian Objek <span class="required-field">*</span></label>
                                <select class="form-select" id="sub_rincian_objek" name="sub_rincian_objek_id" required>
                                    <option value="">Pilih Sub Rincian Objek</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-sub-rincian-objek"></i>
                                <div class="error-message" id="error-sub-rincian-objek"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="dropdown-item">
                                <label class="dropdown-label">7. Sub Sub Rincian Objek <span class="required-field">*</span></label>
                                <select class="form-select" id="sub_sub_rincian_objek" name="sub_sub_rincian_objek_id" required>
                                    <option value="">Pilih Sub Sub Rincian Objek</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-sub-sub-rincian-objek"></i>
                                <div class="error-message" id="error-sub-sub-rincian-objek"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Display Hierarki yang dipilih -->
                <div class="hierarchy-display fade-in" id="hierarchy-display">
                    <h6><i class="fas fa-list"></i> Hierarki Yang Dipilih:</h6>
                    <div id="hierarchy-content"></div>
                </div>
                
                <!-- Kode Barang Preview -->
                <div class="kode-preview fade-in" id="kode-preview">
                    <i class="fas fa-barcode"></i> Kode Barang: <span id="kode-barang-text">{{ $aset->kode_barang ?? '-' }}</span>
                    <input type="hidden" name="kode_barang" id="kode_barang" value="{{ $aset->kode_barang }}">
                </div>
                
                <!-- Informasi Dasar Aset -->
                <div class="section-card">
                    <h4 class="section-title">
                        <i class="fas fa-info-circle"></i> Informasi Dasar Aset
                    </h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Bidang Barang <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="nama_bidang_barang" required 
                                       placeholder="Masukkan nama bidang barang" 
                                       value="{{ old('nama_bidang_barang', $aset->nama_bidang_barang) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Register <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="register" required 
                                       placeholder="Masukkan nomor register"
                                       value="{{ old('register', $aset->register) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Jenis Barang <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="nama_jenis_barang" required 
                                       placeholder="Masukkan nama jenis barang"
                                       value="{{ old('nama_jenis_barang', $aset->nama_jenis_barang) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Asal Perolehan <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="asal_perolehan" required 
                                       placeholder="Masukkan asal perolehan"
                                       value="{{ old('asal_perolehan', $aset->asal_perolehan) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tahun Perolehan <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="tahun_perolehan" min="1900" max="{{ date('Y') }}" required 
                                    placeholder="Masukkan tahun perolehan"
                                    value="{{ old('tahun_perolehan', $aset->tahun_perolehan) }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Satuan <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="satuan" required 
                                       placeholder="Contoh: Unit, Buah, Set"
                                       value="{{ old('satuan', $aset->satuan) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Keadaan Barang <span class="required-field">*</span></label>
                                <select class="form-select" name="keadaan_barang" required>
                                    <option value="">Pilih Keadaan Barang</option>
                                    <option value="Baik" {{ old('keadaan_barang', $aset->keadaan_barang) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="Kurang Baik" {{ old('keadaan_barang', $aset->keadaan_barang) == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
                                    <option value="Rusak Berat" {{ old('keadaan_barang', $aset->keadaan_barang) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Jumlah Barang <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="jumlah_barang" min="1" required 
                                       placeholder="Masukkan jumlah barang"
                                       value="{{ old('jumlah_barang', $aset->jumlah_barang) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Harga Satuan <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="harga_satuan" min="0" step="0.01" required 
                                       placeholder="Masukkan harga satuan"
                                       value="{{ old('harga_satuan', $aset->harga_satuan) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="section-card">
                    <h4 class="section-title">
                        <i class="fas fa-plus-circle"></i> Informasi Tambahan
                    </h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Merk / Type</label>
                                <input type="text" class="form-control" name="merk_type" 
                                       placeholder="Masukkan merk atau type barang"
                                       value="{{ old('merk_type', $aset->merk_type) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. Sertifikat</label>
                                <input type="text" class="form-control" name="no_sertifikat" 
                                       placeholder="Masukkan nomor sertifikat"
                                       value="{{ old('no_sertifikat', $aset->no_sertifikat) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. Plat Kendaraan</label>
                                <input type="text" class="form-control" name="no_plat_kendaraan" 
                                       placeholder="Masukkan nomor plat kendaraan"
                                       value="{{ old('no_plat_kendaraan', $aset->no_plat_kendaraan) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. Pabrik</label>
                                <input type="text" class="form-control" name="no_pabrik" 
                                       placeholder="Masukkan nomor pabrik"
                                       value="{{ old('no_pabrik', $aset->no_pabrik) }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No. Casis</label>
                                <input type="text" class="form-control" name="no_casis" 
                                       placeholder="Masukkan nomor casis"
                                       value="{{ old('no_casis', $aset->no_casis) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Bahan</label>
                                <input type="text" class="form-control" name="bahan" 
                                       placeholder="Masukkan bahan barang"
                                       value="{{ old('bahan', $aset->bahan) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Ukuran Barang / Konstruksi</label>
                                <input type="text" class="form-control" name="ukuran_barang_konstruksi" 
                                       placeholder="Masukkan ukuran barang atau konstruksi"
                                       value="{{ old('ukuran_barang_konstruksi', $aset->ukuran_barang_konstruksi) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Bukti Barang</label>
                                <input type="file" class="form-control" name="bukti_barang" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                
                                @if($aset->bukti_barang)
                                    <div class="file-preview mt-2">
                                        <div class="file-info">
                                            <i class="fas fa-image text-success"></i>
                                            <span>File saat ini: {{ basename($aset->bukti_barang) }}</span>
                                        </div>
                                        @if(in_array(pathinfo($aset->bukti_barang, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                            <img src="{{ asset('storage/' . $aset->bukti_barang) }}" alt="Bukti Barang" class="mt-2">
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bukti Berita</label>
                                <input type="file" class="form-control" name="bukti_berita" 
                                       accept="application/pdf">
                                <small class="text-muted">Format: PDF. Maksimal 10MB</small>
                                
                                @if($aset->bukti_berita)
                                    <div class="file-preview mt-2">
                                        <div class="file-info">
                                            <i class="fas fa-file-pdf text-danger"></i>
                                            <span>File saat ini: {{ basename($aset->bukti_berita) }}</span>
                                            <a href="{{ asset('storage/' . $aset->bukti_berita) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-secondary me-3" onclick="goBack()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Aset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.all.min.js"></script>
    
    <script>
        let selectedHierarchy = {};
        
        // Data aset yang sedang diedit
        const currentAset = {
            akun_id: '{{ $aset->akun_id }}',
            kelompok_id: '{{ $aset->kelompok_id }}',
            jenis_id: '{{ $aset->jenis_id }}',
            objek_id: '{{ $aset->objek_id }}',
            rincian_objek_id: '{{ $aset->rincian_objek_id }}',
            sub_rincian_objek_id: '{{ $aset->sub_rincian_objek_id }}',
            sub_sub_rincian_objek_id: '{{ $aset->sub_sub_rincian_objek_id }}'
        };
        
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            
            // Load hierarki yang sudah ada
            loadExistingHierarchy();
            
            // Show validation errors if any
            @if($errors->any())
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += '{{ $error }}\n';
                @endforeach
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessages,
                });
            @endif
        });
        
        function loadExistingHierarchy() {
            // Load hierarki secara bertingkat sesuai data yang sudah ada
            if (currentAset.akun_id) {
                loadKelompoks(currentAset.akun_id, currentAset.kelompok_id);
            }
        }
        
        function setupEventListeners() {
            // Event listeners untuk setiap dropdown
            document.getElementById('akun')?.addEventListener('change', function() {
                const akunId = this.value;
                selectedHierarchy.akun = getSelectedOption(this);
                
                if (akunId) {
                    loa// Melanjutkan dari bagian yang terpotong...

                if (akunId) {
                    loadKelompoks(akunId);
                } else {
                    resetDropdowns(['kelompok', 'jenis', 'objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
                }
                updateHierarchyDisplay();
                generateKodeBarang();
            });
            
            document.getElementById('kelompok')?.addEventListener('change', function() {
                const kelompokId = this.value;
                selectedHierarchy.kelompok = getSelectedOption(this);
                
                if (kelompokId) {
                    loadJenis(kelompokId);
                } else {
                    resetDropdowns(['jenis', 'objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
                }
                updateHierarchyDisplay();
                generateKodeBarang();
            });
            
            document.getElementById('jenis')?.addEventListener('change', function() {
                const jenisId = this.value;
                selectedHierarchy.jenis = getSelectedOption(this);
                
                if (jenisId) {
                    loadObjeks(jenisId);
                } else {
                    resetDropdowns(['objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
                }
                updateHierarchyDisplay();
                generateKodeBarang();
            });
            
            document.getElementById('objek')?.addEventListener('change', function() {
                const objekId = this.value;
                selectedHierarchy.objek = getSelectedOption(this);
                
                if (objekId) {
                    loadRincianObjeks(objekId);
                } else {
                    resetDropdowns(['rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
                }
                updateHierarchyDisplay();
                generateKodeBarang();
            });
            
            document.getElementById('rincian_objek')?.addEventListener('change', function() {
                const rincianObjekId = this.value;
                selectedHierarchy.rincian_objek = getSelectedOption(this);
                
                if (rincianObjekId) {
                    loadSubRincianObjeks(rincianObjekId);
                } else {
                    resetDropdowns(['sub_rincian_objek', 'sub_sub_rincian_objek']);
                }
                updateHierarchyDisplay();
                generateKodeBarang();
            });
            
            document.getElementById('sub_rincian_objek')?.addEventListener('change', function() {
                const subRincianObjekId = this.value;
                selectedHierarchy.sub_rincian_objek = getSelectedOption(this);
                
                if (subRincianObjekId) {
                    loadSubSubRincianObjeks(subRincianObjekId);
                } else {
                    resetDropdowns(['sub_sub_rincian_objek']);
                }
                updateHierarchyDisplay();
                generateKodeBarang();
            });
            
            document.getElementById('sub_sub_rincian_objek')?.addEventListener('change', function() {
                selectedHierarchy.sub_sub_rincian_objek = getSelectedOption(this);
                updateHierarchyDisplay();
                generateKodeBarang();
            });
        }
        
        function getSelectedOption(selectElement) {
            if (!selectElement.value) return null;
            
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            return {
                id: selectElement.value,
                text: selectedOption.text,
                kode: selectedOption.getAttribute('data-kode') || ''
            };
        }
        
        function showLoading(dropdownId) {
            const loading = document.getElementById(`loading-${dropdownId.replace('_', '-')}`);
            if (loading) loading.style.display = 'inline-block';
        }
        
        function hideLoading(dropdownId) {
            const loading = document.getElementById(`loading-${dropdownId.replace('_', '-')}`);
            if (loading) loading.style.display = 'none';
        }
        
        function showError(dropdownId, message) {
            const errorElement = document.getElementById(`error-${dropdownId.replace('_', '-')}`);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }
        
        function hideError(dropdownId) {
            const errorElement = document.getElementById(`error-${dropdownId.replace('_', '-')}`);
            if (errorElement) errorElement.style.display = 'none';
        }
        
        function resetDropdowns(dropdownIds) {
            dropdownIds.forEach(id => {
                const dropdown = document.getElementById(id);
                if (dropdown) {
                    dropdown.innerHTML = `<option value="">Pilih ${id.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</option>`;
                    dropdown.disabled = true;
                }
                hideError(id);
            });
        }
        
        // AJAX Functions
        async function loadKelompoks(akunId, selectedKelompokId = null) {
            showLoading('kelompok');
            hideError('kelompok');
            
            try {
                const response = await fetch(`/api/kelompoks/${akunId}`);
                const data = await response.json();
                
                const kelompokDropdown = document.getElementById('kelompok');
                kelompokDropdown.innerHTML = '<option value="">Pilih Kelompok</option>';
                
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.setAttribute('data-kode', item.kode);
                    option.textContent = `${item.kode} - ${item.nama}`;
                    if (selectedKelompokId && item.id == selectedKelompokId) {
                        option.selected = true;
                    }
                    kelompokDropdown.appendChild(option);
                });
                
                kelompokDropdown.disabled = false;
                
                // Jika ada selected kelompok, trigger change event
                if (selectedKelompokId) {
                    selectedHierarchy.kelompok = getSelectedOption(kelompokDropdown);
                    loadJenis(selectedKelompokId, currentAset.jenis_id);
                }
                
            } catch (error) {
                console.error('Error loading kelompoks:', error);
                showError('kelompok', 'Gagal memuat data kelompok');
            } finally {
                hideLoading('kelompok');
            }
        }
        
        async function loadJenis(kelompokId, selectedJenisId = null) {
            showLoading('jenis');
            hideError('jenis');
            
            try {
                const response = await fetch(`/api/jenis/${kelompokId}`);
                const data = await response.json();
                
                const jenisDropdown = document.getElementById('jenis');
                jenisDropdown.innerHTML = '<option value="">Pilih Jenis</option>';
                
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.setAttribute('data-kode', item.kode);
                    option.textContent = `${item.kode} - ${item.nama}`;
                    if (selectedJenisId && item.id == selectedJenisId) {
                        option.selected = true;
                    }
                    jenisDropdown.appendChild(option);
                });
                
                jenisDropdown.disabled = false;
                
                // Jika ada selected jenis, trigger change event
                if (selectedJenisId) {
                    selectedHierarchy.jenis = getSelectedOption(jenisDropdown);
                    loadObjeks(selectedJenisId, currentAset.objek_id);
                }
                
            } catch (error) {
                console.error('Error loading jenis:', error);
                showError('jenis', 'Gagal memuat data jenis');
            } finally {
                hideLoading('jenis');
            }
        }
        
        async function loadObjeks(jenisId, selectedObjekId = null) {
            showLoading('objek');
            hideError('objek');
            
            try {
                const response = await fetch(`/api/objeks/${jenisId}`);
                const data = await response.json();
                
                const objekDropdown = document.getElementById('objek');
                objekDropdown.innerHTML = '<option value="">Pilih Objek</option>';
                
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.setAttribute('data-kode', item.kode);
                    option.textContent = `${item.kode} - ${item.nama}`;
                    if (selectedObjekId && item.id == selectedObjekId) {
                        option.selected = true;
                    }
                    objekDropdown.appendChild(option);
                });
                
                objekDropdown.disabled = false;
                
                // Jika ada selected objek, trigger change event
                if (selectedObjekId) {
                    selectedHierarchy.objek = getSelectedOption(objekDropdown);
                    loadRincianObjeks(selectedObjekId, currentAset.rincian_objek_id);
                }
                
            } catch (error) {
                console.error('Error loading objeks:', error);
                showError('objek', 'Gagal memuat data objek');
            } finally {
                hideLoading('objek');
            }
        }
        
        async function loadRincianObjeks(objekId, selectedRincianObjekId = null) {
            showLoading('rincian_objek');
            hideError('rincian_objek');
            
            try {
                const response = await fetch(`/api/rincian-objeks/${objekId}`);
                const data = await response.json();
                
                const rincianObjekDropdown = document.getElementById('rincian_objek');
                rincianObjekDropdown.innerHTML = '<option value="">Pilih Rincian Objek</option>';
                
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.setAttribute('data-kode', item.kode);
                    option.textContent = `${item.kode} - ${item.nama}`;
                    if (selectedRincianObjekId && item.id == selectedRincianObjekId) {
                        option.selected = true;
                    }
                    rincianObjekDropdown.appendChild(option);
                });
                
                rincianObjekDropdown.disabled = false;
                
                // Jika ada selected rincian objek, trigger change event
                if (selectedRincianObjekId) {
                    selectedHierarchy.rincian_objek = getSelectedOption(rincianObjekDropdown);
                    loadSubRincianObjeks(selectedRincianObjekId, currentAset.sub_rincian_objek_id);
                }
                
            } catch (error) {
                console.error('Error loading rincian objeks:', error);
                showError('rincian_objek', 'Gagal memuat data rincian objek');
            } finally {
                hideLoading('rincian_objek');
            }
        }
        
        async function loadSubRincianObjeks(rincianObjekId, selectedSubRincianObjekId = null) {
            showLoading('sub_rincian_objek');
            hideError('sub_rincian_objek');
            
            try {
                const response = await fetch(`/api/sub-rincian-objeks/${rincianObjekId}`);
                const data = await response.json();
                
                const subRincianObjekDropdown = document.getElementById('sub_rincian_objek');
                subRincianObjekDropdown.innerHTML = '<option value="">Pilih Sub Rincian Objek</option>';
                
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.setAttribute('data-kode', item.kode);
                    option.textContent = `${item.kode} - ${item.nama}`;
                    if (selectedSubRincianObjekId && item.id == selectedSubRincianObjekId) {
                        option.selected = true;
                    }
                    subRincianObjekDropdown.appendChild(option);
                });
                
                subRincianObjekDropdown.disabled = false;
                
                // Jika ada selected sub rincian objek, trigger change event
                if (selectedSubRincianObjekId) {
                    selectedHierarchy.sub_rincian_objek = getSelectedOption(subRincianObjekDropdown);
                    loadSubSubRincianObjeks(selectedSubRincianObjekId, currentAset.sub_sub_rincian_objek_id);
                }
                
            } catch (error) {
                console.error('Error loading sub rincian objeks:', error);
                showError('sub_rincian_objek', 'Gagal memuat data sub rincian objek');
            } finally {
                hideLoading('sub_rincian_objek');
            }
        }
        
        async function loadSubSubRincianObjeks(subRincianObjekId, selectedSubSubRincianObjekId = null) {
            showLoading('sub_sub_rincian_objek');
            hideError('sub_sub_rincian_objek');
            
            try {
                const response = await fetch(`/api/sub-sub-rincian-objeks/${subRincianObjekId}`);
                const data = await response.json();
                
                const subSubRincianObjekDropdown = document.getElementById('sub_sub_rincian_objek');
                subSubRincianObjekDropdown.innerHTML = '<option value="">Pilih Sub Sub Rincian Objek</option>';
                
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.setAttribute('data-kode', item.kode);
                    option.textContent = `${item.kode} - ${item.nama}`;
                    if (selectedSubSubRincianObjekId && item.id == selectedSubSubRincianObjekId) {
                        option.selected = true;
                    }
                    subSubRincianObjekDropdown.appendChild(option);
                });
                
                subSubRincianObjekDropdown.disabled = false;
                
                // Jika ada selected sub sub rincian objek, set hierarchy
                if (selectedSubSubRincianObjekId) {
                    selectedHierarchy.sub_sub_rincian_objek = getSelectedOption(subSubRincianObjekDropdown);
                    updateHierarchyDisplay();
                    generateKodeBarang();
                }
                
            } catch (error) {
                console.error('Error loading sub sub rincian objeks:', error);
                showError('sub_sub_rincian_objek', 'Gagal memuat data sub sub rincian objek');
            } finally {
                hideLoading('sub_sub_rincian_objek');
            }
        }
        
        function updateHierarchyDisplay() {
            const hierarchyContent = document.getElementById('hierarchy-content');
            const hierarchyDisplay = document.getElementById('hierarchy-display');
            
            if (!hierarchyContent) return;
            
            let content = '';
            const levels = [
                { key: 'akun', label: 'Akun' },
                { key: 'kelompok', label: 'Kelompok' },
                { key: 'jenis', label: 'Jenis' },
                { key: 'objek', label: 'Objek' },
                { key: 'rincian_objek', label: 'Rincian Objek' },
                { key: 'sub_rincian_objek', label: 'Sub Rincian Objek' },
                { key: 'sub_sub_rincian_objek', label: 'Sub Sub Rincian Objek' }
            ];
            
            levels.forEach(level => {
                if (selectedHierarchy[level.key]) {
                    content += `
                        <div class="hierarchy-item">
                            <span class="hierarchy-level">${level.label}:</span> ${selectedHierarchy[level.key].text}
                        </div>
                    `;
                }
            });
            
            hierarchyContent.innerHTML = content || '<p class="text-muted">Belum ada hierarki yang dipilih</p>';
            hierarchyDisplay.style.display = content ? 'block' : 'none';
        }
        
        function generateKodeBarang() {
            let kodeBarang = '';
            
            // Generate kode berdasarkan hierarki yang dipilih
            if (selectedHierarchy.akun) kodeBarang += selectedHierarchy.akun.kode;
            if (selectedHierarchy.kelompok) kodeBarang += '.' + selectedHierarchy.kelompok.kode;
            if (selectedHierarchy.jenis) kodeBarang += '.' + selectedHierarchy.jenis.kode;
            if (selectedHierarchy.objek) kodeBarang += '.' + selectedHierarchy.objek.kode;
            if (selectedHierarchy.rincian_objek) kodeBarang += '.' + selectedHierarchy.rincian_objek.kode;
            if (selectedHierarchy.sub_rincian_objek) kodeBarang += '.' + selectedHierarchy.sub_rincian_objek.kode;
            if (selectedHierarchy.sub_sub_rincian_objek) kodeBarang += '.' + selectedHierarchy.sub_sub_rincian_objek.kode;
            
            // Update display
            const kodeBarangText = document.getElementById('kode-barang-text');
            const kodeBarangInput = document.getElementById('kode_barang');
            const kodePreview = document.getElementById('kode-preview');
            
            if (kodeBarangText) {
                kodeBarangText.textContent = kodeBarang || '-';
            }
            
            if (kodeBarangInput) {
                kodeBarangInput.value = kodeBarang;
            }
            
            if (kodePreview) {
                kodePreview.style.display = kodeBarang ? 'block' : 'none';
            }
        }
        
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '{{ route("asets.index") }}';
            }
        }
        
        // Form submission handler
        document.getElementById('assetForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Konfirmasi Update',
                text: 'Apakah Anda yakin ingin mengupdate data aset ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Mengupdate Aset...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit form
                    this.submit();
                }
            });
        });