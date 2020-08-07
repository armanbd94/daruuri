<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="storage/{{LOGO.config('settings.site_favicon') }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('settings.site_title') ?? env('APP_NAME') }} - @yield('title')</title>
    <link rel="shortcut icon" href="storage/{{LOGO.config('settings.site_favicon') }}" />
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
     <!-- Stylesheet -->
     <link href="css/fontawesome.css" rel="stylesheet" type="text/css" />
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
    <style>
        /* :: 4.0 Preloader Area CSS */
#preloader {
  overflow: hidden;
  height: 100%;
  left: 0;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 100000000;
  background-color: #fff;
  display: table;
}

#preloader #loading {
  display: table-cell;
  vertical-align: middle;
  text-align: center;
}

#preloader #loading img {
  width: 100px;
  -webkit-animation: 1500ms linear 0s normal none infinite running south-load;
  animation: 1500ms linear 0s normal none infinite running south-load;
}
@-webkit-keyframes south-load {
  0% {
    -webkit-transform: rotateY(0deg);
    transform: rotateY(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
    transform: rotateY(360deg);
  }
}

@keyframes south-load {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotateY(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
    transform: rotateY(360deg);
  }
}
    </style>
</head>

<body class="container-1340px">
    <!-- BEGIN:: PRELOADER -->
    <div id="preloader">
        <div id="loading">
            <img src="storage/{{LOGO.config('settings.site_favicon')}}" alt="loading..."  />
            {{-- <br><img src="{{asset('public/website-assets/img/loading-text.gif')}}" alt="loading..." /> --}}
        </div>
    </div>
    <!-- END:: PRELOADER -->
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
     {{-- <script src="js/frontend/jquery.js"></script> --}}
     <script src="js/backend/jquery.min.js" type="text/javascript"></script>
     <script src="js/backend/popper.js" type="text/javascript"></script>
     <script src="js/frontend/bootstrap.min.js"></script>
     <script src="js/frontend/javascript-plugins-bundle.js"></script>
     <script src="js/frontend/menuzord/js/menuzord.js"></script>

     <!-- JS | Custom script for all pages -->
     <script src="js/frontend/custom.js"></script>
     @stack('script')
     <script>
         var $window = $(window);

        // :: Preloader Active Code
        $window.on('load', function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });
        });
     </script>
</body>

</html>
