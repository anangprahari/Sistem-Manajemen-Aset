<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/backgrounds/logokominfo.png') }}" />

    <!-- CSS files - URUTAN PENTING -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    
    <style>
        @import url('https://rsms.me/inter/inter.css');
        
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            --sidebar-width: 220px;
            --header-height: 80px;
            --content-padding: 1.5rem;
            --sidebar-bg: #ffffff;
            --sidebar-border: #e5e7eb;
            --main-bg: #f8fafc;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: var(--tblr-font-sans-serif);
            font-feature-settings: "cv03", "cv04", "cv11";
            background-color: var(--main-bg);
            line-height: 1.6;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            z-index: 1030;
            overflow-y: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.2);
        }

        /* Header/Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            height: var(--header-height);
            z-index: 1028;
            transition: var(--transition);
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: var(--transition);
        }

        main {
            padding-top: calc(var(--header-height) + 1rem);
            padding-left: 1rem;
            padding-right: 1rem;
            padding-bottom: 1rem;
            min-height: calc(100vh - var(--header-height));
        }

        .content-wrapper {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
        }

        /* Card styles */
        .content-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--sidebar-border);
            overflow: hidden;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 0px;
                --content-padding: 1rem;
            }

            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .navbar {
                left: 0;
                width: 100%;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1051;
                background: #3b82f6;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 8px;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1029;
                opacity: 0;
                transition: var(--transition);
            }

            .sidebar-overlay.show {
                display: block;
                opacity: 1;
            }
        }

        @media (min-width: 769px) {
            .mobile-toggle {
                display: none;
            }
        }

        /* Focus states */
        *:focus-visible {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        /* Print styles */
        @media print {
            .sidebar,
            .navbar {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
            }

            main {
                padding: 0 !important;
            }
        }
    </style>

    @stack('page-styles')
    @livewireStyles
</head>
<body>
    {{-- Mobile Toggle Button --}}
    <button class="mobile-toggle" onclick="toggleSidebar()" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>

    {{-- Mobile Overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        @include('layouts.body.navbar')
        @yield('sidebar')
    </div>

    {{-- Header --}}
    @include('layouts.body.header')

    {{-- Main Content --}}
    <div class="main-content">
        <main>
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>

        @include('layouts.body.footer')
    </div>

    <!-- Scripts - URUTAN SANGAT PENTING -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>

    <script>
        console.log('Layout script starting...');
        
        // Mobile sidebar functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar && overlay) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
                document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar && overlay) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing...');
            
            // Mobile sidebar events
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const toggle = document.querySelector('.mobile-toggle');
                
                if (window.innerWidth <= 768 && sidebar && toggle) {
                    if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                        closeSidebar();
                    }
                }
            });

            // Window resize handler
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });

            // Keyboard handler
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeSidebar();
                }
            });

            console.log('Layout initialized successfully');
        });

        // Debug helper
        window.debugLayout = function() {
            console.log('=== LAYOUT DEBUG ===');
            console.log('Bootstrap loaded:', typeof bootstrap !== 'undefined');
            console.log('jQuery loaded:', typeof $ !== 'undefined');
            console.log('Sidebar element:', document.getElementById('sidebar'));
            console.log('Header dropdown:', document.getElementById('userDropdownTrigger'));
            console.log('Window width:', window.innerWidth);
        };
    </script>

    @stack('page-scripts')
    @stack('scripts')
    @livewireScripts
</body>
</html>