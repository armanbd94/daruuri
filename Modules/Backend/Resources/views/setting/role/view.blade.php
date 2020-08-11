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
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <a href="{{route('admin.role')}}" type="button" class="btn btn-success btn-icon-sm btn-sm">
                <i class="fas fa-arrow-circle-left"></i> Back
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
                   <i class="{{$page_icon}}"></i> {{$role->role}} {{$sub_title}}
                </h4>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center text-primary">{{$role->role}}</h3>
                </div>
                <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-12" style="position:relative;">
                                <ul id="permission" class="text-left" style="list-style: none;">
                                    @if (!$permissions->isEmpty())
                                        @foreach ($permissions as $menu)
                                            @if($menu->submenu->isEmpty())
                                            <li> @if (collect($role_modules)->contains($menu->id)) 
                                                <i class="fas fa-check-circle text-success"></i> 
                                                @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                                @endif {{$menu->module_name}}
                                                @if(!$menu->method->isEmpty())
                                                <ul  style="list-style: none;">
                                                    @foreach ($menu->method as $method)
                                                    @php
                                                        $permission_name = '';
                                                        foreach ($keywords as $keyword) {
                                                            if (strpos(strtolower($method->method_name), strtolower($keyword)) !== false) {
                                                                $permission_name = $keyword;
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                    <li> @if (collect($role_methods)->contains($method->id))
                                                        <i class="fas fa-check-circle text-success"></i> 
                                                @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                                @endif {{$permission_name}}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @else 
                                            <li> @if (collect($role_modules)->contains($menu->id)) 
                                                <i class="fas fa-check-circle text-success"></i> 
                                                @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                                @endif {{$menu->module_name}}
                                                <ul  style="list-style: none;">
                                                    @foreach ($menu->submenu as $submenu)
                                                    <li> @if (collect($role_modules)->contains($submenu->id)) 
                                                        <i class="fas fa-check-circle text-success"></i> 
                                                @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                                @endif {{$submenu->module_name}}
                                                        @if(!$submenu->method->isEmpty())
                                                        <ul  style="list-style: none;">
                                                            @foreach ($submenu->method as $method)
                                                            @php
                                                                $permission_name = '';
                                                                foreach ($keywords as $keyword) {
                                                                    if (strpos(strtolower($method->method_name), strtolower($keyword)) !== false) {
                                                                        $permission_name = $keyword;
                                                                    }
                                                                }
                                                            @endphp
                                                            <li> @if (collect($role_methods)->contains($method->id))
                                                                <i class="fas fa-check-circle text-success"></i> 
                                                @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                                @endif {{$permission_name}}</li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->

</div>
@endsection
