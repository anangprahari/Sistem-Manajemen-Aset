@extends('layouts.tabler')

@section('content')
    <!-- Enhanced Page Header with Gradient Background -->
    <div class="page-header d-print-none" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 0 0 1rem 1rem; margin-bottom: 2rem;">
        <div class="container-xl">
            <div class="row g-2 align-items-center py-4">
                <div class="col">
                    <div class="page-pretitle text-white-50">
                        <i class="ti ti-dashboard me-2"></i>Overview
                    </div>
                    <h2 class="page-title text-white mb-0">
                        Dashboard
                    </h2>
                    <p class="text-white-75 mb-0 mt-1">Welcome back! Here's what's happening with your business today.</p>
                </div>
                <!-- Enhanced Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex gap-2">
                        <a href="{{ route('products.create') }}" class="btn btn-light btn-pill d-none d-sm-inline-flex align-items-center">
                            <x-icon.plus class="me-1"/>
                            Add Product
                        </a>
                        <a href="{{ route('products.create') }}" class="btn btn-light btn-icon btn-pill d-sm-none" aria-label="Create new product">
                            <x-icon.plus/>
                        </a>
                        <a href="{{ route('orders.create') }}" class="btn btn-outline-light btn-pill d-none d-sm-inline-flex align-items-center">
                            <x-icon.plus class="me-1"/>
                            New Order
                        </a>
                        <a href="{{ route('orders.create') }}" class="btn btn-outline-light btn-icon btn-pill d-sm-none" aria-label="Create new order">
                            <x-icon.plus/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <!-- Enhanced Stats Cards -->
                <div class="col-12">
                    <div class="row row-cards">
                        <!-- Products Card -->
                        <div class="col-sm-6 col-lg-3 mb-4">
                            <a href="{{ route('products.store') }}" class="text-decoration-none">
                                <div class="card card-hover shadow-sm border-0 h-100" style="transition: all 0.3s ease; border-radius: 1rem;">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                        <path d="M2 13.5v5.5l5 3" />
                                                        <path d="M7 16.545l5 -3.03" />
                                                        <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                        <path d="M12 19l5 3" />
                                                        <path d="M17 16.5l5 -3" />
                                                        <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                        <path d="M7 5.03v5.455" />
                                                        <path d="M12 8l5 -3" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-bold text-dark fs-4">
                                                    {{ $products }}
                                                </div>
                                                <div class="text-muted small">
                                                    Products
                                                </div>
                                                <div class="text-success small mt-1">
                                                    <i class="ti ti-category me-1"></i>{{ $categories }} categories
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 pt-0">
                                        <div class="d-flex align-items-center text-muted small">
                                            <i class="ti ti-trending-up me-1"></i>
                                            <span>Manage inventory</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Orders Card -->
                        <div class="col-sm-6 col-lg-3 mb-4">
                            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                                <div class="card card-hover shadow-sm border-0 h-100" style="transition: all 0.3s ease; border-radius: 1rem;">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17h-11v-14h-2" />
                                                        <path d="M6 5l14 1l-1 7h-13" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-bold text-dark fs-4">
                                                    {{ $orders }}
                                                </div>
                                                <div class="text-muted small">
                                                    Orders
                                                </div>
                                                <div class="text-success small mt-1">
                                                    <i class="ti ti-check me-1"></i>{{ $completedOrders }} {{ __('completed') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 pt-0">
                                        <div class="d-flex align-items-center text-muted small">
                                            <i class="ti ti-shopping-cart me-1"></i>
                                            <span>View all orders</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Purchases Card -->
                        <div class="col-sm-6 col-lg-3 mb-4">
                            <a href="{{ route('purchases.store') }}" class="text-decoration-none">
                                <div class="card card-hover shadow-sm border-0 h-100" style="transition: all 0.3s ease; border-radius: 1rem;">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                                        <path d="M3 9l4 0" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-bold text-dark fs-4">
                                                    {{ $purchases }}
                                                </div>
                                                <div class="text-muted small">
                                                    Purchases
                                                </div>
                                                <div class="text-info small mt-1">
                                                    <i class="ti ti-calendar-today me-1"></i>{{ $todayPurchases }} today
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 pt-0">
                                        <div class="d-flex align-items-center text-muted small">
                                            <i class="ti ti-truck me-1"></i>
                                            <span>Manage purchases</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Quotations Card -->
                        <div class="col-sm-6 col-lg-3 mb-4">
                            <a href="{{ route('quotations.index') }}" class="text-decoration-none">
                                <div class="card card-hover shadow-sm border-0 h-100" style="transition: all 0.3s ease; border-radius: 1rem;">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-files text-dark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                                        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                                        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-bold text-dark fs-4">
                                                    {{ $quotations }}
                                                </div>
                                                <div class="text-muted small">
                                                    Quotations
                                                </div>
                                                <div class="text-warning small mt-1">
                                                    <i class="ti ti-calendar-today me-1"></i>{{ $todayQuotations }} today
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 pt-0">
                                        <div class="d-flex align-items-center text-muted small">
                                            <i class="ti ti-file-text me-1"></i>
                                            <span>View quotations</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Custom Styles -->
    <style>
        .card-hover {
            transition: all 0.3s ease !important;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }
        .btn-pill {
            border-radius: 50px !important;
        }
        .avatar {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
        }
        .fs-4 {
            font-size: 1.5rem !important;
        }
        .page-header {
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.1"/><circle cx="10" cy="50" r="1" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.5;
        }
        .text-white-50 {
            color: rgba(255, 255, 255, 0.5) !important;
        }
        .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
        }
        .border-0 {
            border: none !important;
        }
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
    </style>
@endsection

@push('page-libraries')
    <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
    <script src="{{ asset('dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
    <script src="{{ asset('dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
@endpush

@pushonce('page-scripts')
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: [2, 1],
                    dashArray: [0, 3],
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "May",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67]
                },{
                    name: "April",
                    data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary"), tabler.getColor("gray-600")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
                }],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [
                    '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                ],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            })).render();
        });
        // @formatter:on
    </script>
@endpushonce