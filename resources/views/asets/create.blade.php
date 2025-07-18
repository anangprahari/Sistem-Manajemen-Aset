@extends('layouts.tabler')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Aset Baru</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('asets.store') }}" method="POST" enctype="multipart/form-data" id="form-aset">
        @csrf

        {{-- ====================== Dropdown Hierarki ======================= --}}
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="akun_id" class="form-label">Akun</label>
                <select name="akun_id" id="akun_id" class="form-select" required>
                    <option value="">-- Pilih Akun --</option>
                    @foreach($akuns as $akun)
                        <option value="{{ $akun->id }}" {{ old('akun_id') == $akun->id ? 'selected' : '' }}>
                            {{ $akun->kode }} - {{ $akun->nama }}
                        </option>
                    @endforeach
                </select>
                @error('akun_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4">
                <label for="kelompok_id" class="form-label">Kelompok</label>
                <select name="kelompok_id" id="kelompok_id" class="form-select" required></select>
                @error('kelompok_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4">
                <label for="jenis_id" class="form-label">Jenis</label>
                <select name="jenis_id" id="jenis_id" class="form-select" required></select>
                @error('jenis_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4">
                <label for="objek_id" class="form-label">Objek</label>
                <select name="objek_id" id="objek_id" class="form-select" required></select>
                @error('objek_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4">
                <label for="rincian_objek_id" class="form-label">Rincian Objek</label>
                <select name="rincian_objek_id" id="rincian_objek_id" class="form-select" required></select>
                @error('rincian_objek_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4">
                <label for="sub_rincian_objek_id" class="form-label">Sub Rincian Objek</label>
                <select name="sub_rincian_objek_id" id="sub_rincian_objek_id" class="form-select" required></select>
                @error('sub_rincian_objek_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label for="sub_sub_rincian_objek_id" class="form-label">Sub Sub Rincian Objek</label>
                <select name="sub_sub_rincian_objek_id" id="sub_sub_rincian_objek_id" class="form-select" required></select>
                @error('sub_sub_rincian_objek_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Kode Barang (Otomatis)</label>
                <input type="text" class="form-control" id="kode_barang_preview" readonly>
            </div>
        </div>

        {{-- ====================== Detail Aset ======================= --}}
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama_bidang_barang" class="form-label">Nama Bidang Barang</label>
                <input type="text" name="nama_bidang_barang" class="form-control" value="{{ old('nama_bidang_barang') }}" required>
                @error('nama_bidang_barang') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label for="register" class="form-label">Register</label>
                <input type="text" name="register" class="form-control" value="{{ old('register') }}" required>
                @error('register') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label for="nama_jenis_barang" class="form-label">Nama Jenis Barang</label>
                <input type="text" name="nama_jenis_barang" class="form-control" value="{{ old('nama_jenis_barang') }}" required>
                @error('nama_jenis_barang') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label for="merk_type" class="form-label">Merk / Type</label>
                <input type="text" name="merk_type" class="form-control" value="{{ old('merk_type') }}">
            </div>

            <div class="col-md-4">
                <label for="no_sertifikat" class="form-label">No. Sertifikat</label>
                <input type="text" name="no_sertifikat" class="form-control" value="{{ old('no_sertifikat') }}">
            </div>

            <div class="col-md-4">
                <label for="no_plat_kendaraan" class="form-label">No. Plat Kendaraan</label>
                <input type="text" name="no_plat_kendaraan" class="form-control" value="{{ old('no_plat_kendaraan') }}">
            </div>

            <div class="col-md-4">
                <label for="no_pabrik" class="form-label">No. Pabrik</label>
                <input type="text" name="no_pabrik" class="form-control" value="{{ old('no_pabrik') }}">
            </div>

            <div class="col-md-4">
                <label for="no_casis" class="form-label">No. Casis</label>
                <input type="text" name="no_casis" class="form-control" value="{{ old('no_casis') }}">
            </div>

            <div class="col-md-4">
                <label for="bahan" class="form-label">Bahan</label>
                <input type="text" name="bahan" class="form-control" value="{{ old('bahan') }}">
            </div>

            <div class="col-md-4">
                <label for="asal_perolehan" class="form-label">Asal Perolehan</label>
                <input type="text" name="asal_perolehan" class="form-control" value="{{ old('asal_perolehan') }}" required>
            </div>

            <div class="col-md-4">
                <label for="ukuran_barang_konstruksi" class="form-label">Ukuran Barang / Konstruksi</label>
                <input type="text" name="ukuran_barang_konstruksi" class="form-control" value="{{ old('ukuran_barang_konstruksi') }}">
            </div>

            <div class="col-md-4">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ old('satuan') }}" required>
            </div>

            <div class="col-md-4">
                <label for="keadaan_barang" class="form-label">Keadaan Barang</label>
                <select name="keadaan_barang" class="form-select" required>
                    <option value="Baik" {{ old('keadaan_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Kurang Baik" {{ old('keadaan_barang') == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
                    <option value="Rusak Berat" {{ old('keadaan_barang') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" class="form-control" value="{{ old('jumlah_barang', 1) }}" min="1" required>
            </div>

            <div class="col-md-3">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="number" name="harga_satuan" class="form-control" value="{{ old('harga_satuan') }}" min="0" required>
            </div>

            <div class="col-md-3">
                <label for="bukti_barang" class="form-label">Bukti Barang (opsional)</label>
                <input type="file" name="bukti_barang" class="form-control">
            </div>

            <div class="col-md-3">
                <label for="bukti_berita" class="form-label">Bukti Berita (opsional)</label>
                <input type="file" name="bukti_berita" class="form-control">
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Simpan Aset</button>
            <a href="{{ route('asets.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('page-scripts')
<script>
$(document).ready(function() {
    function loadDropdown(url, target, selectedId = null) {
        $.get(url, function(res) {
            let options = '<option value="">-- Pilih --</option>';
            $.each(res.data, function(i, item) {
                const selected = selectedId == item.id ? 'selected' : '';
                options += `<option value="${item.id}" ${selected}>${item.kode} - ${item.nama || item.nama_barang}</option>`;
            });
            $(`#${target}`).html(options);
        });
    }

   $('#akun_id').on('change', function() {
    loadDropdown(`/asets/get-kelompok/${this.value}`, 'kelompok_id');
    $('#jenis_id, #objek_id, #rincian_objek_id, #sub_rincian_objek_id, #sub_sub_rincian_objek_id').html('<option value="">-- Pilih --</option>');
    $('#kode_barang_preview').val('');
});

$('#kelompok_id').on('change', function() {
    loadDropdown(`/asets/get-jenis/${this.value}`, 'jenis_id');
});
$('#jenis_id').on('change', function() {
    loadDropdown(`/asets/get-objek/${this.value}`, 'objek_id');
});
$('#objek_id').on('change', function() {
    loadDropdown(`/asets/get-rincian-objek/${this.value}`, 'rincian_objek_id');
});
$('#rincian_objek_id').on('change', function() {
    loadDropdown(`/asets/get-sub-rincian-objek/${this.value}`, 'sub_rincian_objek_id');
});
$('#sub_rincian_objek_id').on('change', function() {
    loadDropdown(`/asets/get-sub-sub-rincian-objek/${this.value}`, 'sub_sub_rincian_objek_id');
});
$('#sub_sub_rincian_objek_id').on('change', function() {
    const id = $(this).val();
    if (id) {
        $.get('/asets/generate-kode-preview', { sub_sub_rincian_objek_id: id }, function(res) {
            if (res.success) {
                $('#kode_barang_preview').val(res.kode_barang);
            }
        });
    } else {
        $('#kode_barang_preview').val('');
    }
});
});
</script>
@endpush
