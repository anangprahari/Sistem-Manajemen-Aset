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
    margin: 0;
    padding: 0;
    font-feature-settings: "cv03", "cv04", "cv11";
}

.sidebar {
    width: 200px;
    min-height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #f8f9fa;
    border-right: 1px solid #ddd;
    z-index: 1030;
}

.main-content {
    margin-left: 200px;
    padding: 0;
}

/* Header fix */
.navbar {
    position: fixed;
    top: 0;
    left: 200px;
    width: calc(100% - 200px);
    z-index: 1028;
    height: 80px;
}

main {
    padding: 100px 1rem 1rem 0.5rem; /* top padding 100px */
    overflow-x: auto;
}

    </style>

    @stack('page-styles')
    @livewireStyles
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        @include('layouts.body.navbar')
        @yield('sidebar')
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
    @stack('page-scripts')
    @livewireScripts
</body>
</html>
