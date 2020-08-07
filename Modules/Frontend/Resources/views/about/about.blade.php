@extends('frontend.master')

@section('title')
    {{$page_title}}
@endsection

@section('content')
<div class="main-content">

    <!-- Section: Banner -->
    @include('frontend::banner.banner')

     <!-- Section: About -->
     <x-frontend.about />

    <!-- Section: How We Works -->
    @include('frontend::home.how-we-works.how-we-works')
</div>
@endsection

