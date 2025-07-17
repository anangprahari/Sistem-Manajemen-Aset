<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            --sidebar-width: 200px;
            --sidebar-bg: #ffffff;
            --sidebar-hover: rgba(0, 94, 255, 0.1);
            --sidebar-active: rgba(0, 94, 255, 0.15);
            --sidebar-text: #005eff;
            --sidebar-text-secondary: rgba(0, 94, 255, 0.7);
            --sidebar-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --header-height: 80px;
        }

        body {
            margin: 0;
            padding: 0;
            font-feature-settings: "cv03", "cv04", "cv11";
            background-color: #f8f9fa;
        }

        /* Modern Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            border-right: 1px solid #e5e7eb;
            z-index: 1030;
            box-shadow: var(--sidebar-shadow);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 94, 255, 0.3) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(0, 94, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 94, 255, 0.5);
        }

         /* Logo Section - Fixed height to match header */
        .sidebar-logo {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1.5rem;
            border-bottom: 1px solid rgba(0, 94, 255, 0.1);
            background: #ffffff;
            flex-shrink: 0;
        }

        /* Logo Section */
        .sidebar .text-center {
            padding: 2rem 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(0, 94, 255, 0.1);
            background: #ffffff;
        }

        .sidebar .text-center img {
            transition: var(--transition-smooth);
            opacity: 0.9;
        }

        .sidebar .text-center:hover img {
            transform: scale(1.05);
            opacity: 1;
        }

        /* Navigation Styles */
        .sidebar .nav {
            padding: 1.5rem 1rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 12px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition-smooth);
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 94, 255, 0.1), transparent);
            transition: left 0.6s;
        }

        .sidebar .nav-link:hover::before {
            left: 100%;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: #005eff;
            transform: translateX(8px);
            border-color: rgba(0, 94, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 94, 255, 0.15);
        }

        .sidebar .nav-link.active {
            background: var(--sidebar-active);
            color: #005eff;
            border-color: rgba(0, 94, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 94, 255, 0.2);
            transform: translateX(4px);
        }

        .sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: #005eff;
            border-radius: 2px 0 0 2px;
        }

        /* Icon Styles */
        .sidebar .nav-link .icon {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
            opacity: 0.8;
            transition: var(--transition-smooth);
        }

        .sidebar .nav-link:hover .icon,
        .sidebar .nav-link.active .icon {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Dropdown Styles */
        .sidebar .nav-item.dropdown {
            margin-bottom: 0.5rem;
        }

        .sidebar .nav-item.dropdown .nav-link {
            margin-bottom: 0;
        }

        .sidebar .dropdown-toggle::after {
            margin-left: auto;
            border: none;
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.75rem;
            transition: var(--transition-smooth);
        }

        .sidebar .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        .sidebar .dropdown-menu {
            position: static;
            display: none;
            float: none;
            width: auto;
            margin-top: 0.5rem;
            margin-left: 2rem;
            padding: 0;
            background: rgba(0, 94, 255, 0.05);
            border: 1px solid rgba(0, 94, 255, 0.1);
            border-radius: 12px;
            box-shadow: inset 0 2px 10px rgba(0, 94, 255, 0.1);
            animation: slideDown 0.3s ease;
        }

        .sidebar .dropdown-menu.show {
            display: block;
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sidebar .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            clear: both;
            font-weight: 400;
            color: var(--sidebar-text-secondary);
            text-decoration: none;
            white-space: nowrap;
            background: transparent;
            border: none;
            border-radius: 8px;
            transition: var(--transition-smooth);
            font-size: 0.9rem;
            position: relative;
        }

        .sidebar .dropdown-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: #005eff;
            border-radius: 2px;
            transition: var(--transition-smooth);
        }

        .sidebar .dropdown-item:hover {
            background: rgba(0, 94, 255, 0.1);
            color: #005eff;
            transform: translateX(4px);
        }

        .sidebar .dropdown-item:hover::before {
            height: 60%;
        }

        .sidebar .dropdown-item:active {
            background: rgba(0, 94, 255, 0.15);
        }

        /* Main Content Adjustments */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 0;
            transition: var(--transition-smooth);
        }

        .navbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            z-index: 1028;
            height: 80px;
            transition: var(--transition-smooth);
        }

        main {
            padding: 100px 1rem 1rem 0.5rem;
            overflow-x: auto;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: var(--transition-smooth);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .navbar {
                left: 0;
                width: 100%;
            }

            /* Mobile toggle button */
            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1031;
                background: #005eff;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 8px;
                cursor: pointer;
                transition: var(--transition-smooth);
            }

            .sidebar-toggle:hover {
                transform: scale(1.1);
            }
        }

        @media (min-width: 769px) {
            .sidebar-toggle {
                display: none;
            }
        }

        /* Enhanced animations */
        .sidebar .nav-link {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .sidebar .nav-link:nth-child(1) { animation-delay: 0.1s; }
        .sidebar .nav-link:nth-child(2) { animation-delay: 0.2s; }
        .sidebar .nav-link:nth-child(3) { animation-delay: 0.3s; }
        .sidebar .nav-link:nth-child(4) { animation-delay: 0.4s; }
        .sidebar .nav-link:nth-child(5) { animation-delay: 0.5s; }
        .sidebar .nav-link:nth-child(6) { animation-delay: 0.6s; }
        .sidebar .nav-link:nth-child(7) { animation-delay: 0.7s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading animation for sidebar */
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(0, 94, 255, 0.5), transparent);
            animation: loading 2s infinite;
        }

        @keyframes loading {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Glassmorphism effects */
        .sidebar .nav-link:hover {
            backdrop-filter: blur(10px);
        }

        .sidebar .dropdown-menu {
            backdrop-filter: blur(15px);
        }
    </style>

    @stack('page-styles')
    @livewireStyles
</head>
<body>
    {{-- Mobile Toggle Button --}}
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        <!-- Logo Section -->
        <div class="sidebar-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/backgrounds/logokominfo.png') }}" alt="Logo Kominfo" width="180">
            </a>
        </div>

        <!-- Navigation -->
        <nav class="nav flex-column nav-pills p-3">
            <!-- Beranda -->
            <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"/>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
                </svg>
                {{ __('Beranda') }}
            </a>

            <!-- Aset -->
            <a class="nav-link {{ request()->is('asets*') ? 'active' : '' }}" href="{{ route('asets.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 7v4a1 1 0 0 0 1 1h3"/>
                    <path d="M7 7v10"/>
                    <path d="M10 8v8a1 1 0 0 0 1 1h2a1 1 0 0 0 1 -1v-8a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1z"/>
                    <path d="M17 7v4a1 1 0 0 0 1 1h3"/>
                    <path d="M21 7v10"/>
                    <path d="M22 7h-2l-2 -2h-6l-2 2h-2"/>
                </svg>
                {{ __('Aset') }}
            </a>

            <!-- Produk -->
            <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z"/>
                    <path d="M2 13.5v5.5l5 3"/>
                    <path d="M7 16.545l5 -3.03"/>
                    <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z"/>
                    <path d="M12 19l5 3"/>
                    <path d="M17 16.5l5 -3"/>
                    <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5"/>
                    <path d="M7 5.03v5.455"/>
                    <path d="M12 8l5 -3"/>
                </svg>
                {{ __('Produk') }}
            </a>

            <!-- Pesanan Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is('orders*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"/>
                        <path d="M12 12l8 -4.5"/>
                        <path d="M12 12v9"/>
                        <path d="M12 12l-8 -4.5"/>
                        <path d="M15 18h7"/>
                        <path d="M19 15l3 3l-3 3"/>
                    </svg>
                    {{ __('Pesanan') }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('orders.index') }}">Semua</a>
                    <a class="dropdown-item" href="{{ route('orders.complete') }}">Selesai</a>
                    <a class="dropdown-item" href="{{ route('orders.pending') }}">Tunggu</a>
                    <a class="dropdown-item" href="{{ route('due.index') }}">Karena</a>
                </div>
            </div>

            <!-- Pembelian Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is('purchases*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"/>
                        <path d="M12 12l8 -4.5"/>
                        <path d="M12 12v9"/>
                        <path d="M12 12l-8 -4.5"/>
                        <path d="M22 18h-7"/>
                        <path d="M18 15l-3 3l3 3"/>
                    </svg>
                    {{ __('Pembelian') }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('purchases.index') }}">Semua</a>
                    <a class="dropdown-item" href="{{ route('purchases.approvedPurchases') }}">Persetujuan</a>
                    <a class="dropdown-item" href="{{ route('purchases.dailyPurchaseReport') }}">Laporan pembelian harian</a>
                </div>
            </div>

            <!-- Kutipan -->
            <a class="nav-link {{ request()->is('quotations') ? 'active' : '' }}" href="{{ route('quotations.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                </svg>
                {{ __('Kutipan') }}
            </a>

            <!-- Halaman Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is('suppliers*', 'customers*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"/>
                        <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2"/>
                    </svg>
                    {{ __('Halaman') }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('suppliers.index') }}">Pemasok</a>
                    <a class="dropdown-item" href="{{ route('customers.index') }}">Pelanggan</a>
                </div>
            </div>

            <!-- Pengaturan Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->is('users*', 'categories*', 'units*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066
                            c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426
                            1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724
                            1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066
                            c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572
                            c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573
                            c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"/>
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                    </svg>
                    {{ __('Pengaturan') }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('users.index') }}">Pengguna</a>
                    <a class="dropdown-item" href="{{ route('categories.index') }}">Kategori</a>
                    <a class="dropdown-item" href="{{ route('units.index') }}">Unit</a>
                </div>
            </div>
        </nav>
    </div>

    {{-- Header --}}
    @include('layouts.body.header')

    {{-- Main Content --}}
    <div class="main-content">
        <main>
            @yield('content')
        </main>

        @include('layouts.body.footer')
    </div>

    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script>
        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Enhanced dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.nav-item.dropdown');
            
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Close other dropdowns
                    dropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            const otherMenu = otherDropdown.querySelector('.dropdown-menu');
                            const otherToggle = otherDropdown.querySelector('.dropdown-toggle');
                            otherMenu.classList.remove('show');
                            otherToggle.setAttribute('aria-expanded', 'false');
                        }
                    });
                    
                    // Toggle current dropdown
                    const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
                    toggle.setAttribute('aria-expanded', !isExpanded);
                    menu.classList.toggle('show');
                });
            });
        });
    </script>
    @stack('page-scripts')
    @livewireScripts
</body>
</html>