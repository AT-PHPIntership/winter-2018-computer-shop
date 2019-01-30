<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@lang('public.title')</title>
        <base href="{{asset('')}}">
        @routes
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="public_asset/images/favicon.ico">
        <!-- CSS
    	============================================ -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="public_asset/css/bootstrap.min.css">
        <!-- Lightbox CSS-->
        <link rel="stylesheet" href="admin_asset/vendor/lightbox/lightbox.css">
        <!-- Icon Font CSS -->
        <link rel="stylesheet" href="public_asset/css/icon-font.min.css">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="public_asset/css/plugins.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="public_asset/css/style.css">
        <!-- Custom Style CSS -->
        <link rel="stylesheet" href="public_asset/css/custom.css">
        <!-- Modernizer JS -->
        <script src="public_asset/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        @include('public.layout.header')
        @include('public.layout.mini_cart')
        @yield('content')
        @include('public.layout.brand')
        @include('public.layout.subcribe')
        @include('public.layout.footer')
        <!-- JS
        ============================================ -->
        <!-- jQuery JS -->
        <script src="public_asset/js/vendor/jquery-1.12.4.min.js"></script>
        <!-- Popper JS -->
        <script src="public_asset/js/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="public_asset/js/bootstrap.min.js"></script>
        <!-- Lightbox JS -->
        <script src="admin_asset/vendor/lightbox/lightbox.js"> </script>
        <!-- Plugins JS -->
        <script src="public_asset/js/plugins.js"></script>
        <!-- Main JS -->
        <script src="public_asset/js/main.js"></script>
        <!-- Custom JS -->
        <script src="public_asset/js/custom.js"></script>
        <!-- Cart JS -->
        <script src="public_asset/js/cart.js"></script>
    </body>
</html>
