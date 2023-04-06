<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <meta content="" name="description">
        <meta content="" name="keywords">


        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/assets/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('\assets/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/assets/css/style.css') }}" rel="stylesheet">



    </head>
    <body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex justify-content-between align-items-center">

            <div id="logo">
                <a href="/home"><img src="{{asset('assets/img/Logo.png')}}" alt="" width="25" height="25" > </a>
                <span style="color:white; margin-left: 10px;">   {{ config('app.name', 'Laravel') }}    </span>
                <!-- Uncomment below if you prefer to use a text logo -->
                <!--<h1><a href="index.html">Regna</a></h1>-->
            </div>
            <nav id="navbar" class="navbar">
                @if (Route::has('login'))
                <ul>
                        @auth
                        <li><a class="nav-link scrollto active" href="/home">Home</a></li>
                        @else
                        <li><a class="nav-link scrollto active" href="/login">Login</a></li>
                            @if (Route::has('register'))
                    <li><a class="nav-link scrollto" href="/register">Register</a></li>
                            @endif
                        @endauth
                </ul>
                @endif
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1>Welcome to <img src="{{asset('assets/img/Logo.png')}}" alt="" width="40" height="40" > {{ config('app.name', 'Laravel') }} - Project </h1>
        </div>
    </section><!-- End Hero Section -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{ asset('assets/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{asset('assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{asset('assets/assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('assets/assets/js/main.js')}}"></script>


    </body>
</html>
