<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Daruuri') }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
     <!-- Stylesheet -->
     <link href="css/frontend/bootstrap.min.css" rel="stylesheet" type="text/css">
     <link href="css/frontend/animate.min.css" rel="stylesheet" type="text/css">
     <link href="css/frontend/javascript-plugins-bundle.css" rel="stylesheet" />

     <!-- CSS | Main style file -->
     <link href="css/frontend/style-main.css" rel="stylesheet" type="text/css">
     <link id="menuzord-menu-skins" href="js/frontend/menuzord/css/skins/menuzord-rounded-boxed.css" rel="stylesheet" />
 
     <!-- CSS | Responsive media queries -->
     <link href="css/frontend/responsive.css" rel="stylesheet" type="text/css">
     <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
 
     <!-- CSS | Theme Color -->
     <link href="css/frontend/theme-skin-color-set1.css" rel="stylesheet" type="text/css">

     
    @stack('style')

</head>

<body class="container-1340px">
    <div id="wrapper" class="clearfix">
        <!-- Header -->
       <x-frontend.header/>

        <!-- Start main-content -->
        @yield('content')
        <!-- end main-content -->

        <!-- Footer -->
        <x-frontend.footer/>

        <a class="scrollToTop" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>
    </div>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

     <!-- external javascripts -->
     <script src="js/frontend/jquery.js"></script>
     <script src="js/frontend/bootstrap.min.js"></script>
     <script src="js/frontend/javascript-plugins-bundle.js"></script>
     <script src="js/frontend/menuzord/js/menuzord.js"></script>

     <!-- JS | Custom script for all pages -->
     <script src="js/frontend/custom.js"></script>
     @stack('script')
</body>

</html>
