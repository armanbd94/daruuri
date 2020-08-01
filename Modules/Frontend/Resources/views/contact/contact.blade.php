@extends('frontend.master')

@section('content')
<div class="main-content">

    <!-- Section: Banner -->
    @include('frontend::banner.banner')

     <!-- Section: About -->
    @include('frontend::contact.partial.form')

    <!-- Section: How We Works -->
    @include('frontend::contact.partial.map')
</div>
@endsection

