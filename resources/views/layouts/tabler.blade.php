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
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            z-index: 1030;
        }

        .main-content {
            margin-left: 250px;
            padding: 1rem;
        }

        .custom-header {
            background-color: #0055ff;
            color: white;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>

    @stack('page-styles')
    @livewireStyles
</head>
<body>
    <div class="sidebar">
        @include('layouts.body.navbar') {{-- Sidebar (di kiri menumpuk header) --}}
        @yield('sidebar')
    </div>

    <div class="main-content">
        @include('layouts.body.header') {{-- Header geser ke kanan --}}
        
        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.body.footer')
    </div>

    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    @stack('page-scripts')
    @livewireScripts
</body>
</html>
