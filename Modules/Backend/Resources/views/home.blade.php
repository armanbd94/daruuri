@extends('backend.layouts.app')

@section('title')
    {{$page_title}}
@endsection

@push('style')
    
@endpush

@section('content_head')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">Dashboard</h3>
    </div>
</div>
@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <!--Begin::Section-->
    <div class="row">

        <div class="kt-widget17 col-md-12">
            <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                <div class="kt-widget17__chart" style="height:320px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="kt_chart_activities" style="display: block; height: 216px; width: 388px;" width="485" height="270" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <div class="kt-widget17__stats">
                <div class="kt-widget17__items">
                    <div class="kt-widget17__item">
                        <span class="kt-widget17__icon"><i class="fab fa-bootstrap text-primary"></i></span>
                        <span class="kt-widget17__subtitle">
                            Total Brands
                        </span>
                        <span class="kt-widget17__desc">
                            {{$data['total_brands']}}
                        </span>
                    </div>
                    <div class="kt-widget17__item">
                        <span class="kt-widget17__icon"><i class="fab fa-product-hunt text-success"></i> </span>
                        <span class="kt-widget17__subtitle">
                            Total Products
                        </span>
                        <span class="kt-widget17__desc">
                            {{$data['total_products']}}
                        </span>
                    </div>
                    <div class="kt-widget17__item">
                        <span class="kt-widget17__icon"><i class="fas fa-tools text-warning"></i> </span>
                        <span class="kt-widget17__subtitle">
                            Total Service
                        </span>
                        <span class="kt-widget17__desc">
                            {{$data['total_services']}}
                        </span>
                    </div>
                    <div class="kt-widget17__item">
                        <span class="kt-widget17__icon"><i class="fas fa-comment-dots text-info"></i></span>
                        <span class="kt-widget17__subtitle">
                            Total Customer Feedback
                        </span>
                        <span class="kt-widget17__desc">
                            {{$data['total_feedbacks']}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::Section-->
</div>
@endsection



@push('script')
    
@endpush
