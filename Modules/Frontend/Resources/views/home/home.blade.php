@extends('frontend.master')

@push('style')
<!-- REVOLUTION STYLE SHEETS -->
<link rel="stylesheet" type="text/css" href="js/frontend/revolution-slider/css/rs6.css">
@endpush

@section('content')
<div class="main-content-area">
    <!-- Section: SLider -->
    @include('frontend::home.slider.slider')

    <!-- Section: Service Search Form Component-->
   <x-frontend.search-form/>

    <!-- Section: Analysis -->
    @include('frontend::home.analysis.analysis')

    <!-- Section: About -->
    @include('frontend::home.about.about')

    <!-- Section: funfact -->
    @include('frontend::home.funfact.funfact')

    <!-- Section: Service -->
    @include('frontend::home.service.service')

    <!-- Section: Who We Are -->
    @include('frontend::home.who-we-are.who-we-are')

    <!-- Section: Our Products -->
    @include('frontend::home.product.product')

    <!-- Section: How We Works -->
    @include('frontend::home.how-we-works.how-we-works')

    <!-- Section: Contact -->
    @include('frontend::home.contact.contact')
</div>
@endsection

@push('script')
 <!-- REVOLUTION JS FILES -->
 <script type="text/javascript" src="js/frontend/revolution-slider/js/revolution.tools.min.js"></script>
 <script type="text/javascript" src="js/frontend/revolution-slider/js/rs6.min.js"></script>
 <script src="js/frontend/extra-rev-slider.js"></script>
@endpush