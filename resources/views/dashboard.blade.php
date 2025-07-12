@extends('layouts.tabler')

@section('content')
    <style>
        /* Modern Design Enhancements */
        .modern-dashboard {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
        }
        
        .modern-dashboard::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            z-index: -1;
        }
        
        .page-header-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            margin: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .page-title-modern {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0;
        }
        
        .page-pretitle-modern {
            color: #6c757d;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        
        .btn-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 16px;
            padding: 12px 24px;
            font-weight: 600;
            text-transform: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        
        .btn-icon-modern {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .card-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        
        .card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }
        
        .card-modern:hover::before {
            left: 100%;
        }
        
        .card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        .card-body-modern {
            padding: 32px;
            position: relative;
            z-index: 1;
        }
        
        .avatar-modern {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .avatar-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            opacity: 0.1;
        }
        
        .avatar-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        .avatar-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            box-shadow: 0 8px 25px rgba(86, 171, 47, 0.3);
        }
        
        .avatar-info {
            background: linear-gradient(135deg, #29b6f6 0%, #0288d1 100%);
            box-shadow: 0 8px 25px rgba(41, 182, 246, 0.3);
        }
        
        .avatar-warning {
            background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%);
            box-shadow: 0 8px 25px rgba(255, 167, 38, 0.3);
        }
        
        .font-weight-medium-modern {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }
        
        .text-muted-modern {
            color: #718096;
            font-size: 0.925rem;
            font-weight: 500;
        }
        
        .container-modern {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .row-cards-modern {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }
        
        .icon-modern {
            width: 28px;
            height: 28px;
            stroke-width: 2.5;
        }
        
        @media (max-width: 768px) {
            .page-header-modern {
                margin: 10px;
                padding: 20px;
            }
            
            .page-title-modern {
                font-size: 2rem;
            }
            
            .row-cards-modern {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .card-body-modern {
                padding: 24px;
            }
        }
        
        /* Pulse animation for numbers */
        .stat-number {
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* Floating animation for icons */
        .avatar-modern {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        
        /* Card link styles */
        .card-link-modern {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .card-link-modern:hover {
            text-decoration: none;
            color: inherit;
        }
    </style>

    <div class="modern-dashboard">
        <div class="page-header-modern">
            <div class="container-modern">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle-modern">
                            Overview
                        </div>
                        <h1 class="page-title-modern">
                            Dashboard
                        </h1>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto">
                        <div class="d-flex gap-3">
                            <a href="{{ route('products.create') }}" class="btn btn-modern text-white d-none d-sm-inline-block">
                                <x-icon.plus class="me-2"/>
                                Add new Product
                            </a>
                            <a href="{{ route('products.create') }}" class="btn btn-modern btn-icon-modern text-white d-sm-none" aria-label="Create new product">
                                <x-icon.plus/>
                            </a>
                            <a href="{{ route('orders.create') }}" class="btn btn-modern text-white d-none d-sm-inline-block">
                                <x-icon.plus class="me-2"/>
                                Create new order
                            </a>
                            <a href="{{ route('orders.create') }}" class="btn btn-modern btn-icon-modern text-white d-sm-none" aria-label="Create new order">
                                <x-icon.plus/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-modern">
                <div class="row-cards-modern">
                    <a href="{{ route('products.store') }}" class="card-link-modern">
                        <div class="card-modern">
                            <div class="card-body-modern">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-modern avatar-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-modern icon-tabler icon-tabler-packages" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                        <div class="font-weight-medium-modern stat-number">
                                            {{ $products }} Products
                                        </div>
                                        <div class="text-muted-modern">
                                            {{ $categories }} categories
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('orders.index') }}" class="card-link-modern">
                        <div class="card-modern">
                            <div class="card-body-modern">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-modern avatar-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-modern" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 17h-11v-14h-2" />
                                                <path d="M6 5l14 1l-1 7h-13" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium-modern stat-number">
                                            {{ $orders }} Orders
                                        </div>
                                        <div class="text-muted-modern">
                                            {{ $completedOrders }} {{ __('completed') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('purchases.store') }}" class="card-link-modern">
                        <div class="card-modern">
                            <div class="card-body-modern">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-modern avatar-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-modern icon-tabler icon-tabler-truck-delivery" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                                <path d="M3 9l4 0" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium-modern stat-number">
                                            {{ $purchases }} Purchases
                                        </div>
                                        <div class="text-muted-modern">
                                            {{ $todayPurchases }} today
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('quotations.index') }}" class="card-link-modern">
                        <div class="card-modern">
                            <div class="card-body-modern">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-modern avatar-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-modern icon-tabler icon-tabler-files" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                                <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium-modern stat-number">
                                            {{ $quotations }} Quotations
                                        </div>
                                        <div class="text-muted-modern">
                                            {{ $todayQuotations }} today
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
            // Add loading animation
            const cards = document.querySelectorAll('.card-modern');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });
            
            // Original chart code
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