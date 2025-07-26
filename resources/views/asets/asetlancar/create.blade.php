@extends('layouts.tabler')

@section('title', 'Tambah Aset Lancar')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Tambah Aset Lancar</h4>
                        <a href="{{ route('aset-lancar.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('aset-lancar.store') }}" method="POST" id="asetLancarForm">
                        @csrf
                        
                        <!-- Kode Rekening Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2">Informasi Kode Rekening</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="akun" class="form-label">Akun <span class="text-danger">*</span></label>
                                <select class="form-select @error('akun') is-invalid @enderror" id="akun" name="akun" required>
                                    <option value="">Pilih Akun</option>
                                    @foreach($akuns as $akun)
                                        <option value="{{ $akun->akun }}" {{ old('akun') == $akun->akun ? 'selected' : '' }}>
                                            {{ $akun->akun }} - {{ $akun->nama_akun }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('akun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kelompok" class="form-label">Kelompok <span class="text-danger">*</span></label>
                                <select class="form-select @error('kelompok') is-invalid @enderror" id="kelompok" name="kelompok" required disabled>
                                    <option value="">Pilih Kelompok</option>
                                </select>
                                @error('kelompok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="jenis" class="form-label">Jenis <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required disabled>
                                    <option value="">Pilih Jenis</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="objek" class="form-label">Objek <span class="text-danger">*</span></label>
                                <select class="form-select @error('objek') is-invalid @enderror" id="objek" name="objek" required disabled>
                                    <option value="">Pilih Objek</option>
                                </select>
                                @error('objek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="nomor" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                                <select class="form-select @error('kode_rekening_id') is-invalid @enderror" id="nomor" name="kode_rekening_id" required disabled>
                                    <option value="">Pilih Nomor</option>
                                </select>
                                @error('kode_rekening_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="uraian_rekening" class="form-label">Uraian Rekening</label>
                                <input type="text" class="form-control" id="uraian_rekening" readonly>
                            </div>
                        </div>

                        <!-- Informasi Barang Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2">Informasi Barang & Kegiatan</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="uraian_barang" class="form-label">Uraian Barang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('uraian_barang') is-invalid @enderror" id="uraian_barang" name="uraian_barang" value="{{ old('uraian_barang') }}" required>
                                @error('uraian_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required>
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="uraian_kegiatan" class="form-label">Uraian Kegiatan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('uraian_kegiatan') is-invalid @enderror" id="uraian_kegiatan" name="uraian_kegiatan" rows="3" required>{{ old('uraian_kegiatan') }}</textarea>
                                @error('uraian_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="uraian_jenis_barang" class="form-label">Uraian Jenis Barang <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('uraian_jenis_barang') is-invalid @enderror" id="uraian_jenis_barang" name="uraian_jenis_barang" rows="3" required>{{ old('uraian_jenis_barang') }}</textarea>
                                @error('uraian_jenis_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Saldo Awal Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2">Saldo Awal</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="saldo_awal_unit" class="form-label">Unit <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('saldo_awal_unit') is-invalid @enderror" id="saldo_awal_unit" name="saldo_awal_unit" value="{{ old('saldo_awal_unit', 0) }}" min="0" required>
                                @error('saldo_awal_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="saldo_awal_harga_satuan" class="form-label">Harga Satuan <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('saldo_awal_harga_satuan') is-invalid @enderror" id="saldo_awal_harga_satuan" name="saldo_awal_harga_satuan" value="{{ old('saldo_awal_harga_satuan', 0) }}" min="0" step="0.01" required>
                                @error('saldo_awal_harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="saldo_awal_total" class="form-label">Total Nilai</label>
                                <input type="text" class="form-control bg-light" id="saldo_awal_total" readonly>
                            </div>
                        </div>

                        <!-- Mutasi Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2">Mutasi</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-success">Tambah</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="mutasi_tambah_unit" class="form-label">Unit</label>
                                        <input type="number" class="form-control" id="mutasi_tambah_unit" name="mutasi_tambah_unit" value="{{ old('mutasi_tambah_unit', 0) }}" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mutasi_tambah_harga" class="form-label">Harga Satuan</label>
                                        <input type="number" class="form-control" id="mutasi_tambah_harga" name="mutasi_tambah_harga" value="{{ old('mutasi_tambah_harga', 0) }}" min="0" step="0.01">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label for="mutasi_tambah_nilai" class="form-label">Nilai</label>
                                        <input type="text" class="form-control bg-light" id="mutasi_tambah_nilai" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-danger">Kurang</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="mutasi_kurang_unit" class="form-label">Unit</label>
                                        <input type="number" class="form-control" id="mutasi_kurang_unit" name="mutasi_kurang_unit" value="{{ old('mutasi_kurang_unit', 0) }}" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mutasi_kurang_nilai" class="form-label">Nilai</label>
                                        <input type="number" class="form-control" id="mutasi_kurang_nilai" name="mutasi_kurang_nilai" value="{{ old('mutasi_kurang_nilai', 0) }}" min="0" step="0.01">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Saldo Akhir Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2">Saldo Akhir</h6>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="saldo_akhir_unit" class="form-label">Unit</label>
                                <input type="text" class="form-control bg-light" id="saldo_akhir_unit" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="saldo_akhir_total" class="form-label">Total Nilai</label>
                                <input type="text" class="form-control bg-light" id="saldo_akhir_total" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('aset-lancar.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Dropdown cascade handlers
    $('#akun').change(function() {
        const akun = $(this).val();
        loadKelompok(akun);
        resetDropdowns(['kelompok', 'jenis', 'objek', 'nomor']);
    });

    $('#kelompok').change(function() {
        const akun = $('#akun').val();
        const kelompok = $(this).val();
        loadJenis(akun, kelompok);
        resetDropdowns(['jenis', 'objek', 'nomor']);
    });

    $('#jenis').change(function() {
        const akun = $('#akun').val();
        const kelompok = $('#kelompok').val();
        const jenis = $(this).val();
        loadObjek(akun, kelompok, jenis);
        resetDropdowns(['objek', 'nomor']);
    });

    $('#objek').change(function() {
        const akun = $('#akun').val();
        const kelompok = $('#kelompok').val();
        const jenis = $('#jenis').val();
        const objek = $(this).val();
        loadNomorRekening(akun, kelompok, jenis, objek);
        resetDropdowns(['nomor']);
    });

    $('#nomor').change(function() {
        const kodeRekeningId = $(this).val();
        loadUraian(kodeRekeningId);
    });

    // Calculation handlers
    $('#saldo_awal_unit, #saldo_awal_harga_satuan').on('input', calculateSaldoAwalTotal);
    $('#mutasi_tambah_unit, #mutasi_tambah_harga').on('input', calculateMutasiTambahNilai);
    $('#saldo_awal_unit, #saldo_awal_harga_satuan, #mutasi_tambah_unit, #mutasi_tambah_harga, #mutasi_kurang_unit, #mutasi_kurang_nilai').on('input', calculateSaldoAkhir);

    // Functions
    function loadKelompok(akun) {
        if (!akun) return;
        
        $.get('{{ route("ajax.aset-lancar.kelompok") }}', { akun: akun })
            .done(function(data) {
                populateDropdown('#kelompok', data);
                $('#kelompok').prop('disabled', false);
            });
    }

    function loadJenis(akun, kelompok) {
        if (!akun || !kelompok) return;
        
        $.get('{{ route("ajax.aset-lancar.jenis") }}', { akun: akun, kelompok: kelompok })
            .done(function(data) {
                populateDropdown('#jenis', data);
                $('#jenis').prop('disabled', false);
            });
    }

    function loadObjek(akun, kelompok, jenis) {
        if (!akun || !kelompok || !jenis) return;
        
        $.get('{{ route("ajax.aset-lancar.objek") }}', { akun: akun, kelompok: kelompok, jenis: jenis })
            .done(function(data) {
                populateDropdown('#objek', data);
                $('#objek').prop('disabled', false);
            });
    }

    function loadNomorRekening(akun, kelompok, jenis, objek) {
        if (!akun || !kelompok || !jenis || !objek) return;
        
        $.get('{{ route("ajax.aset-lancar.nomor-rekening") }}', { akun: akun, kelompok: kelompok, jenis: jenis, objek: objek })
            .done(function(data) {
                populateDropdownWithId('#nomor', data);
                $('#nomor').prop('disabled', false);
            });
    }

    function loadUraian(kodeRekeningId) {
        if (!kodeRekeningId) return;
        
        $.get('{{ route("ajax.aset-lancar.uraian") }}', { kode_rekening_id: kodeRekeningId })
            .done(function(data) {
                $('#uraian_rekening').val(data.uraian);
            });
    }

    function populateDropdown(selector, data) {
        const $select = $(selector);
        $select.empty().append('<option value="">Pilih ' + selector.replace('#', '').charAt(0).toUpperCase() + selector.replace('#', '').slice(1) + '</option>');
        
        data.forEach(function(item) {
            $select.append('<option value="' + item.value + '">' + item.text + '</option>');
        });
    }

    function populateDropdownWithId(selector, data) {
        const $select = $(selector);
        $select.empty().append('<option value="">Pilih Nomor</option>');
        
        data.forEach(function(item) {
            $select.append('<option value="' + item.id + '">' + item.text + '</option>');
        });
    }

    function resetDropdowns(dropdowns) {
        dropdowns.forEach(function(dropdown) {
            $('#' + dropdown).empty().append('<option value="">Pilih ' + dropdown.charAt(0).toUpperCase() + dropdown.slice(1) + '</option>').prop('disabled', true);
        });
        $('#uraian_rekening').val('');
    }

    function calculateSaldoAwalTotal() {
        const unit = parseFloat($('#saldo_awal_unit').val()) || 0;
        const harga = parseFloat($('#saldo_awal_harga_satuan').val()) || 0;
        const total = unit * harga;
        $('#saldo_awal_total').val(formatCurrency(total));
    }

    function calculateMutasiTambahNilai() {
        const unit = parseFloat($('#mutasi_tambah_unit').val()) || 0;
        const harga = parseFloat($('#mutasi_tambah_harga').val()) || 0;
        const nilai = unit * harga;
        $('#mutasi_tambah_nilai').val(formatCurrency(nilai));
    }

    function calculateSaldoAkhir() {
        const saldoAwalUnit = parseFloat($('#saldo_awal_unit').val()) || 0;
        const saldoAwalHarga = parseFloat($('#saldo_awal_harga_satuan').val()) || 0;
        const mutasiTambahUnit = parseFloat($('#mutasi_tambah_unit').val()) || 0;
        const mutasiTambahHarga = parseFloat($('#mutasi_tambah_harga').val()) || 0;
        const mutasiKurangUnit = parseFloat($('#mutasi_kurang_unit').val()) || 0;
        const mutasiKurangNilai = parseFloat($('#mutasi_kurang_nilai').val()) || 0;

        const saldoAwalTotal = saldoAwalUnit * saldoAwalHarga;
        const mutasiTambahNilai = mutasiTambahUnit * mutasiTambahHarga;
        
        const saldoAkhirUnit = saldoAwalUnit + mutasiTambahUnit - mutasiKurangUnit;
        const saldoAkhirTotal = saldoAwalTotal + mutasiTambahNilai - mutasiKurangNilai;

        $('#saldo_akhir_unit').val(saldoAkhirUnit.toLocaleString('id-ID'));
        $('#saldo_akhir_total').val(formatCurrency(saldoAkhirTotal));
    }

    function formatCurrency(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }
});
</script>
@endpush