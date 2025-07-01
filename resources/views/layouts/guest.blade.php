
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ClinicEMR')</title>
    <link rel="icon" href="{{ asset('vendors/images/deskapp-logo.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            @yield('content')
        </div>
    </div>

    <!-- JS: Place jQuery FIRST, before all plugins that depend on it -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    @stack('scripts')
</body>
</html>