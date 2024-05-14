<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('meta_keyword','puppy info')">
    <meta name="description" content="@yield('meta_description','puppy info ')">
    <meta name="author" content="@yield('author','Bittu kumar')">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front-asset/brand-images/logo.png') }}">
    <link rel="icon" type="image/png') }}" sizes="32x32" href="{{ asset('front-asset/images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png') }}" sizes="16x16" href="{{ asset('front-asset/images/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('front-asset/images/icons/site.html') }}">
    <link rel="mask-icon" href="{{ asset('front-asset/images/icons/safari-pinned-tab.svg') }}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('front-asset/images/icons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('front-asset/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('front-asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-asset/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front-asset/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front-asset/css/plugins/jquery.countdown.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('front-asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front-asset/css/skins/skin-demo-7.css') }}">
    <link rel="stylesheet" href="{{ asset('front-asset/css/demos/demo-7.css') }}">
     <!-- Custom CSS File  -->
     @yield('style')
</head>

<body>
    <div class="page-wrapper">
        @include('Web.layout.header')
        <main class="main">
            @yield('main')
        </main><!-- End .main -->
        @include('Web.layout.footer')
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <!--  Mobile-menu-container Code in Footer File -->@yield('mobilemenu')<!-- End mobile-menu-container -->
    <!--  Sign in / Register Modal in Footer File -->@yield('registermodel')<!-- End Sign in / Register model -->
    <!--  Newsletter Code in Footer File -->@yield('newsletter')<!-- End Newsletter -->
    
    <!-- Plugins JS File -->
    <script src="{{ asset('front-asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/superfish.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('front-asset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front-asset/js/jquery.countdown.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('front-asset/js/main.js') }}"></script>
    <script src="{{ asset('front-asset/js/demos/demo-7.js') }}"></script>
    <!-- Fontawesome kit File " DO NOT REMOVE " just comment it, if not uses -->
    <script src="https://kit.fontawesome.com/f5b8db715c.js" crossorigin="anonymous"></script>
    <!-- Custom JS File  -->
    @yield('scripts')

</body>
</html>