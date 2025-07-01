{{-- filepath: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>@yield('title', 'ClinicEMR Solutions')</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendors/images/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendors/images/favicon-16x16.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- CSS -->
     <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"  type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}" />

    @stack('styles')

</head>

<body>
   <!-- 
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="ClinicEMR" width="100%" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Please wait...</div>
        </div>
    </div>-->


    {{-- Header --}}
    @include('layouts.partials.header')
    
    {{-- Sidebar --}}
    @include('layouts.partials.sidebar')

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            @yield('content')
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    {{-- Welcome Modal --}}
    @include('layouts.partials.welcome-modal')

    <!-- JS -->

<!-- JS: Place jQuery FIRST, before all plugins that depend on it -->
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('vendors/scripts/core.js') }}"></script>
<script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('vendors/scripts/process.js') }}"></script>
<script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
<script src="{{ asset('src/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/scripts/dashboard3.js') }}"></script>
    @yield('scripts')


    @stack('scripts')
    <!-- Bootstrap 5 JS (no jQuery needed) -->

<script src="{{ asset('vendors/scripts/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
