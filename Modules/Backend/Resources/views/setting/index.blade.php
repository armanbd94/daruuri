@extends('backend.layouts.app')

@section('title')
    {{$page_title}}
@endsection

@push('style')

@endpush

@section('content_head')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <div class="kt-subheader__breadcrumbs">
            <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="{{url('admin')}}" class="kt-subheader__breadcrumbs-link">Dashboard</a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                {{$sub_title}} </a>

            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <!--begin::Portlet-->
    <div class="kt-portlet kt-faq-v1">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h4 class=" font-weight-bold">
                   <i class="{{$page_icon}}"></i> {{$sub_title}}
                </h4>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button class="close" type="button" data-dismiss="alert">×</button>
                        <strong>Success! </strong> {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button class="close" type="button" data-dismiss="alert">×</button>
                        <strong>Error! </strong> {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="tile p-0">
                        <ul class="nav flex-column nav-tabs user-tabs" id="setting-tab">
                            <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                            <li class="nav-item"><a class="nav-link" href="#site-logo" data-toggle="tab">Site Logo</a></li>
                            <li class="nav-item"><a class="nav-link" href="#seo" data-toggle="tab">SEO</a></li>
                            <li class="nav-item"><a class="nav-link" href="#social-links" data-toggle="tab">Social Links</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about" data-toggle="tab">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#hardware" data-toggle="tab">Hardware Service</a></li>
                            <li class="nav-item"><a class="nav-link" href="#software" data-toggle="tab">Software Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            @include('backend::setting.partial.general')
                        </div>
                        <div class="tab-pane fade" id="site-logo">
                            @include('backend::setting.partial.logo')
                        </div>
                        <div class="tab-pane fade" id="seo">
                            @include('backend::setting.partial.seo')
                        </div>
                        <div class="tab-pane fade" id="social-links">
                            @include('backend::setting.partial.social-links')
                        </div>
                        <div class="tab-pane fade" id="about">
                            @include('backend::setting.pages.about')
                        </div>
                        <div class="tab-pane fade" id="hardware">
                            @include('backend::setting.pages.hardware-service')
                        </div>
                        <div class="tab-pane fade" id="software">
                            @include('backend::setting.pages.software-service')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->


</div>
@endsection


@push('script')
<script>
loadFile = function(event, id) {
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);
};
</script>
@endpush