@extends('layouts.tabler')

@section('title', 'Edit Aset')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Aset</h1>
            <p class="text-gray-600 mt-2">Ubah informasi aset yang sudah ada</p>
        </div>
        <a href="{{ route('asets.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <!-- Alert Messages -->
<div class="mb-6">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

    <!-- Form -->
    <form action="{{ route('asets.update', $aset->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- Hierarchy Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-sitemap text-blue-600 mr-3"></i>
                Hierarki Klasifikasi
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Akun -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Akun <span class="text-red-500">*</span>
                    </label>
                    <select name="akun_id" id="akun_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('akun_id') border-red-500 @enderror">
                        <option value="">Pilih Akun</option>
                        @foreach($akuns as $akun)
                            <option value="{{ $akun->id }}" {{ $hierarchy['akun']->id == $akun->id ? 'selected' : '' }}>
                                {{ $akun->kode }} - {{ $akun->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('akun_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelompok -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Kelompok <span class="text-red-500">*</span>
                    </label>
                    <select name="kelompok_id" id="kelompok_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kelompok_id') border-red-500 @enderror">
                        <option value="">Pilih Kelompok</option>
                        @foreach($kelompoks as $kelompok)
                            <option value="{{ $kelompok->id }}" {{ $hierarchy['kelompok']->id == $kelompok->id ? 'selected' : '' }}>
                                {{ $kelompok->kode }} - {{ $kelompok->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelompok_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Jenis <span class="text-red-500">*</span>
                    </label>
                    <select name="jenis_id" id="jenis_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis_id') border-red-500 @enderror">
                        <option value="">Pilih Jenis</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->id }}" {{ $hierarchy['jenis']->id == $j->id ? 'selected' : '' }}>
                                {{ $j->kode }} - {{ $j->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Objek -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Objek <span class="text-red-500">*</span>
                    </label>
                    <select name="objek_id" id="objek_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('objek_id') border-red-500 @enderror">
                        <option value="">Pilih Objek</option>
                        @foreach($objeks as $objek)
                            <option value="{{ $objek->id }}" {{ $hierarchy['objek']->id == $objek->id ? 'selected' : '' }}>
                                {{ $objek->kode }} - {{ $objek->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('objek_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rincian Objek -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Rincian Objek <span class="text-red-500">*</span>
                    </label>
                    <select name="rincian_objek_id" id="rincian_objek_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('rincian_objek_id') border-red-500 @enderror">
                        <option value="">Pilih Rincian Objek</option>
                        @foreach($rincianObjeks as $rincianObjek)
                            <option value="{{ $rincianObjek->id }}" {{ $hierarchy['rincianObjek']->id == $rincianObjek->id ? 'selected' : '' }}>
                                {{ $rincianObjek->kode }} - {{ $rincianObjek->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('rincian_objek_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sub Rincian Objek -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Sub Rincian Objek <span class="text-red-500">*</span>
                    </label>
                    <select name="sub_rincian_objek_id" id="sub_rincian_objek_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sub_rincian_objek_id') border-red-500 @enderror">
                        <option value="">Pilih Sub Rincian Objek</option>
                        @foreach($subRincianObjeks as $subRincianObjek)
                            <option value="{{ $subRincianObjek->id }}" {{ $hierarchy['subRincianObjek']->id == $subRincianObjek->id ? 'selected' : '' }}>
                                {{ $subRincianObjek->kode }} - {{ $subRincianObjek->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('sub_rincian_objek_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sub Sub Rincian Objek -->
                <div class="space-y-2 md:col-span-2 lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700">
                        Sub Sub Rincian Objek <span class="text-red-500">*</span>
                    </label>
                    <select name="sub_sub_rincian_objek_id" id="sub_sub_rincian_objek_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sub_sub_rincian_objek_id') border-red-500 @enderror">
                        <option value="">Pilih Sub Sub Rincian Objek</option>
                        @foreach($subSubRincianObjeks as $subSubRincianObjek)
                            <option value="{{ $subSubRincianObjek->id }}" {{ $hierarchy['subSubRincianObjek']->id == $subSubRincianObjek->id ? 'selected' : '' }}>
                                {{ $subSubRincianObjek->kode }} - {{ $subSubRincianObjek->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                    @error('sub_sub_rincian_objek_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Asset Information Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-box text-green-600 mr-3"></i>
                Informasi Aset
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Register -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Register <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="register" id="register" 
                           value="{{ old('register', $aset->register) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('register') border-red-500 @enderror">
                    @error('register')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kode Barang -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Kode Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_barang" id="kode_barang" 
                           value="{{ old('kode_barang', $aset->kode_barang) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100 @error('kode_barang') border-red-500 @enderror" readonly>
                    @error('kode_barang')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">Kode barang akan di-generate otomatis</p>
                </div>

                <!-- Nama Bidang Barang -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Nama Bidang Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_bidang_barang" 
                           value="{{ old('nama_bidang_barang', $aset->nama_bidang_barang) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_bidang_barang') border-red-500 @enderror">
                    @error('nama_bidang_barang')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Jenis Barang -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Nama Jenis Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_jenis_barang" 
                           value="{{ old('nama_jenis_barang', $aset->nama_jenis_barang) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_jenis_barang') border-red-500 @enderror">
                    @error('nama_jenis_barang')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Merk/Type -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Merk/Type
                    </label>
                    <input type="text" name="merk_type" 
                           value="{{ old('merk_type', $aset->merk_type) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Asal Perolehan -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Asal Perolehan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="asal_perolehan" 
                           value="{{ old('asal_perolehan', $aset->asal_perolehan) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('asal_perolehan') border-red-500 @enderror">
                    @error('asal_perolehan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun Perolehan -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Tahun Perolehan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tahun_perolehan" 
                           value="{{ old('tahun_perolehan', $aset->tahun_perolehan) }}"
                           min="1900" max="{{ date('Y') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tahun_perolehan') border-red-500 @enderror">
                    @error('tahun_perolehan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Satuan -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Satuan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="satuan" 
                           value="{{ old('satuan', $aset->satuan) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('satuan') border-red-500 @enderror">
                    @error('satuan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keadaan Barang -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Keadaan Barang <span class="text-red-500">*</span>
                    </label>
                    <select name="keadaan_barang" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keadaan_barang') border-red-500 @enderror">
                        <option value="">Pilih Keadaan</option>
                        <option value="Baik" {{ old('keadaan_barang', $aset->keadaan_barang) == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Kurang Baik" {{ old('keadaan_barang', $aset->keadaan_barang) == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
                        <option value="Rusak Berat" {{ old('keadaan_barang', $aset->keadaan_barang) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('keadaan_barang')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
    <label class="block text-sm font-medium text-gray-700">
        Jumlah Barang <span class="text-red-500">*</span>
    </label>
    <input type="number" name="jumlah_barang" 
           value="{{ old('jumlah_barang', $aset->jumlah_barang) }}"
           min="1" max="100"
           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jumlah_barang') border-red-500 @enderror">
    <p class="text-xs text-gray-500">Jumlah barang untuk aset ini (maksimal 100)</p>
    @error('jumlah_barang')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

                <!-- Harga Satuan -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Harga Satuan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="harga_satuan" 
                           value="{{ old('harga_satuan', $aset->harga_satuan) }}"
                           min="0" step="0.01"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga_satuan') border-red-500 @enderror">
                    @error('harga_satuan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Additional Details Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-info-circle text-purple-600 mr-3"></i>
                Detail Tambahan
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- No Sertifikat -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">No Sertifikat</label>
                    <input type="text" name="no_sertifikat" 
                           value="{{ old('no_sertifikat', $aset->no_sertifikat) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- No Plat Kendaraan -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">No Plat Kendaraan</label>
                    <input type="text" name="no_plat_kendaraan" 
                           value="{{ old('no_plat_kendaraan', $aset->no_plat_kendaraan) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- No Pabrik -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">No Pabrik</label>
                    <input type="text" name="no_pabrik" 
                           value="{{ old('no_pabrik', $aset->no_pabrik) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- No Casis -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">No Casis</label>
                    <input type="text" name="no_casis" 
                           value="{{ old('no_casis', $aset->no_casis) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Bahan -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Bahan</label>
                    <input type="text" name="bahan" 
                           value="{{ old('bahan', $aset->bahan) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Ukuran Barang/Konstruksi -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Ukuran Barang/Konstruksi</label>
                    <input type="text" name="ukuran_barang_konstruksi" 
                           value="{{ old('ukuran_barang_konstruksi', $aset->ukuran_barang_konstruksi) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- File Uploads Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-file-upload text-orange-600 mr-3"></i>
                Dokumen Pendukung
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bukti Barang -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Bukti Barang (Gambar)</label>
                    @if($aset->bukti_barang)
                        <div class="mb-2">
                            <p class="text-sm text-gray-600 mb-2">File saat ini: {{ $aset->bukti_barang }}</p>
                            <img src="{{ Storage::url('bukti_barang/' . $aset->bukti_barang) }}" 
                                 alt="Bukti Barang" class="w-32 h-32 object-cover rounded-lg border">
                        </div>
                    @endif
                    <input type="file" name="bukti_barang" 
                           accept="image/jpeg,image/png,image/jpg,image/gif"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bukti_barang') border-red-500 @enderror">
                    @error('bukti_barang')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                </div>

                <!-- Bukti Berita -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Bukti Berita (PDF)</label>
                    @if($aset->bukti_berita)
                        <div class="mb-2">
                            <p class="text-sm text-gray-600 mb-2">File saat ini: {{ $aset->bukti_berita }}</p>
                            <a href="{{ Storage::url('bukti_berita/' . $aset->bukti_berita) }}" 
                               target="_blank" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                <i class="fas fa-file-pdf mr-2"></i>Lihat PDF
                            </a>
                        </div>
                    @endif
                    <input type="file" name="bukti_berita" 
                           accept="application/pdf"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bukti_berita') border-red-500 @enderror">
                    @error('bukti_berita')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">Format: PDF. Maksimal 10MB</p>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end space-x-4">
            <button type="button" onclick="window.history.back()" 
                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                Batal
            </button>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Edit page JavaScript loaded');
    
    // Get all dropdown elements
    const akunSelect = document.getElementById('akun_id');
    const kelompokSelect = document.getElementById('kelompok_id');
    const jenisSelect = document.getElementById('jenis_id');
    const objekSelect = document.getElementById('objek_id');
    const rincianObjekSelect = document.getElementById('rincian_objek_id');
    const subRincianObjekSelect = document.getElementById('sub_rincian_objek_id');
    const subSubRincianObjekSelect = document.getElementById('sub_sub_rincian_objek_id');
    const kodeBarangInput = document.getElementById('kode_barang');
    
    // Check if all elements exist
    if (!akunSelect || !kelompokSelect || !jenisSelect) {
        console.error('Required dropdown elements not found');
        return;
    }

    // Helper function to clear and populate dropdown
    function clearAndPopulateDropdown(dropdown, data, textKey = 'nama') {
        if (!dropdown) return;
        
        dropdown.innerHTML = '<option value="">Pilih...</option>';
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = `${item.kode} - ${item[textKey]}`;
            dropdown.appendChild(option);
        });
    }

    // Helper function to clear dropdown
    function clearDropdown(dropdown, placeholder = 'Pilih...') {
        if (!dropdown) return;
        dropdown.innerHTML = `<option value="">${placeholder}</option>`;
    }

    // Helper function to show loading state
    function showLoading(dropdown) {
        if (!dropdown) return;
        dropdown.innerHTML = '<option value="">Loading...</option>';
        dropdown.disabled = true;
    }

    // Helper function to enable dropdown
    function enableDropdown(dropdown) {
        if (!dropdown) return;
        dropdown.disabled = false;
    }

    // Helper function to handle fetch errors
    function handleFetchError(error, dropdown, dropdownName) {
        console.error(`Error fetching ${dropdownName}:`, error);
        enableDropdown(dropdown);
        clearDropdown(dropdown, `Error loading ${dropdownName}`);
    }

    // Akun change handler
    akunSelect.addEventListener('change', function() {
        const akunId = this.value;
        console.log('Akun changed:', akunId);
        
        // Clear dependent dropdowns
        clearDropdown(kelompokSelect, 'Pilih Kelompok');
        clearDropdown(jenisSelect, 'Pilih Jenis');
        clearDropdown(objekSelect, 'Pilih Objek');
        clearDropdown(rincianObjekSelect, 'Pilih Rincian Objek');
        clearDropdown(subRincianObjekSelect, 'Pilih Sub Rincian Objek');
        clearDropdown(subSubRincianObjekSelect, 'Pilih Sub Sub Rincian Objek');
        if (kodeBarangInput) kodeBarangInput.value = '';
        
        if (akunId) {
            showLoading(kelompokSelect);
            
            fetch(`/asets/kelompoks/${akunId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    enableDropdown(kelompokSelect);
                    if (data.success) {
                        clearAndPopulateDropdown(kelompokSelect, data.data);
                    } else {
                        console.error('API Error:', data.message);
                        clearDropdown(kelompokSelect, 'Error loading data');
                    }
                })
                .catch(error => handleFetchError(error, kelompokSelect, 'kelompok'));
        }
    });

    // Kelompok change handler
    kelompokSelect.addEventListener('change', function() {
        const kelompokId = this.value;
        console.log('Kelompok changed:', kelompokId);
        
        // Clear dependent dropdowns
        clearDropdown(jenisSelect, 'Pilih Jenis');
        clearDropdown(objekSelect, 'Pilih Objek');
        clearDropdown(rincianObjekSelect, 'Pilih Rincian Objek');
        clearDropdown(subRincianObjekSelect, 'Pilih Sub Rincian Objek');
        clearDropdown(subSubRincianObjekSelect, 'Pilih Sub Sub Rincian Objek');
        if (kodeBarangInput) kodeBarangInput.value = '';
        
        if (kelompokId) {
            showLoading(jenisSelect);
            
            fetch(`/asets/jenis/${kelompokId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    enableDropdown(jenisSelect);
                    if (data.success) {
                        clearAndPopulateDropdown(jenisSelect, data.data);
                    } else {
                        console.error('API Error:', data.message);
                        clearDropdown(jenisSelect, 'Error loading data');
                    }
                })
                .catch(error => handleFetchError(error, jenisSelect, 'jenis'));
        }
    });

    // Jenis change handler
    jenisSelect.addEventListener('change', function() {
        const jenisId = this.value;
        console.log('Jenis changed:', jenisId);
        
        // Clear dependent dropdowns
        clearDropdown(objekSelect, 'Pilih Objek');
        clearDropdown(rincianObjekSelect, 'Pilih Rincian Objek');
        clearDropdown(subRincianObjekSelect, 'Pilih Sub Rincian Objek');
        clearDropdown(subSubRincianObjekSelect, 'Pilih Sub Sub Rincian Objek');
        if (kodeBarangInput) kodeBarangInput.value = '';
        
        if (jenisId) {
            showLoading(objekSelect);
            
            fetch(`/asets/objeks/${jenisId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    enableDropdown(objekSelect);
                    if (data.success) {
                        clearAndPopulateDropdown(objekSelect, data.data);
                    } else {
                        console.error('API Error:', data.message);
                        clearDropdown(objekSelect, 'Error loading data');
                    }
                })
                .catch(error => handleFetchError(error, objekSelect, 'objek'));
        }
    });

    // Objek change handler
    objekSelect.addEventListener('change', function() {
        const objekId = this.value;
        console.log('Objek changed:', objekId);
        
        // Clear dependent dropdowns
        clearDropdown(rincianObjekSelect, 'Pilih Rincian Objek');
        clearDropdown(subRincianObjekSelect, 'Pilih Sub Rincian Objek');
        clearDropdown(subSubRincianObjekSelect, 'Pilih Sub Sub Rincian Objek');
        if (kodeBarangInput) kodeBarangInput.value = '';
        
        if (objekId) {
            showLoading(rincianObjekSelect);
            
            fetch(`/asets/rincian-objeks/${objekId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    enableDropdown(rincianObjekSelect);
                    if (data.success) {
                        clearAndPopulateDropdown(rincianObjekSelect, data.data);
                    } else {
                        console.error('API Error:', data.message);
                        clearDropdown(rincianObjekSelect, 'Error loading data');
                    }
                })
                .catch(error => handleFetchError(error, rincianObjekSelect, 'rincian objek'));
        }
    });

    // Rincian Objek change handler
    rincianObjekSelect.addEventListener('change', function() {
        const rincianObjekId = this.value;
        console.log('Rincian Objek changed:', rincianObjekId);
        
        // Clear dependent dropdowns
        clearDropdown(subRincianObjekSelect, 'Pilih Sub Rincian Objek');
        clearDropdown(subSubRincianObjekSelect, 'Pilih Sub Sub Rincian Objek');
        if (kodeBarangInput) kodeBarangInput.value = '';
        
        if (rincianObjekId) {
            showLoading(subRincianObjekSelect);
            
            fetch(`/asets/sub-rincian-objeks/${rincianObjekId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    enableDropdown(subRincianObjekSelect);
                    if (data.success) {
                        clearAndPopulateDropdown(subRincianObjekSelect, data.data);
                    } else {
                        console.error('API Error:', data.message);
                        clearDropdown(subRincianObjekSelect, 'Error loading data');
                    }
                })
                .catch(error => handleFetchError(error, subRincianObjekSelect, 'sub rincian objek'));
        }
    });

    // Sub Rincian Objek change handler
    subRincianObjekSelect.addEventListener('change', function() {
        const subRincianObjekId = this.value;
        console.log('Sub Rincian Objek changed:', subRincianObjekId);
        
        // Clear dependent dropdowns
        clearDropdown(subSubRincianObjekSelect, 'Pilih Sub Sub Rincian Objek');
        if (kodeBarangInput) kodeBarangInput.value = '';
        
        if (subRincianObjekId) {
            showLoading(subSubRincianObjekSelect);
            
            fetch(`/asets/sub-sub-rincian-objeks/${subRincianObjekId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    enableDropdown(subSubRincianObjekSelect);
                    if (data.success) {
                        clearAndPopulateDropdown(subSubRincianObjekSelect, data.data, 'nama_barang');
                    } else {
                        console.error('API Error:', data.message);
                        clearDropdown(subSubRincianObjekSelect, 'Error loading data');
                    }
                })
                .catch(error => handleFetchError(error, subSubRincianObjekSelect, 'sub sub rincian objek'));
        }
    });

    // Sub Sub Rincian Objek change handler - Generate kode barang
    if (subSubRincianObjekSelect && kodeBarangInput) {
        subSubRincianObjekSelect.addEventListener('change', function() {
            const subSubRincianObjekId = this.value;
            console.log('Sub Sub Rincian Objek changed:', subSubRincianObjekId);
            
            if (subSubRincianObjekId) {
                // Show loading state for kode barang
                kodeBarangInput.value = 'Generating...';
                kodeBarangInput.style.background = '#f3f4f6';
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                fetch('/asets/generate-kode-barang-preview', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },
                    body: JSON.stringify({
                        sub_sub_rincian_objek_id: subSubRincianObjekId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        kodeBarangInput.value = data.kode_barang;
                    } else {
                        console.error('Error generating kode barang:', data.message);
                        kodeBarangInput.value = '';
                        alert('Gagal generate kode barang: ' + data.message);
                    }
                    kodeBarangInput.style.background = '#f9fafb';
                })
                .catch(error => {
                    console.error('Error generating kode barang:', error);
                    kodeBarangInput.value = '';
                    kodeBarangInput.style.background = '#f9fafb';
                    alert('Gagal generate kode barang. Silakan coba lagi.');
                });
            } else {
                kodeBarangInput.value = '';
            }
        });
    }

  // File upload validation
    const buktiBarangInput = document.querySelector('input[name="bukti_barang"]');
    const buktiBeritaInput = document.querySelector('input[name="bukti_berita"]');
    const form = document.querySelector('form');

    if (buktiBarangInput) {
        buktiBarangInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Check file size (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file gambar maksimal 2MB');
                    this.value = '';
                    return;
                }
                
                // Check file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('File harus berupa gambar (JPEG, PNG, JPG, GIF)');
                    this.value = '';
                    return;
                }
                
                console.log('Bukti barang file selected:', file.name);
            }
        });
    }

    if (buktiBeritaInput) {
        buktiBeritaInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Check file size (10MB = 10 * 1024 * 1024 bytes)
                if (file.size > 10 * 1024 * 1024) {
                    alert('Ukuran file PDF maksimal 10MB');
                    this.value = '';
                    return;
                }
                
                // Check file type
                if (file.type !== 'application/pdf') {
                    alert('File harus berupa PDF');
                    this.value = '';
                    return;
                }
                
                console.log('Bukti berita file selected:', file.name);
            }
        });
    }

    // Prevent form submission if files are invalid
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submission attempted');
            
            // Validate files before submission
            if (buktiBarangInput && buktiBarangInput.files[0]) {
                const file = buktiBarangInput.files[0];
                if (file.size > 2 * 1024 * 1024 || !['image/jpeg', 'image/png', 'image/jpg', 'image/gif'].includes(file.type)) {
                    e.preventDefault();
                    alert('File bukti barang tidak valid. Pastikan file adalah gambar (JPEG, PNG, JPG, GIF) dan ukurannya tidak melebihi 2MB.');
                    return;
                }
            }

            if (buktiBeritaInput && buktiBeritaInput.files[0]) {
                const file = buktiBeritaInput.files[0];
                if (file.size > 10 * 1024 * 1024 || file.type !== 'application/pdf') {
                    e.preventDefault();
                    alert('File bukti berita tidak valid. Pastikan file adalah PDF dan ukurannya tidak melebihi 10MB.');
                    return;
                }
            }

            // Disable submit button to prevent double submission
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan Perubahan';
                }, 5000);
            }
        });
    }
    // Auto-focus on first error field
    const firstError = document.querySelector('.border-red-500');
    if (firstError) {
        firstError.focus();
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    console.log('Edit page JavaScript initialization complete');
});
</script>
@endpush

@endsection