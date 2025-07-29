<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aset Lancar</title>
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
            background: linear-gradient(120deg, #e0e7ff 0%, #f1f5f9 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            padding: 1.5rem 0;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 18px;
            padding: 2rem;
            box-shadow: 0 18px 38px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-container h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .section-card {
            background: var(--light-color);
            border-radius: 14px;
            padding: 1.5rem;
            margin-bottom: 1.8rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.3rem;
            padding-bottom: 0.4rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.9rem;
        }

        .hierarchy-display {
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            border: 2px solid var(--info-color);
            border-radius: 14px;
            padding: 1.3rem;
            margin-bottom: 1.8rem;
        }

        .hierarchy-display h6 {
            color: var(--info-color);
            font-weight: 600;
            margin-bottom: 0.9rem;
        }

        .hierarchy-item {
            background: white;
            padding: 0.65rem 0.9rem;
            border-radius: 7px;
            margin-bottom: 0.45rem;
            border-left: 4px solid var(--info-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .hierarchy-level {
            font-weight: 600;
            color: var(--primary-color);
        }

        .calculation-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px solid var(--info-color);
            border-radius: 14px;
            padding: 1.3rem;
            margin-bottom: 1.8rem;
            transition: all 0.3s ease;
        }

        .calculation-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
            border-radius: 7px;
        }

        .progress {
            height: 6px;
            border-radius: 7px;
            background-color: #e2e8f0;
        }

        .progress-bar {
            border-radius: 7px;
        }

        .table {
            border-radius: 9px;
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
            font-size: 0.9rem;
            padding: 0.75rem;
        }

        .table thead th {
            background: var(--dark-color);
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f0f9ff;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--secondary-color);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .timeline-marker {
            position: absolute;
            left: -23px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid var(--light-color);
            box-shadow: 0 0 0 2px var(--secondary-color);
        }

        .timeline-content {
            background: white;
            border-radius: 9px;
            padding: 1rem;
            margin-left: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .timeline-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .btn {
            border-radius: 9px;
            padding: 0.65rem 1.3rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            border: none;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1.5px);
            box-shadow: 0 5px 18px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #6b7280 100%);
            border: none;
            box-shadow: 0 4px 14px rgba(100, 116, 139, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-1.5px);
            box-shadow: 0 5px 18px rgba(100, 116, 139, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #f59e0b 100%);
            border: none;
            box-shadow: 0 4px 14px rgba(217, 119, 6, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-1.5px);
            box-shadow: 0 5px 18px rgba(217, 119, 6, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #ef4444 100%);
            border: none;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-1.5px);
            box-shadow: 0 5px 18px rgba(220, 38, 38, 0.4);
        }

        .fade-in {
            animation: fadeIn 0.4s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .form-container {
                margin: 1rem;
                padding: 1.3rem;
            }
            .row > div {
                margin-bottom: 1rem;
            }
            .table-responsive {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }
            .section-card, .calculation-section {
                padding: 1rem;
            }
            .table th, .table td {
                font-size: 0.8rem;
                padding: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 1rem 0;
            }
            .form-container {
                margin: 0.5rem;
                padding: 1rem;
            }
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        /* Print Styles */
        @media print {
            .btn, .breadcrumb {
                display: none !important;
            }
            .form-container {
                background: none;
                backdrop-filter: none;
                box-shadow: none;
                border: none;
                padding: 0;
            }
            .section-card, .calculation-section, .hierarchy-display {
                border: 1px solid #000 !important;
                box-shadow: none !important;
                background: none !important;
            }
            .section-title {
                color: #000 !important;
                border-bottom: 2px solid #000 !important;
            }
            .table {
                border: 1px solid #000 !important;
            }
            .table th, .table td {
                border: 1px solid #000 !important;
                color: #000 !important;
            }
            .badge, .progress {
                display: none !important;
            }
            .timeline::before, .timeline-marker {
                display: none !important;
            }
            .timeline-content {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid main-container">
        <div class="form-container fade-in">
            <div class="text-center mb-4">
                <h2>
                    <i class="fas fa-wallet text-primary"></i> Detail Aset Lancar
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('aset-lancars.index') }}">Aset Lancar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>

            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: '{{ session('success') }}',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                        });
                    });
                </script>
            @endif

            <div class="d-flex justify-content-end mb-4">
                <button type="button" class="btn btn-primary me-2" onclick="printPage()">
                    <i class="fas fa-print"></i> Cetak
                </button>
                <a href="{{ route('aset-lancars.edit', $asetLancar) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit"></i> Edit Data
                </a>
                <button type="button" class="btn btn-danger me-2" onclick="confirmDelete({{ $asetLancar->id }})">
                    <i class="fas fa-trash"></i> Hapus Data
                </button>
                <a href="{{ route('aset-lancars.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="row">
                <!-- Main Information Card -->
                <div class="col-xl-8 col-lg-7">
                    <div class="section-card">
                        <h4 class="section-title">
                            <i class="fas fa-info-circle"></i> Informasi Utama
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Kode Rekening</label>
                                    <div class="border-bottom pb-2">
                                        <span class="badge bg-info text-white">{{ $asetLancar->rekeningUraian->kode_rekening }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Tanggal Dibuat</label>
                                    <div class="border-bottom pb-2">
                                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                                        {{ $asetLancar->created_at->format('d F Y, H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Uraian Rekening</label>
                                    <div class="border-bottom pb-2">
                                        <strong>{{ $asetLancar->rekeningUraian->uraian }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Nama Kegiatan</label>
                                    <div class="border-bottom pb-2">
                                        <strong class="text-primary">{{ $asetLancar->nama_kegiatan }}</strong>
                                    </div>
                                </div>
                            </div>
                            @if($asetLancar->uraian_kegiatan)
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label small text-muted">Uraian Kegiatan</label>
                                        <div class="border rounded p-3 bg-light">
                                            {{ $asetLancar->uraian_kegiatan }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($asetLancar->uraian_jenis_barang)
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label small text-muted">Jenis Barang</label>
                                        <div class="border-bottom pb-2">
                                            <span class="badge bg-secondary">{{ $asetLancar->uraian_jenis_barang }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Terakhir Diperbarui</label>
                                    <div class="border-bottom pb-2">
                                        <i class="fas fa-clock text-muted me-2"></i>
                                        {{ $asetLancar->updated_at->format('d F Y, H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small text-muted">ID Record</label>
                                    <div class="border-bottom pb-2">
                                        <code>#{{ $asetLancar->id }}</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="col-xl-4 col-lg-5">
                    <div class="section-card calculation-section">
                        <h4 class="section-title">
                            <i class="fas fa-chart-line"></i> Ringkasan Nilai
                        </h4>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Saldo Awal Total</span>
                                <strong class="text-info">Rp {{ number_format($asetLancar->saldo_awal_total, 0) }}</strong>
                            </div>
                            <div class="progress mt-1">
                                <div class="progress-bar bg-info" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Mutasi Tambah</span>
                                <strong class="text-success">Rp {{ number_format($asetLancar->mutasi_tambah_nilai_total, 0) }}</strong>
                            </div>
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" style="width: {{ $asetLancar->mutasi_tambah_nilai_total > 0 ? '100' : '0' }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Mutasi Kurang</span>
                                <strong class="text-danger">Rp {{ number_format($asetLancar->mutasi_kurang_nilai_total, 0) }}</strong>
                            </div>
                            <div class="progress mt-1">
                                <div class="progress-bar bg-danger" style="width: {{ $asetLancar->mutasi_kurang_nilai_total > 0 ? '100' : '0' }}%"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Saldo Akhir Total</span>
                                <h5 class="text-primary mb-0">Rp {{ number_format($asetLancar->saldo_akhir_total, 0) }}</h5>
                            </div>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                        </div>
                        @php
                            $persentasePerubahan = 0;
                            if ($asetLancar->saldo_awal_total > 0) {
                                $persentasePerubahan = (($asetLancar->saldo_akhir_total - $asetLancar->saldo_awal_total) / $asetLancar->saldo_awal_total) * 100;
                            }
                        @endphp
                        @if($persentasePerubahan != 0)
                            <div class="mt-3 text-center">
                                <small class="text-muted">Perubahan dari Saldo Awal</small>
                                <div class="mt-1">
                                    @if($persentasePerubahan > 0)
                                        <span class="badge bg-success"><i class="fas fa-arrow-up"></i> +{{ number_format($persentasePerubahan, 1) }}%</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fas fa-arrow-down"></i> {{ number_format($persentasePerubahan, 1) }}%</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detailed Breakdown -->
            <div class="section-card">
                <h4 class="section-title">
                    <i class="fas fa-table"></i> Rincian Perhitungan Aset
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center align-middle">Komponen</th>
                                <th colspan="2" class="text-center">Saldo Awal</th>
                                <th colspan="4" class="text-center">Mutasi</th>
                                <th colspan="2" class="text-center">Saldo Akhir</th>
                            </tr>
                            <tr>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Tambah Unit</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Kurang Unit</th>
                                <th class="text-center">Nilai Total</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Nilai Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>{{ $asetLancar->nama_kegiatan }}</strong></td>
                                <td class="text-center" style="background-color: #f8fdff;">
                                    <span class="badge bg-info text-white">{{ number_format($asetLancar->saldo_awal_unit) }}</span>
                                </td>
                                <td class="text-end" style="background-color: #f8fdff;">
                                    Rp {{ number_format($asetLancar->saldo_awal_harga_satuan, 0) }}
                                </td>
                                <td class="text-center" style="background-color: #f8fff8;">
                                    @if($asetLancar->mutasi_tambah_unit > 0)
                                        <span class="badge bg-success">+{{ number_format($asetLancar->mutasi_tambah_unit) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-end" style="background-color: #f8fff8;">
                                    @if($asetLancar->mutasi_tambah_harga_satuan > 0)
                                        Rp {{ number_format($asetLancar->mutasi_tambah_harga_satuan, 0) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center" style="background-color: #f8fff8;">
                                    @if($asetLancar->mutasi_kurang_unit > 0)
                                        <span class="badge bg-danger">-{{ number_format($asetLancar->mutasi_kurang_unit) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-end" style="background-color: #f8fff8;">
                                    @if($asetLancar->mutasi_kurang_nilai_total > 0)
                                        <span class="text-danger">Rp {{ number_format($asetLancar->mutasi_kurang_nilai_total, 0) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center" style="background-color: #fffbf0;">
                                    <span class="badge bg-warning text-dark">{{ number_format($asetLancar->saldo_akhir_unit) }}</span>
                                </td>
                                <td class="text-end" style="background-color: #fffbf0;">
                                    <strong class="text-primary">Rp {{ number_format($asetLancar->saldo_akhir_total, 0) }}</strong>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td><strong>Total Nilai</strong></td>
                                <td colspan="2" class="text-end" style="background-color: #f8fdff;">
                                    <strong>Rp {{ number_format($asetLancar->saldo_awal_total, 0) }}</strong>
                                </td>
                                <td colspan="2" class="text-end" style="background-color: #f8fff8;">
                                    <strong class="text-success">Rp {{ number_format($asetLancar->mutasi_tambah_nilai_total, 0) }}</strong>
                                </td>
                                <td class="text-end" style="background-color: #f8fff8;">
                                    <strong class="text-danger">Rp {{ number_format($asetLancar->mutasi_kurang_nilai_total, 0) }}</strong>
                                </td>
                                <td colspan="2" class="text-end" style="background-color: #fffbf0;">
                                    <strong class="text-primary">Rp {{ number_format($asetLancar->saldo_akhir_total, 0) }}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Calculation Formula -->
            <div class="section-card calculation-section">
                <h4 class="section-title">
                    <i class="fas fa-calculator"></i> Formula Perhitungan
                </h4>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3">Perhitungan Nilai Total</h6>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Saldo Awal Total</label>
                            <div class="bg-light p-3 rounded">
                                <code>{{ number_format($asetLancar->saldo_awal_unit) }} unit × Rp {{ number_format($asetLancar->saldo_awal_harga_satuan, 0) }} = Rp {{ number_format($asetLancar->saldo_awal_total, 0) }}</code>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Mutasi Tambah Total</label>
                            <div class="bg-light p-3 rounded">
                                <code>{{ number_format($asetLancar->mutasi_tambah_unit) }} unit × Rp {{ number_format($asetLancar->mutasi_tambah_harga_satuan, 0) }} = Rp {{ number_format($asetLancar->mutasi_tambah_nilai_total, 0) }}</code>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-success mb-3">Perhitungan Unit</h6>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Saldo Akhir Unit</label>
                            <div class="bg-light p-3 rounded">
                                <code>{{ number_format($asetLancar->saldo_awal_unit) }} + {{ number_format($asetLancar->mutasi_tambah_unit) }} - {{ number_format($asetLancar->mutasi_kurang_unit) }} = {{ number_format($asetLancar->saldo_akhir_unit) }} unit</code>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Saldo Akhir Total</label>
                            <div class="bg-light p-3 rounded">
                                @php
                                    $harga_satuan_akhir = $asetLancar->saldo_awal_harga_satuan > 0 ? $asetLancar->saldo_awal_harga_satuan : $asetLancar->mutasi_tambah_harga_satuan;
                                @endphp
                                <code>{{ number_format($asetLancar->saldo_akhir_unit) }} unit × Rp {{ number_format($harga_satuan_akhir, 0) }} = Rp {{ number_format($asetLancar->saldo_akhir_total, 0) }}</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="section-card">
                <h4 class="section-title">
                    <i class="fas fa-history"></i> Timeline Data
                </h4>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">Data Dibuat</h6>
                            <p class="timeline-description">
                                <i class="fas fa-calendar-plus text-primary me-2"></i>
                                {{ $asetLancar->created_at->format('d F Y, H:i:s') }}<br>
                                <small class="text-muted">{{ $asetLancar->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>
                    @if($asetLancar->created_at != $asetLancar->updated_at)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Terakhir Diperbarui</h6>
                                <p class="timeline-description">
                                    <i class="fas fa-edit text-warning me-2"></i>
                                    {{ $asetLancar->updated_at->format('d F Y, H:i:s') }}<br>
                                    <small class="text-muted">{{ $asetLancar->updated_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete confirmation with SweetAlert2
            window.confirmDelete = function(id) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Apakah Anda yakin ingin menghapus data aset lancar <strong>"{{ $asetLancar->nama_kegiatan }}"</strong>?<br><br><span class="text-danger">Data yang sudah dihapus tidak dapat dikembalikan.</span>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus Data',
                    cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ route('aset-lancars.index') }}/${id}`;
                        form.innerHTML = `
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                        `;
                        document.body.appendChild(form);
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Sedang memproses penghapusan data',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            };

            // Print functionality
            window.printPage = function() {
                window.print();
            };
        });
    </script>
</body>
</html>