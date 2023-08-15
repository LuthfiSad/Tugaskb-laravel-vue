<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Vue</title>
    <!-- Favicons -->
    <link href="{{ asset('assets/images/HIMTI.png') }}" rel="icon">
    <link href="{{ asset('assets/images/HIMTI.png') }}" rel="apple-touch-icon">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <!-- Ninestars -->
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/ninestars/assets/css/style.css') }}" rel="stylesheet">
    <!-- Tutup Ninestars -->

    <!-- AVILON -->
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/avilon/assets/css/style.css') }}" rel="stylesheet"> --}}
    <!-- Tutup AVILON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body  id="body" data-spy="scroll" data-target=".navbar" data-offset="100"  >
    <div id="app"></div>
    <script>
        var assetUrl = '{{ asset('') }}';
    </script>

    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/aos/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/landingpage.js') }}"></script>
    @vite('resources/js/app.js')
</body>

</html>
