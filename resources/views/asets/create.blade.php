<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Aset</title>
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
            display: none;
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
                    <i class="fas fa-boxes text-primary"></i> Form Tambah Aset
                </h2>
                <p class="text-muted">Lengkapi formulir di bawah ini untuk menambahkan aset baru</p>
            </div>
            
          <form id="assetForm" method="POST" action="{{ route('asets.store') }}" enctype="multipart/form-data">
    @csrf
                
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
                                    <option value="1" data-kode="01">01 - Aset Lancar</option>
                                    <option value="2" data-kode="02">02 - Investasi Jangka Panjang</option>
                                    <option value="3" data-kode="03">03 - Aset Tetap</option>
                                    <option value="4" data-kode="04">04 - Dana Cadangan</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-akun"></i>
                                <div class="error-message" id="error-akun"></div>
                            </div>
                            
                            <div class="dropdown-item">
                                <label class="dropdown-label">2. Kelompok <span class="required-field">*</span></label>
                                <select class="form-select" id="kelompok" name="kelompok_id" disabled required>
                                    <option value="">Pilih Kelompok</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-kelompok"></i>
                                <div class="error-message" id="error-kelompok"></div>
                            </div>
                            
                            <div class="dropdown-item">
                                <label class="dropdown-label">3. Jenis <span class="required-field">*</span></label>
                                <select class="form-select" id="jenis" name="jenis_id" disabled required>
                                    <option value="">Pilih Jenis</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-jenis"></i>
                                <div class="error-message" id="error-jenis"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="dropdown-item">
                                <label class="dropdown-label">4. Objek <span class="required-field">*</span></label>
                                <select class="form-select" id="objek" name="objek_id" disabled required>
                                    <option value="">Pilih Objek</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-objek"></i>
                                <div class="error-message" id="error-objek"></div>
                            </div>
                            
                            <div class="dropdown-item">
                                <label class="dropdown-label">5. Rincian Objek <span class="required-field">*</span></label>
                                <select class="form-select" id="rincian_objek" name="rincian_objek_id" disabled required>
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
                                <select class="form-select" id="sub_rincian_objek" name="sub_rincian_objek_id" disabled required>
                                    <option value="">Pilih Sub Rincian Objek</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-sub-rincian-objek"></i>
                                <div class="error-message" id="error-sub-rincian-objek"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="dropdown-item">
                                <label class="dropdown-label">7. Sub Sub Rincian Objek <span class="required-field">*</span></label>
                                <select class="form-select" id="sub_sub_rincian_objek" name="sub_sub_rincian_objek_id" disabled required>
                                    <option value="">Pilih Sub Sub Rincian Objek</option>
                                </select>
                                <i class="fas fa-spinner fa-spin loading" id="loading-sub-sub-rincian-objek"></i>
                                <div class="error-message" id="error-sub-sub-rincian-objek"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Display Hierarki yang dipilih -->
                <div class="hierarchy-display fade-in" id="hierarchy-display" style="display: none;">
                    <h6><i class="fas fa-list"></i> Hierarki Yang Dipilih:</h6>
                    <div id="hierarchy-content"></div>
                </div>
                
                <!-- Kode Barang Preview -->
                <div class="kode-preview fade-in" id="kode-preview">
                    <i class="fas fa-barcode"></i> Kode Barang: <span id="kode-barang-text">-</span>
                    <input type="hidden" name="kode_barang" id="kode_barang">
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
                                       placeholder="Masukkan nama bidang barang">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Register <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="register" required 
                                       placeholder="Masukkan nomor register">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Jenis Barang <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="nama_jenis_barang" required 
                                       placeholder="Masukkan nama jenis barang">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Asal Perolehan <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="asal_perolehan" required 
                                       placeholder="Masukkan asal perolehan">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Satuan <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="satuan" required 
                                       placeholder="Contoh: Unit, Buah, Set">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Keadaan Barang <span class="required-field">*</span></label>
                                <select class="form-select" name="keadaan_barang" required>
                                    <option value="">Pilih Keadaan Barang</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Kurang Baik">Kurang Baik</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Jumlah Barang <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="jumlah_barang" min="1" required 
                                       placeholder="Masukkan jumlah barang">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Harga Satuan <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="harga_satuan" min="0" step="0.01" required 
                                       placeholder="Masukkan harga satuan">
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
                                       placeholder="Masukkan merk atau type barang">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. Sertifikat</label>
                                <input type="text" class="form-control" name="no_sertifikat" 
                                       placeholder="Masukkan nomor sertifikat">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. Plat Kendaraan</label>
                                <input type="text" class="form-control" name="no_plat_kendaraan" 
                                       placeholder="Masukkan nomor plat kendaraan">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. Pabrik</label>
                                <input type="text" class="form-control" name="no_pabrik" 
                                       placeholder="Masukkan nomor pabrik">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No. Casis</label>
                                <input type="text" class="form-control" name="no_casis" 
                                       placeholder="Masukkan nomor casis">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Bahan</label>
                                <input type="text" class="form-control" name="bahan" 
                                       placeholder="Masukkan bahan barang">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Ukuran Barang / Konstruksi</label>
                                <input type="text" class="form-control" name="ukuran_barang_konstruksi" 
                                       placeholder="Masukkan ukuran barang atau konstruksi">
                            </div>
                            
                          <div class="mb-3">
    <label class="form-label">Bukti Barang</label>
    <input type="file" class="form-control" name="bukti_barang" 
           accept="image/jpeg,image/png,image/jpg,image/gif">
    <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
</div>

<div class="mb-3">
    <label class="form-label">Bukti Berita</label>
    <input type="file" class="form-control" name="bukti_berita" 
           accept="application/pdf">
    <small class="text-muted">Format: PDF. Maksimal 10MB</small>
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
                        <i class="fas fa-save"></i> Simpan Aset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.all.min.js"></script>
   </body>
<script>
    let selectedHierarchy = {};
    
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        
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
    
    function setupEventListeners() {
        // Event listeners untuk setiap dropdown
        document.getElementById('akun')?.addEventListener('change', function() {
            const akunId = this.value;
            selectedHierarchy.akun = getSelectedOption(this);
            
            if (akunId) {
                loadKelompoks(akunId);
                resetDropdowns(['kelompok', 'jenis', 'objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
            } else {
                resetAllDropdowns();
            }
            updateHierarchyDisplay();
            updateKodeBarang();
        });
        
        document.getElementById('kelompok')?.addEventListener('change', function() {
            const kelompokId = this.value;
            selectedHierarchy.kelompok = getSelectedOption(this);
            
            if (kelompokId) {
                loadJenis(kelompokId);
                resetDropdowns(['jenis', 'objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
            } else {
                resetDropdowns(['jenis', 'objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
            }
            updateHierarchyDisplay();
            updateKodeBarang();
        });
        
        document.getElementById('jenis')?.addEventListener('change', function() {
            const jenisId = this.value;
            selectedHierarchy.jenis = getSelectedOption(this);
            
            if (jenisId) {
                loadObjeks(jenisId);
                resetDropdowns(['objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
            } else {
                resetDropdowns(['objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
            }
            updateHierarchyDisplay();
            updateKodeBarang();
        });
        
        document.getElementById('objek')?.addEventListener('change', function() {
            const objekId = this.value;
            selectedHierarchy.objek = getSelectedOption(this);
            
            if (objekId) {
                loadRincianObjeks(objekId);
                resetDropdowns(['rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
            } else {
                resetDropdowns(['rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
            }
            updateHierarchyDisplay();
            updateKodeBarang();
        });
        
        document.getElementById('rincian_objek')?.addEventListener('change', function() {
            const rincianObjekId = this.value;
            selectedHierarchy.rincianObjek = getSelectedOption(this);
            
            if (rincianObjekId) {
                loadSubRincianObjeks(rincianObjekId);
                resetDropdowns(['sub_rincian_objek', 'sub_sub_rincian_objek']);
            } else {
                resetDropdowns(['sub_rincian_objek', 'sub_sub_rincian_objek']);
            }
            updateHierarchyDisplay();
            updateKodeBarang();
        });
        
        document.getElementById('sub_rincian_objek')?.addEventListener('change', function() {
            const subRincianObjekId = this.value;
            selectedHierarchy.subRincianObjek = getSelectedOption(this);
            
            if (subRincianObjekId) {
                loadSubSubRincianObjeks(subRincianObjekId);
                resetDropdowns(['sub_sub_rincian_objek']);
            } else {
                resetDropdowns(['sub_sub_rincian_objek']);
            }
            updateHierarchyDisplay();
            updateKodeBarang();
        });
        
        document.getElementById('sub_sub_rincian_objek')?.addEventListener('change', function() {
            selectedHierarchy.subSubRincianObjek = getSelectedOption(this);
            updateHierarchyDisplay();
            updateKodeBarang();
        });
        
        // Form submission handler
        document.getElementById('assetForm')?.addEventListener('submit', function(e) {
            const isValid = validateDropdowns();
            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap lengkapi semua level hierarki aset yang wajib diisi!',
                });
                return;
            }
            
            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Sedang memproses data aset',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    }
    
    function getSelectedOption(selectElement) {
    if (!selectElement) return null;
    
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    if (selectedOption && selectedOption.value) {
        // Ambil kode dari data-kode attribute yang sudah diset saat populate
        const kode = selectedOption.dataset.kode || '';
        
        // Ambil nama dari text content (hilangkan bagian kode di depan)
        let nama = selectedOption.textContent;
        if (nama.includes(' - ')) {
            nama = nama.split(' - ').slice(1).join(' - '); // Ambil setelah " - "
        }
        
        return {
            id: selectedOption.value,
            nama: nama,
            kode: kode
        };
    }
    return null;
}

    
    function loadKelompoks(akunId) {
        const select = document.getElementById('kelompok');
        if (!select) return;
        
        showLoading('kelompok');
        
        fetch(`/api/asets/kelompoks/${akunId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    populateSelect(select, data.data, 'Pilih Kelompok');
                    select.disabled = data.data.length === 0;
                    hideError('kelompok');
                } else {
                    showError('kelompok', data.message || 'Gagal memuat data kelompok');
                    select.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error loading kelompoks:', error);
                showError('kelompok', 'Terjadi kesalahan saat memuat data');
                select.disabled = true;
            })
            .finally(() => {
                hideLoading('kelompok');
            });
    }
    
    function loadJenis(kelompokId) {
        const select = document.getElementById('jenis');
        if (!select) return;
        
        showLoading('jenis');
        
        fetch(`/api/asets/jenis/${kelompokId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    populateSelect(select, data.data, 'Pilih Jenis');
                    select.disabled = data.data.length === 0;
                    hideError('jenis');
                } else {
                    showError('jenis', data.message || 'Gagal memuat data jenis');
                    select.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error loading jenis:', error);
                showError('jenis', 'Terjadi kesalahan saat memuat data');
                select.disabled = true;
            })
            .finally(() => {
                hideLoading('jenis');
            });
    }
    
    function loadObjeks(jenisId) {
        const select = document.getElementById('objek');
        if (!select) return;
        
        showLoading('objek');
        
        fetch(`/api/asets/objeks/${jenisId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    populateSelect(select, data.data, 'Pilih Objek');
                    select.disabled = data.data.length === 0;
                    hideError('objek');
                } else {
                    showError('objek', data.message || 'Gagal memuat data objek');
                    select.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error loading objeks:', error);
                showError('objek', 'Terjadi kesalahan saat memuat data');
                select.disabled = true;
            })
            .finally(() => {
                hideLoading('objek');
            });
    }
    
    function loadRincianObjeks(objekId) {
        const select = document.getElementById('rincian_objek');
        if (!select) return;
        
        showLoading('rincian-objek');
        
        fetch(`/api/asets/rincian-objeks/${objekId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    populateSelect(select, data.data, 'Pilih Rincian Objek');
                    select.disabled = data.data.length === 0;
                    hideError('rincian-objek');
                } else {
                    showError('rincian-objek', data.message || 'Gagal memuat data rincian objek');
                    select.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error loading rincian objeks:', error);
                showError('rincian-objek', 'Terjadi kesalahan saat memuat data');
                select.disabled = true;
            })
            .finally(() => {
                hideLoading('rincian-objek');
            });
    }
    
    function loadSubRincianObjeks(rincianObjekId) {
        const select = document.getElementById('sub_rincian_objek');
        if (!select) return;
        
        showLoading('sub-rincian-objek');
        
        fetch(`/api/asets/sub-rincian-objeks/${rincianObjekId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    populateSelect(select, data.data, 'Pilih Sub Rincian Objek');
                    select.disabled = data.data.length === 0;
                    hideError('sub-rincian-objek');
                } else {
                    showError('sub-rincian-objek', data.message || 'Gagal memuat data sub rincian objek');
                    select.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error loading sub rincian objeks:', error);
                showError('sub-rincian-objek', 'Terjadi kesalahan saat memuat data');
                select.disabled = true;
            })
            .finally(() => {
                hideLoading('sub-rincian-objek');
            });
    }
    
    function loadSubSubRincianObjeks(subRincianObjekId) {
        const select = document.getElementById('sub_sub_rincian_objek');
        if (!select) return;
        
        showLoading('sub-sub-rincian-objek');
        
        fetch(`/api/asets/sub-sub-rincian-objeks/${subRincianObjekId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    populateSelect(select, data.data, 'Pilih Sub Sub Rincian Objek', 'nama_barang');
                    select.disabled = data.data.length === 0;
                    hideError('sub-sub-rincian-objek');
                } else {
                    showError('sub-sub-rincian-objek', data.message || 'Gagal memuat data sub sub rincian objek');
                    select.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error loading sub sub rincian objeks:', error);
                showError('sub-sub-rincian-objek', 'Terjadi kesalahan saat memuat data');
                select.disabled = true;
            })
            .finally(() => {
                hideLoading('sub-sub-rincian-objek');
            });
    }
    
   function populateSelect(select, data, placeholder, nameField = 'nama') {
    if (!select) return;
    
    select.innerHTML = `<option value="">${placeholder}</option>`;
    
    data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = `${item.kode} - ${item[nameField]}`;
        
        // PENTING: Set data-kode dengan kode murni dari database
        option.dataset.kode = item.kode;
        
        select.appendChild(option);
    });
}
    
    function resetDropdowns(dropdownIds) {
        dropdownIds.forEach(id => {
            const select = document.getElementById(id);
            if (select) {
                select.innerHTML = '<option value="">Pilih...</option>';
                select.disabled = true;
                const errorId = id.replace(/_/g, '-');
                hideError(errorId);
                
                // Clear from selectedHierarchy
                const key = id.replace(/_/g, '').replace('objek', 'Objek');
                if (selectedHierarchy[key]) {
                    delete selectedHierarchy[key];
                }
            }
        });
    }
    
    function resetAllDropdowns() {
        resetDropdowns(['kelompok', 'jenis', 'objek', 'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek']);
        hideKodePreview();
        selectedHierarchy = {};
        updateHierarchyDisplay();
    }
    
    function showLoading(type) {
        const loadingElement = document.getElementById(`loading-${type}`);
        if (loadingElement) loadingElement.style.display = 'inline-block';
    }
    
    function hideLoading(type) {
        const loadingElement = document.getElementById(`loading-${type}`);
        if (loadingElement) loadingElement.style.display = 'none';
    }
    
    function showError(field, message) {
        const errorElement = document.getElementById(`error-${field}`);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }
    
    function hideError(field) {
        const errorElement = document.getElementById(`error-${field}`);
        if (errorElement) errorElement.style.display = 'none';
    }
    
    function validateDropdowns() {
        let isValid = true;
        const dropdowns = [
            'akun', 'kelompok', 'jenis', 'objek', 
            'rincian_objek', 'sub_rincian_objek', 'sub_sub_rincian_objek'
        ];
        
        dropdowns.forEach(dropdownId => {
            const select = document.getElementById(dropdownId);
            if (select && !select.value) {
                const fieldName = dropdownId.replace(/_/g, '-');
                showError(fieldName, 'Field ini wajib diisi');
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    // FUNCTION BARU: Generate kode barang otomatis tanpa API
    function updateKodeBarang() {
        // Generate kode barang automatically when all hierarchy is selected
        if (selectedHierarchy.akun && selectedHierarchy.kelompok && selectedHierarchy.jenis && 
            selectedHierarchy.objek && selectedHierarchy.rincianObjek && 
            selectedHierarchy.subRincianObjek && selectedHierarchy.subSubRincianObjek) {
            
            // Generate kode barang from hierarchy
            const kodeBarang = generateKodeFromHierarchy();
            
            if (kodeBarang) {
                document.getElementById('kode-barang-text').textContent = kodeBarang;
                document.getElementById('kode_barang').value = kodeBarang;
                document.getElementById('kode-preview').style.display = 'block';
            }
        } else {
            hideKodePreview();
        }
    }
    
    // FUNCTION BARU: Generate kode dari hierarki yang dipilih
   function generateKodeFromHierarchy() {
    try {
        // Pastikan semua level hierarki sudah dipilih
        if (!selectedHierarchy.subSubRincianObjek?.kode) {
            return null;
        }
        
        // Ambil kode dari level terakhir (sub_sub_rincian_objek) 
        // karena sudah merupakan kode lengkap dari database
        let kode = selectedHierarchy.subSubRincianObjek.kode;
        
        // Tambahkan nomor urut otomatis hanya jika diperlukan
        // (biasanya untuk membedakan barang yang sama jenisnya)
        const timestamp = Date.now().toString().slice(-4);
        
        // Return kode tanpa menambah timestamp jika tidak diperlukan
        // atau bisa disesuaikan dengan kebutuhan
        return kode; // Contoh: 1.1.1.01.01.01.001
        
        // Jika perlu nomor unik tambahan:
        // return kode + '.' + timestamp;
        
    } catch (error) {
        console.error('Error generating kode barang:', error);
        return null;
    }
}
    
    function hideKodePreview() {
        const preview = document.getElementById('kode-preview');
        const kodeInput = document.getElementById('kode_barang');
        if (preview) preview.style.display = 'none';
        if (kodeInput) kodeInput.value = '';
    }
    
    function updateHierarchyDisplay() {
        const hierarchyDisplay = document.getElementById('hierarchy-display');
        const hierarchyContent = document.getElementById('hierarchy-content');
        
        if (!hierarchyDisplay || !hierarchyContent) return;
        
        let content = '';
        
        if (selectedHierarchy.akun) {
            content += `<div class="hierarchy-item"><span class="hierarchy-level">Akun:</span> ${selectedHierarchy.akun.nama}</div>`;
        }
        if (selectedHierarchy.kelompok) {
            content += `<div class="hierarchy-item"><span class="hierarchy-level">Kelompok:</span> ${selectedHierarchy.kelompok.nama}</div>`;
        }
        if (selectedHierarchy.jenis) {
            content += `<div class="hierarchy-item"><span class="hierarchy-level">Jenis:</span> ${selectedHierarchy.jenis.nama}</div>`;
        }
        if (selectedHierarchy.objek) {
            content += `<div class="hierarchy-item"><span class="hierarchy-level">Objek:</span> ${selectedHierarchy.objek.nama}</div>`;
        }
        if (selectedHierarchy.rincianObjek) {
            content += `<div class="hierarchy-item"><span class="hierarchy-level">Rincian Objek:</span> ${selectedHierarchy.rincianObjek.nama}</div>`;
        }
        if (selectedHierarchy.subRincianObjek) {
            content += `<div class="hierarchy-item"><span class="hierarchy-level">Sub Rincian Objek:</span> ${selectedHierarchy.subRincianObjek.nama}</div>`;
        }
        if (selectedHierarchy.subSubRincianObjek) {
            content += `<div class="hierarchy-item"><span class="hierarchy-level">Sub Sub Rincian:</span> ${selectedHierarchy.subSubRincianObjek.nama}</div>`;
        }
        
        if (content) {
            hierarchyContent.innerHTML = content;
            hierarchyDisplay.style.display = 'block';
        } else {
            hierarchyDisplay.style.display = 'none';
        }
    }
</script>
</body>
</html>