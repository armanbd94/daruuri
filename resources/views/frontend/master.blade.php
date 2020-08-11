<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="{{config('settings.seo_meta_title') }}"/>
    <meta name="description" content="{{config('settings.seo_meta_description') }}"/> 
    <meta name="robots" content="index, follow">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="canonical" href="{{ url()->current() }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('settings.site_title') ?? env('APP_NAME') }} - @yield('title')</title>
    <link rel="shortcut icon" href="storage/{{LOGO.config('settings.site_favicon') }}" />

    <!-- Stylesheet -->
    <link href="css/fontawesome.css" rel="stylesheet" type="text/css" />
    <link href="css/frontend.css" rel="stylesheet">
    <link href="css/frontend/javascript-plugins-bundle.css" rel="stylesheet" />
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
            <img src="images/daruuri.png" style="width: 70px;" alt="loading..."  />
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
     <!-- external javascripts -->
     <script src="js/frontend.js"></script>
     <script src="js/frontend/javascript-plugins-bundle.js"></script>
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
