<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital-management</title>

    <link rel="shortcut icon" type="image/png"
        href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('dist/js/owl.carousel/owl.carousel.min.css') }}">
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/prism-okaidia.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}">


    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- services --}}
    <script type="module">
        import {
            confirmEdit,
            confirmDelete,
            showErrorAlert,
            confirmLogout
        } from '{{ asset('services/sweetAlertService.js') }}';

        // Assign fungsi ke window agar bisa digunakan di HTML
        window.confirmEdit = confirmEdit;
        window.confirmDelete = confirmDelete;
        window.showErrorAlert = showErrorAlert;
        window.confirmLogout = confirmLogout;
    </script>
</head>

<body>
    <div class="preloader">
        {{-- <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" /> --}}
        <img src="{{ asset('icons/icon-loader.gif') }}" alt="loader" class="lds-ripple img-fluid"
            style="width: 200px; height: 150px; margin-top: -80px;" />
        {{-- <img src="{{ asset('icons/icon-loader.gif') }}" alt="loader" class="lds-ripple img-fluid loader-large" /> --}}
    </div>
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('components.sidebar.sidebar')
        <div class="body-wrapper">
            @include('components.topbar.topbar')
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/simplebar.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ asset('dist/js/app.init.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/js/custom.js') }}"></script>
<script src="{{ asset('dist/js/apexcharts.min.js') }}"></script>
{{-- <script src="{{ asset('dist/js/card-custom.js') }}"></script> --}}



<script src="{{ asset('dist/js/datatable-basic.init.js') }}"></script>
<script src="{{ asset('dist/js/jquery.dataTables.min.js') }}"></script>

</html>
