@extends('layouts.tabler')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Aset Lancar</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('aset-lancars.index') }}">Aset Lancar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <!-- Alert Messages -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Aset Lancar</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('aset-lancars.store') }}" method="POST" id="asetLancarForm">
                        @csrf
                        
                        <!-- Rekening Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-list-alt"></i> Informasi Rekening
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="rekening_uraian_id" class="form-label">
                                    <strong>Nomor Rekening & Uraian</strong> 
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('rekening_uraian_id') is-invalid @enderror" 
                                        id="rekening_uraian_id" name="rekening_uraian_id" required>
                                    <option value="">-- Pilih Nomor Rekening & Uraian --</option>
                                    @foreach($rekeningUraians as $rekening)
                                        <option value="{{ $rekening->id }}" 
                                                {{ old('rekening_uraian_id') == $rekening->id ? 'selected' : '' }}>
                                            {{ $rekening->kode_rekening }} - {{ $rekening->uraian }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rekening_uraian_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kegiatan Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-tasks"></i> Informasi Kegiatan
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_kegiatan" class="form-label">
                                    <strong>Nama Kegiatan</strong> 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" 
                                       id="nama_kegiatan" name="nama_kegiatan" 
                                       value="{{ old('nama_kegiatan') }}" 
                                       placeholder="Masukkan nama kegiatan..." required>
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="uraian_jenis_barang" class="form-label">
                                    <strong>Uraian Jenis/Barang</strong>
                                </label>
                                <input type="text" class="form-control @error('uraian_jenis_barang') is-invalid @enderror" 
                                       id="uraian_jenis_barang" name="uraian_jenis_barang" 
                                       value="{{ old('uraian_jenis_barang') }}" 
                                       placeholder="Masukkan uraian jenis/barang...">
                                @error('uraian_jenis_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="uraian_kegiatan" class="form-label">
                                    <strong>Uraian Kegiatan</strong>
                                </label>
                                <textarea class="form-control @error('uraian_kegiatan') is-invalid @enderror" 
                                          id="uraian_kegiatan" name="uraian_kegiatan" rows="3"
                                          placeholder="Masukkan uraian detail kegiatan...">{{ old('uraian_kegiatan') }}</textarea>
                                @error('uraian_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Saldo Awal Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-calculator"></i> Data Saldo & Mutasi
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="saldo_awal_unit" class="form-label">
                                    <strong>Saldo Awal Unit</strong> 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('saldo_awal_unit') is-invalid @enderror" 
                                       id="saldo_awal_unit" name="saldo_awal_unit" 
                                       value="{{ old('saldo_awal_unit', 0) }}" 
                                       min="0" step="1" required>
                                @error('saldo_awal_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="saldo_awal_harga_satuan" class="form-label">
                                    <strong>Saldo Awal Harga Satuan</strong> 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('saldo_awal_harga_satuan') is-invalid @enderror" 
                                           id="saldo_awal_harga_satuan" name="saldo_awal_harga_satuan" 
                                           value="{{ old('saldo_awal_harga_satuan', 0) }}" 
                                           min="0" step="0.01" required>
                                </div>
                                @error('saldo_awal_harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="saldo_awal_total" class="form-label">
                                    <strong>Saldo Awal Total</strong>
                                    <small class="text-muted">(Otomatis)</small>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control bg-light" id="saldo_awal_total_display" 
                                           readonly placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="mutasi_tambah_unit" class="form-label">
                                    <strong>Mutasi Tambah Unit</strong>
                                </label>
                                <input type="number" class="form-control @error('mutasi_tambah_unit') is-invalid @enderror" 
                                       id="mutasi_tambah_unit" name="mutasi_tambah_unit" 
                                       value="{{ old('mutasi_tambah_unit', 0) }}" 
                                       min="0" step="1">
                                @error('mutasi_tambah_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="mutasi_tambah_harga_satuan" class="form-label">
                                    <strong>Mutasi Tambah Harga Satuan</strong>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('mutasi_tambah_harga_satuan') is-invalid @enderror" 
                                           id="mutasi_tambah_harga_satuan" name="mutasi_tambah_harga_satuan" 
                                           value="{{ old('mutasi_tambah_harga_satuan', 0) }}" 
                                           min="0" step="0.01">
                                </div>
                                @error('mutasi_tambah_harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="mutasi_tambah_nilai_total" class="form-label">
                                    <strong>Mutasi Tambah Nilai Total</strong>
                                    <small class="text-muted">(Otomatis)</small>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control bg-light" id="mutasi_tambah_nilai_total_display" 
                                           readonly placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="mutasi_kurang_unit" class="form-label">
                                    <strong>Mutasi Kurang Unit</strong>
                                </label>
                                <input type="number" class="form-control @error('mutasi_kurang_unit') is-invalid @enderror" 
                                       id="mutasi_kurang_unit" name="mutasi_kurang_unit" 
                                       value="{{ old('mutasi_kurang_unit', 0) }}" 
                                       min="0" step="1">
                                @error('mutasi_kurang_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="mutasi_kurang_nilai_total" class="form-label">
                                    <strong>Mutasi Kurang Nilai Total</strong>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('mutasi_kurang_nilai_total') is-invalid @enderror" 
                                           id="mutasi_kurang_nilai_total" name="mutasi_kurang_nilai_total" 
                                           value="{{ old('mutasi_kurang_nilai_total', 0) }}" 
                                           min="0" step="0.01">
                                </div>
                                @error('mutasi_kurang_nilai_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Summary Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-success border-bottom pb-2">
                                    <i class="fas fa-chart-line"></i> Ringkasan Saldo Akhir
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="saldo_akhir_unit" class="form-label">
                                    <strong>Saldo Akhir Unit</strong>
                                    <small class="text-muted">(Otomatis)</small>
                                </label>
                                <input type="text" class="form-control bg-light text-success fw-bold" 
                                       id="saldo_akhir_unit_display" readonly placeholder="0">
                            </div>
                            <div class="col-md-6">
                                <label for="saldo_akhir_total" class="form-label">
                                    <strong>Saldo Akhir Total</strong>
                                    <small class="text-muted">(Otomatis)</small>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control bg-light text-success fw-bold" 
                                           id="saldo_akhir_total_display" readonly placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('aset-lancars.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <div>
                                        <button type="reset" class="btn btn-warning me-2">
                                            <i class="fas fa-redo"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to format number to Indonesian currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount);
    }

    // Function to format integer
    function formatInteger(amount) {
        return new Intl.NumberFormat('id-ID').format(amount);
    }

    // Function to calculate and update displays
    function updateCalculations() {
        // Get input values
        const saldoAwalUnit = parseFloat(document.getElementById('saldo_awal_unit').value) || 0;
        const saldoAwalHargaSatuan = parseFloat(document.getElementById('saldo_awal_harga_satuan').value) || 0;
        const mutasiTambahUnit = parseFloat(document.getElementById('mutasi_tambah_unit').value) || 0;
        const mutasiTambahHargaSatuan = parseFloat(document.getElementById('mutasi_tambah_harga_satuan').value) || 0;
        const mutasiKurangUnit = parseFloat(document.getElementById('mutasi_kurang_unit').value) || 0;
        const mutasiKurangNilaiTotal = parseFloat(document.getElementById('mutasi_kurang_nilai_total').value) || 0;

        // Calculate saldo awal total
        const saldoAwalTotal = saldoAwalUnit * saldoAwalHargaSatuan;
        document.getElementById('saldo_awal_total_display').value = formatCurrency(saldoAwalTotal);

        // Calculate mutasi tambah nilai total
        const mutasiTambahNilaiTotal = mutasiTambahUnit * mutasiTambahHargaSatuan;
        document.getElementById('mutasi_tambah_nilai_total_display').value = formatCurrency(mutasiTambahNilaiTotal);

        // Calculate saldo akhir unit
        const saldoAkhirUnit = saldoAwalUnit + mutasiTambahUnit - mutasiKurangUnit;
        document.getElementById('saldo_akhir_unit_display').value = formatInteger(saldoAkhirUnit);

        // Calculate saldo akhir total
        const saldoAkhirTotal = saldoAwalTotal + mutasiTambahNilaiTotal - mutasiKurangNilaiTotal;
        document.getElementById('saldo_akhir_total_display').value = formatCurrency(saldoAkhirTotal);
    }

    // Add event listeners to all input fields that affect calculations
    const inputFields = [
        'saldo_awal_unit',
        'saldo_awal_harga_satuan',
        'mutasi_tambah_unit',
        'mutasi_tambah_harga_satuan',
        'mutasi_kurang_unit',
        'mutasi_kurang_nilai_total'
    ];

    inputFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('input', updateCalculations);
            field.addEventListener('change', updateCalculations);
        }
    });

    // Initial calculation
    updateCalculations();

    // Reset form event
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        setTimeout(updateCalculations, 100); // Delay to allow form reset to complete
    });

    // Auto hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 8000);
    });
});
</script>
@endpush
@endsection