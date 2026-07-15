<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} @isset($pageTitle) - {{ $pageTitle }} @endisset</title>
    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
    <!-- resources -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fancybox/dist/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <!-- custom -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>



<body class="{{ $textColorSite }} {{ $colorSiteBg }}">
    <header class="{{ $bgColorMenuHor }} {{ $colorMenuHorText }}">
        <x-user-bar menu-hor-text="{{ $colorMenuHorText }}" menu-hor="{{ $bgColorMenuHor }}" />
    </header>

    <div class="d-flex pt-3">
        <x-side-bar menu-vert-text="{{ $colorMenuVertText }}" menu-vert="{{ $bgColorMenuVert }}" />

            {{ $slot }}

    </div>

    <!-- resources -->
    <script src="{{ asset('assets/datatables/jquery.min.js') }}"></script> 
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('assets/main/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/instascan.min.js') }}"></script>
    <script src="{{ asset('assets/js/autocep.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
