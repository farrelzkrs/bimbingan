<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sneat-admin/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') - Sistem Bimbingan Skripsi</title>
    <meta name="description" content="Sistem Bimbingan Skripsi" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat-admin/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat-admin/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('sneat-admin/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sneat-admin/js/config.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.sidebar')

            <div class="layout-page">
                @include('layouts.navbar')

                <div class="content-wrapper">
                    @yield('content')
                </div>

                @include('layouts.footer')
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('sneat-admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('sneat-admin/vendor/js/menu.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('sneat-admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('sneat-admin/js/main.js') }}"></script>

    <!-- Page JS -->
    @yield('page-scripts')
</body>

</html>
