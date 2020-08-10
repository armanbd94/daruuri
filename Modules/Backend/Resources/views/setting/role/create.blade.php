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
                   <i class="{{$page_icon}}"></i> {{$sub_title}}
                </h4>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-xl-12">
                    <form method="post" id="saveDataForm">
                        @csrf
                        <input type="hidden" class="form-control" name="update_id" id="update_id">
                        <div class="row">
                            <x-backend.form.text-box label="Role Name" col="col-md-12" name="role" required="required" placeholder="Enter role name"/>
                            <div class="col-md-12" style="position:relative;">
                                <ul id="permission" class="text-left">
                                    @if (!$permissions->isEmpty())
                                        @foreach ($permissions as $menu)
                                            @if($menu->submenu->isEmpty())
                                            <li>
                                                <input type="checkbox" class="module" name="module[]" value="{{$menu->id}}"> {{$menu->module_name}}
                                                @if(!$menu->method->isEmpty())
                                                <ul>
                                                    @foreach ($menu->method as $method)
                                                    @php
                                                        $permission_name = '';
                                                        foreach ($keywords as $keyword) {
                                                            if (strpos(strtolower($method->method_name), strtolower($keyword)) !== false) {
                                                                $permission_name = $keyword;
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                    <li><input type="checkbox" name="method[]" value="{{$method->id}}"> {{$permission_name}}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @else 
                                            <li>
                                                <input type="checkbox"  class="module" name="module[]" value="{{$menu->id}}"> {{$menu->module_name}}
                                                <ul>
                                                    @foreach ($menu->submenu as $submenu)
                                                    <li>
                                                        <input type="checkbox"  class="module" name="module[]" value="{{$submenu->id}}"> {{$submenu->module_name}}
                                                        @if(!$submenu->method->isEmpty())
                                                        <ul>
                                                            @foreach ($submenu->method as $method)
                                                            @php
                                                                $permission_name = '';
                                                                foreach ($keywords as $keyword) {
                                                                    if (strpos(strtolower($method->method_name), strtolower($keyword)) !== false) {
                                                                        $permission_name = $keyword;
                                                                    }
                                                                }
                                                            @endphp
                                                            <li><input type="checkbox" name="method[]" value="{{$method->id}}"> {{$permission_name}}</li>
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
                            <div class="col-md-12 btn-section pt-4">
                                <button type="button" class="btn btn-brand btn-sm" id="save-btn">Save</button>
                                <button type="reset" class="btn btn-danger btn-sm" id="reset-btn">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->

</div>
@endsection


@push('script')
<script>
$(document).ready(function(){
    $('input[type=checkbox]').click(function(){
        $(this).next().find('input[type=checkbox]').prop('checked',this.checked);
        $(this).parents('ul').prev('input[type=checkbox]').prop('checked',function(){
            return $(this).next().find(':checked').length;
        });
    });

    $.fn.extend({
        treed: function (o) {

            var openedClass = 'fa-minus-square';
            var closedClass = 'fa-plus-square';

            if (typeof o != 'undefined') {
                if (typeof o.openedClass != 'undefined') {
                    openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined') {
                    closedClass = o.closedClass;
                }
            };

            //initialize each of the top levels
            var tree = $(this);
            tree.addClass("tree");
            tree.find('li').has("ul li").each(function () {
                var branch = $(this); //li with children ul
                branch.prepend("<i class='indicator fas " + closedClass + "'></i>");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().slideToggle(500);
                    }
                })
                branch.children().children().slideToggle(500);
            });
            //fire event from the dynamically added icon
            tree.find('.branch .indicator').each(function () {
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
            });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li a').click();
                    e.preventDefault();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li a').click();
                    e.preventDefault();
                });
            });
        }
    });
    $('#permission').treed();

    $(document).on('click','#save-btn',function () {
        if ($('.module:checked').length >= 1) {
            $.ajax({
                url: "{{route('admin.role.store')}}",
                type: "POST",
                data: $('#saveDataForm').serialize(),
                dataType: "JSON",
                beforeSend: function () {
                    $('#save-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
                },
                complete: function(){
                    $('#save-btn').removeClass('kt-spinner kt-spinner--md kt-spinner--light');
                },
                success: function (data) {
                    if(data.status){
                        notification(data.message, data.status);
                        if(data.status == 'success'){
                            window.location.replace("{{route('admin.role')}}");
                        } 
                    } else {
                        $.each(data.errors, function (key, value) {
                            $("#saveDataForm input[name='" + key + "']").addClass('is-invalid');
                            $("#saveDataForm input[name='" + key + "']").after('<div id="' + key + '" class="error invalid-feedback">' + value + '</div>');
                        });
                    }
                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }else{
            notification('Please checked at least one menu', 'error');
        }
    });
});
</script>
@endpush
