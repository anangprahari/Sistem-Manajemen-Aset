@extends('layouts.tabler')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Manajemen Aset Lancar</h2>
                    <div class="text-muted mt-1">Daftar seluruh aset lancar yang tercatat dalam sistem</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('aset-lancars.export', request()->query()) }}" class="btn btn-success btn-sm me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" />
                            </svg>
                            Export Excel
                        </a>
                        <a href="{{ route('aset-lancars.create') }}" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Tambah Aset
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="9" />
                            <path d="M9 12l2 2l4 -4" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Sukses!</h4>
                        <div class="text-muted">{{ session('success') }}</div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="9" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Error!</h4>
                        <div class="text-muted">{{ session('error') }}</div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Filter Data</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('aset-lancars.index') }}">
                    <div class="row">
                        <!-- Search Input -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Pencarian Cepat</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama kegiatan, uraian, jenis barang, kode rekening..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="10" cy="10" r="7" />
                                        <line x1="21" y1="21" x2="15" y2="15" />
                                    </svg>
                                    Cari
                                </button>
                                @if (request('search'))
                                    <a href="{{ route('aset-lancars.index') }}" class="btn btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <line x1="18" y1="6" x2="6" y2="18" />
                                            <line x1="6" y1="6" x2="18" y2="18" />
                                        </svg>
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Advanced Filters -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Rekening Uraian</label>
                            <select name="rekening_uraian_id" id="rekening_uraian_id" class="form-select">
                                <option value="">Semua Rekening</option>
                                @foreach($rekeningUraians as $rekening)
                                    <option value="{{ $rekening->id }}" {{ request('rekening_uraian_id') == $rekening->id ? 'selected' : '' }}>
                                        {{ $rekening->kode_rekening }} - {{ $rekening->uraian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama kegiatan" value="{{ request('nama_kegiatan') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jenis Barang</label>
                            <input type="text" name="uraian_jenis_barang" class="form-control" placeholder="Jenis barang" value="{{ request('uraian_jenis_barang') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Tanggal Dari</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Tanggal Sampai</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Saldo Awal (Min)</label>
                            <input type="number" name="saldo_awal_min" class="form-control" placeholder="Minimum" value="{{ request('saldo_awal_min') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Saldo Awal (Max)</label>
                            <input type="number" name="saldo_awal_max" class="form-control" placeholder="Maksimum" value="{{ request('saldo_awal_max') }}">
                        </div>

                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5" />
                                    </svg>
                                    Terapkan Filter
                                </button>
                                <a href="{{ route('aset-lancars.index') }}" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3" />
                                        <path d="M18 13.3l-6.3 -6.3" />
                                    </svg>
                                    Reset Filter
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Aset Lancar</h3>
            </div>
            <div class="card-body border-bottom py-3">
                @if ($asetLancars->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center align-middle" width="3%">No</th>
                                    <th rowspan="2" class="text-center align-middle" width="8%">Uraian Barang</th>
                                    <th rowspan="2" class="text-center align-middle" width="12%">Nama Kegiatan</th>
                                    <th rowspan="2" class="text-center align-middle" width="12%">Uraian Kegiatan</th>
                                    <th rowspan="2" class="text-center align-middle" width="10%">Uraian/Jenis Barang</th>
                                    <th colspan="3" class="text-center" style="background-color: #e3f2fd; color: #1976d2;">Saldo Awal</th>
                                    <th colspan="5" class="text-center" style="background-color: #e8f5e8; color: #388e3c;">Mutasi</th>
                                    <th colspan="2" class="text-center" style="background-color: #fff3e0; color: #f57c00;">Saldo Akhir</th>
                                    <th rowspan="2" class="text-center align-middle" width="8%">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- Saldo Awal -->
                                    <th class="text-center" width="6%" style="background-color: #e3f2fd; color: #1976d2;">Unit</th>
                                    <th class="text-center" width="8%" style="background-color: #e3f2fd; color: #1976d2;">Harga Satuan</th>
                                    <th class="text-center" width="8%" style="background-color: #e3f2fd; color: #1976d2;">Nilai Total</th>
                                    <!-- Mutasi -->
                                    <th class="text-center" width="6%" style="background-color: #e8f5e8; color: #388e3c;">Tambah</th>
                                    <th class="text-center" width="7%" style="background-color: #e8f5e8; color: #388e3c;">Harga Satuan</th>
                                    <th class="text-center" width="7%" style="background-color: #e8f5e8; color: #388e3c;">Nilai Total</th>
                                    <th class="text-center" width="6%" style="background-color: #e8f5e8; color: #388e3c;">(Kurang)</th>
                                    <th class="text-center" width="7%" style="background-color: #e8f5e8; color: #388e3c;">Nilai Total</th>
                                    <!-- Saldo Akhir -->
                                    <th class="text-center" width="6%" style="background-color: #fff3e0; color: #f57c00;">Unit</th>
                                    <th class="text-center" width="8%" style="background-color: #fff3e0; color: #f57c00;">Nilai Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asetLancars as $index => $aset)
                                    <tr>
                                        <td class="text-center align-middle">{{ $asetLancars->firstItem() + $index }}</td>
                                        <td class="align-middle">
                                            <span class="badge bg-blue-lt">
                                                {{ $aset->rekeningUraian->kode_rekening }} - {{ $aset->rekeningUraian->uraian }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <strong>{{ $aset->nama_kegiatan }}</strong>
                                        </td>
                                        <td class="align-middle">
                                            {{ $aset->uraian_kegiatan ?? '-' }}
                                            @if ($aset->uraian_kegiatan && strlen($aset->uraian_kegiatan) > 40)
                                                <br><small class="text-muted">{{ Str::limit($aset->uraian_kegiatan, 40) }}</small>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $aset->uraian_jenis_barang ?? '-' }}</td>

                                        <!-- Saldo Awal -->
                                        <td class="text-center align-middle" style="background-color: #f8fdff;">
                                            <span class="badge bg-blue">{{ number_format($aset->saldo_awal_unit) }}</span>
                                        </td>
                                        <td class="text-end align-middle" style="background-color: #f8fdff;">
                                            {{ 'Rp ' . number_format($aset->saldo_awal_harga_satuan, 0) }}
                                        </td>
                                        <td class="text-end align-middle" style="background-color: #f8fdff;">
                                            <strong>{{ 'Rp ' . number_format($aset->saldo_awal_total, 0) }}</strong>
                                        </td>

                                        <!-- Mutasi -->
                                        <td class="text-center align-middle" style="background-color: #f8fff8;">
                                            @if ($aset->mutasi_tambah_unit > 0)
                                                <span class="badge bg-green">+{{ number_format($aset->mutasi_tambah_unit) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-end align-middle" style="background-color: #f8fff8;">
                                            @if ($aset->mutasi_tambah_harga_satuan > 0)
                                                {{ 'Rp ' . number_format($aset->mutasi_tambah_harga_satuan, 0) }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-end align-middle" style="background-color: #f8fff8;">
                                            @if ($aset->mutasi_tambah_nilai_total > 0)
                                                <span class="text-green">{{ 'Rp ' . number_format($aset->mutasi_tambah_nilai_total, 0) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle" style="background-color: #f8fff8;">
                                            @if ($aset->mutasi_kurang_unit > 0)
                                                <span class="badge bg-red">-{{ number_format($aset->mutasi_kurang_unit) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-end align-middle" style="background-color: #f8fff8;">
                                            @if ($aset->mutasi_kurang_nilai_total > 0)
                                                <span class="text-red">{{ 'Rp ' . number_format($aset->mutasi_kurang_nilai_total, 0) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <!-- Saldo Akhir -->
                                        <td class="text-center align-middle" style="background-color: #fffbf0;">
                                            <span class="badge bg-orange">{{ number_format($aset->saldo_akhir_unit) }}</span>
                                        </td>
                                        <td class="text-end align-middle" style="background-color: #fffbf0;">
                                            <strong class="text-blue">{{ 'Rp ' . number_format($aset->saldo_akhir_total, 0) }}</strong>
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <a href="{{ route('aset-lancars.show', $aset) }}" class="btn btn-icon btn-outline-info" title="Detail" data-bs-toggle="tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <circle cx="12" cy="12" r="2" />
                                                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('aset-lancars.edit', $aset) }}" class="btn btn-icon btn-outline-warning" title="Edit" data-bs-toggle="tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                <button type="button" class="btn btn-icon btn-outline-danger" onclick="confirmDelete({{ $aset->id }})" title="Hapus" data-bs-toggle="tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <line x1="4" y1="7" x2="20" y2="7" />
                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="8" class="text-end">Total Keseluruhan:</th>
                                    <th class="text-end">
                                        {{ 'Rp ' . number_format($asetLancars->sum('saldo_awal_total'), 0) }}
                                    </th>
                                    <th colspan="2"></th>
                                    <th class="text-end">
                                        {{ 'Rp ' . number_format($asetLancars->sum('mutasi_tambah_nilai_total'), 0) }}
                                    </th>
                                    <th></th>
                                    <th class="text-end">
                                        {{ 'Rp ' . number_format($asetLancars->sum('mutasi_kurang_nilai_total'), 0) }}
                                    </th>
                                    <th></th>
                                    <th class="text-end">
                                        <strong class="text-blue">
                                            {{ 'Rp ' . number_format($asetLancars->sum('saldo_akhir_total'), 0) }}
                                        </strong>
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">
                            Menampilkan <span>{{ $asetLancars->firstItem() }}</span> sampai <span>{{ $asetLancars->lastItem() }}</span> dari <span>{{ $asetLancars->total() }}</span> data
                        </p>
                        <ul class="pagination m-0 ms-auto">
                            {{ $asetLancars->appends(request()->query())->links() }}
                        </ul>
                    </div>
                @else
                    <div class="empty">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
                                <line x1="12" y1="12" x2="20" y2="7.5" />
                                <line x1="12" y1="12" x2="12" y2="21" />
                                <line x1="12" y1="12" x2="4" y2="7.5" />
                                <line x1="16" y1="5.25" x2="8" y2="9.75" />
                            </svg>
                        </div>
                        <p class="empty-title">Tidak ada data aset lancar</p>
                        <p class="empty-subtitle text-muted">
                            Silakan tambah data aset lancar baru untuk memulai
                        </p>
                        <div class="empty-action">
                            <a href="{{ route('aset-lancars.create') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Tambah Aset Lancar
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal modal-blur fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <circle cx="12" cy="12" r="9" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <h3>Konfirmasi Hapus</h3>
                    <div class="text-muted">
                        Apakah Anda yakin ingin menghapus data aset lancar ini? Data yang sudah dihapus tidak dapat dikembalikan.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-white w-100" data-bs-dismiss="modal">
                                    Batal
                                </button>
                            </div>
                            <div class="col">
                                <form id="deleteForm" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Custom blue theme */
        :root {
            --tblr-blue: #206bc4;
            --tblr-blue-light: #e8f1fd;
            --tblr-blue-lighter: #f5f9ff;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
        }
        
        .card-header {
            background-color: var(--tblr-blue-lighter);
            border-bottom: 1px solid rgba(32, 107, 196, 0.1);
            padding: 1rem 1.5rem;
        }
        
        .card-title {
            color: var(--tblr-blue);
            font-weight: 600;
        }
        
        .table th {
            background-color: var(--tblr-blue-lighter);
            color: var(--tblr-blue);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        
        .table td {
            vertical-align: middle;
            padding: 0.75rem 1rem;
        }
        
        .badge.bg-blue {
            background-color: var(--tblr-blue) !important;
            color: white;
        }
        
        .badge.bg-blue-lt {
            background-color: var(--tblr-blue-light) !important;
            color: var(--tblr-blue);
        }
        
        .btn-primary {
            background-color: var(--tblr-blue);
            border-color: var(--tblr-blue);
        }
        
        .btn-primary:hover {
            background-color: #1a5aad;
            border-color: #1a5aad;
        }
        
        .btn-outline-primary {
            color: var(--tblr-blue);
            border-color: var(--tblr-blue);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--tblr-blue);
            color: white;
        }
        
        .alert {
            border-radius: 0.5rem;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border-color: rgba(40, 167, 69, 0.1);
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.1);
        }
        
        .empty {
            padding: 3rem 0;
            text-align: center;
        }
        
        .empty-icon {
            color: var(--tblr-blue);
            margin-bottom: 1rem;
        }
        
        .empty-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--tblr-blue);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--tblr-blue);
            border-color: var(--tblr-blue);
        }
        
        .page-link {
            color: var(--tblr-blue);
        }
    </style>
@endpush

@push('scripts')
    <script>
        function confirmDelete(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `{{ route('aset-lancars.index') }}/${id}`;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });
            
            // Enable tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush