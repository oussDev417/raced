<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="@yield('meta_description', 'RACED ONG - Organisation Non Gouvernementale')">
    <meta name="keywords" content="@yield('meta_keywords', 'ONG, aide humanitaire, développement, projets sociaux')">
    <meta name="author" content="BIO DEV- XTOP DIGITAL">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title -->
    <title>@yield('title') - RACED ONG</title>
    
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon-180x180.png') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Stylesheets Start -->
    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_charitics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <!-- Additional CSS -->
    @yield('styles')
</head>
<body>
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>
    
    <!-- Header -->
    @include('frontend.layouts.header')
    
    <!-- Main Content -->
    <main>
        @include('frontend.layouts.alerts')
        @yield('content')
    </main>
    
    
    <!-- Footer -->
    @include('frontend.layouts.footer')
    
    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>
    
    <!-- libraries JS -->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide-extension-auto-scroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slim-select/slimselect.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/animate-wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splittype/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fslightbox/fslightbox.js') }}"></script>
    <script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>

    <!-- custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/tab.js') }}"></script>
    <script src="{{ asset('assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/js/progressbar.js') }}"></script>
    <script src="{{ asset('assets/js/donate-form.js') }}"></script>
    
    <!-- Additional JS -->
    @yield('scripts')
</body>
</html> 
