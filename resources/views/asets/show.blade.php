<div class="aset-detail-container">
<!-- INFORMASI DASAR -->
    <div class="section-card">
    <h4 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar</h4>
    <ul class="aset-detail-list">
        <li><span class="label">Nama Bidang Barang</span><span class="value">{{ displayOrDash($aset->nama_bidang_barang) }}</span></li>
        <li><span class="label">Register</span><span class="value">{{ displayOrDash($aset->register) }}</span></li>
        <li><span class="label">Nama Jenis Barang</span><span class="value">{{ displayOrDash($aset->nama_jenis_barang) }}</span></li>
        <li><span class="label">Asal Perolehan</span><span class="value">{{ displayOrDash($aset->asal_perolehan) }}</span></li>
        <li><span class="label">Tahun Perolehan</span><span class="value">{{ displayOrDash($aset->tahun_perolehan) }}</span></li>
        <li><span class="label">Satuan</span><span class="value">{{ displayOrDash($aset->satuan) }}</span></li>
        <li><span class="label">Keadaan Barang</span><span class="value">{{ displayOrDash($aset->keadaan_barang) }}</span></li>
        <li><span class="label">Jumlah Barang</span><span class="value">{{ displayOrDash($aset->jumlah_barang) }}</span></li>
        <li><span class="label">Harga Satuan</span><span class="value">Rp {{ number_format($aset->harga_satuan, 0, ',', '.') }}</span></li>
    </ul>
    x</div>


    <div class="section-card">
    <h4 class="section-title"><i class="fas fa-clipboard-list"></i> Informasi Tambahan</h4>
    <ul class="aset-detail-list">
        <li><span class="label">Merk / Type</span><span class="value">{{ displayOrDash($aset->merk_type) }}</span></li>
        <li><span class="label">No. Sertifikat</span><span class="value">{{ displayOrDash($aset->no_sertifikat) }}</span></li>
        <li><span class="label">No. Plat Kendaraan</span><span class="value">{{ displayOrDash($aset->no_plat_kendaraan) }}</span></li>
        <li><span class="label">No. Pabrik</span><span class="value">{{ displayOrDash($aset->no_pabrik) }}</span></li>
        <li><span class="label">No. Casis</span><span class="value">{{ displayOrDash($aset->no_casis) }}</span></li>
        <li><span class="label">Bahan</span><span class="value">{{ displayOrDash($aset->bahan) }}</span></li>
        <li><span class="label">Ukuran Barang / Konstruksi</span><span class="value">{{ displayOrDash($aset->ukuran_barang_konstruksi) }}</span></li>
    </ul>
</div>


    <!-- BUKTI BARANG -->
    <div class="section-card">
        <h4 class="section-title"><i class="fas fa-image"></i> Bukti Barang</h4>
        @if ($aset->bukti_barang && file_exists(public_path($aset->bukti_barang)))
            <img src="{{ asset($aset->bukti_barang) }}" alt="Bukti Barang" class="bukti-gambar">
        @else
            <p class="no-file">Tidak ada gambar bukti barang.</p>
        @endif
    </div>
</div>

<!-- Logic apa bila data kosong -->
@php
    function displayOrDash($value) {
        return ($value === null || trim($value) === '') ? '-' : $value;
    }

    function fileLinkOrDash($path, $label = 'Lihat File') {
        return $path && file_exists(public_path($path))
            ? '<a href="'.asset($path).'" target="_blank">'.$label.'</a>'
            : '-';
    }
@endphp
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- STYLE -->
<style>
    * {
    font-family: 'Inter', sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.aset-detail-container {
    max-width: 100%;
    padding: 5px 24px;
    max-height: 80vh;
    overflow-y: auto;
    scroll-behavior: smooth;
    margin-left:2px;
    
}

/* CARD */
.section-card {
    margin-bottom: 30px;
    background: #007bff22;
    padding: 10px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* TITLE */
.section-title {
    margin-bottom: 18px;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
}

/* DETAIL LIST */
.aset-detail-list {
    list-style: none;
    padding: 0;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

.aset-detail-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 1rem;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
    margin-bottom: 6px;
}

/* Warna pastel berbeda tiap baris */
.aset-detail-list li:nth-child(1) { background-color: #fef6fb; }
.aset-detail-list li:nth-child(2) { background-color: #f0f9ff; }
.aset-detail-list li:nth-child(3) { background-color: #fdfdea; }
.aset-detail-list li:nth-child(4) { background-color: #e7f6ec; }
.aset-detail-list li:nth-child(5) { background-color: #fff0f0; }
.aset-detail-list li:nth-child(6) { background-color: #eff6ff; }
.aset-detail-list li:nth-child(7) { background-color: #f0fff4; }
.aset-detail-list li:nth-child(8) { background-color: #fdf2f8; }
.aset-detail-list li:nth-child(9) { background-color: #fef9e7; }

.label {
    color: #475569;
    font-weight: 500;
    font-size: 0.95rem;
}

.value {
    color: #2563eb;
    font-weight: 600;
    font-size: 1.05rem;
    text-align: right;
    max-width: 60%;
    word-break: break-word;
}

/* GAMBAR */
.bukti-gambar {
    width: 100%;
    max-height: 420px;
    object-fit: contain;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    background-color: #ffffff;
    margin-top: 10px;
}

.no-file {
    color: #6b7280;
    font-style: italic;
}
</style>