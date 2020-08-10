@extends('backend.layouts.app')

@section('title')
    {{'Read Notification'}}
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
                {{'Read Notification'}}</a>

            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
    </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <a href="{{route('admin.delete.notification',['id'=>$feedback->id])}}" type="button" class="btn btn-danger btn-icon-sm btn-sm">
                <i class="fas fa-trash"></i> Delete
        </a>
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
                    <i class="fas fa-bell"></i> {{'Read Notification'}}
                </h4>
            </div>

        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-xl-12">
                    <table class="table table-borderless">
                        <tr>
                            <td><b>Name</b></td>
                            <td>{{json_decode($feedback->data)->name}}</td>
                        </tr>
                        <tr>
                            <td><b>Phone</b></td>
                            <td>{{json_decode($feedback->data)->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td>{{json_decode($feedback->data)->email}}</td>
                        </tr>
                        <tr>
                            <td><b>Daruuri Rating</b></td>
                            <td>{{json_decode($feedback->data)->daruuri_rating}}</td>
                        </tr>
                        <tr>
                            <td><b>Communication Rating</b></td>
                            <td>{{json_decode($feedback->data)->communication_rating}}</td>
                        </tr>
                        <tr>
                            <td><b>Stuff Rating</b></td>
                            <td>{{json_decode($feedback->data)->stuff_rating}}</td>
                        </tr>
                        <tr>
                            <td><b>Service Rating</b></td>
                            <td>{{json_decode($feedback->data)->service_rating}}</td>
                        </tr>
                        <tr>
                            <td><b>Referal Rating</b></td>
                            <td>{{json_decode($feedback->data)->referal_rating}}</td>
                        </tr>
                        <tr>
                            <td><b>Feedback Date</b></td>
                            <td>{{date('d-M-Y',strtotime($feedback->created_at))}}</td>
                        </tr>
                        <tr>
                            <td><b>Message</b></td>
                            <td>{{json_decode($feedback->data)->description}}</td>
                        </tr>
            
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->

</div>
@endsection
