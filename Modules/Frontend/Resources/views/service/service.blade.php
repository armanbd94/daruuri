@extends('frontend.master')

@section('title')
    {{$page_title}}
@endsection

@push('style')
<link href="css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<style>
.bootstrap-select{
    border-radius: 5px !important;
}
#showDataModal .modal-dialog{
    width: 90% !important;
    margin: 1.75rem auto;
}
.modal-dialog{
    max-width: 90% !important;
}
.services-style-four {
    padding: 0px 25px;
    position: relative;
    margin-bottom: 50px;
}
.services-style-four .inner-box {
    position: relative;
    padding: 30px 30px 25px;
    border: 1px solid #e0e0e0;
}
.services-style-four .inner-box .icon-box {
    position: absolute;
    left: 40%;
    top: -35px;
    width: 70px;
    height: 70px;
    line-height: 66px;
    border-radius: 50%;
    text-align: center;
    border: 1px solid #e0e0e0;
    background-color: #ffffff;
}
@media only screen and (max-width: 325px) {
    .services-style-four .inner-box .icon-box {
        left: 35%;
    }
}
@media only screen and (min-width: 326px) {
    .services-style-four .inner-box .icon-box {
        left: 40%;
    }
}

.services-style-four .inner-box h5 {
    font-size: 14px;
    font-weight: 600;
    margin: 15px 0 0 0;
    text-transform: uppercase;
}
.services-style-four .inner-box p {
    font-size: 14px;
    font-weight: 600;
    margin: 0;
    padding: 0;
}

.service-modal-section{
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999999;
    padding-top: 50px;
    overflow-y: scroll;
}
#service_modal{
    width: 90vw;
    margin: 0 auto;
}
#close_btn{
    width: 30px;
    height: 30px;
    font-size: 15px;
    cursor: pointer;
}
.kt-spinner {
    position: relative;
}

.kt-spinner:before {
    content: '';
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    position: absolute;
    top: 50%;
    left: 10px;
    border-radius: 50%;
}

.kt-spinner:before {
    width: 20px;
    height: 20px;
    margin-top: -10px;
}
.kt-spinner:before {
    -webkit-animation: kt-spinner .5s linear infinite;
    animation: kt-spinner .5s linear infinite;
}

.kt-spinner.kt-spinner--light:before {
    border: 2px solid #ffffff;
    border-right: 2px solid transparent;
}
@-webkit-keyframes kt-spinner {
    to {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes kt-spinner {
    to {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

</style>
@endpush

@section('content')
<div class="main-content">

    <!-- Section: Banner -->
    @include('frontend::banner.banner')

    <x-frontend.search-form/>
     <!-- Section: Service -->
    <section>
        <div class="container pb-70">
            <div class="section-content">
                @if ($services->count())
                    @foreach ($services as $key => $service)
                    <div class="row pb-5">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-left flip">
                            <div class="row" id="content-text">
                                <style>
                                    #content-text p{
                                        margin-bottom: 0 !important;
                                    }
                                    #content-text ul li::marker{
                                        color: #1bacd6 !important;
                                        font-size: 20px;
                                    }
                                </style>
                                @if (($key/2) == 0)
                                <div class="col-md-5">
                                    <img alt="{{$service->title}}"  class="lazyload" src="svg/spinner.svg" data-src="storage/{{PAGE.$service->image}}" style="width: 100%;border: 5px solid #1bacd6;
                                    box-shadow: 0px 3px 7px rgba(0,0,0,0.5);">
                                </div>
                                <div class="col-md-7 text-justify">
                                    <h3 class="mb-10">{{$service->title}}</h3>
                                   {!! $service->description !!}
                                </div>
                                @else
                                
                                <div class="col-md-7 text-justify">
                                    <h3 class="mb-10">{{$service->title}}</h3>
                                    {!! $service->description !!}
                                </div>
                                <div class="col-md-5">
                                    <img alt="{{$service->title}}"  class="lazyload" src="svg/spinner.svg" data-src="storage/{{PAGE.$service->image}}" style="width: 100%;border: 5px solid #1bacd6;
                                    box-shadow: 0px 3px 7px rgba(0,0,0,0.5);">
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                
            </div>
        </div>
    </section>

    @include('frontend::modal')
</div>
@endsection

@push('script')
<script type="text/javascript" src="js/frontend/lazysizes.min.js"></script>
 <script src="js/backend/bootstrap-select.js" type="text/javascript"></script>
 <script type="text/javascript">
    var _token = "{{csrf_token()}}";
    $(document).ready(function(){
        $(document).on('change','#phone_id', function(){
            let phone_id = $("#phone_id").val();
            if(phone_id){
                $(".error").each(function () {
                    $(this).empty();//remove error text
                });
                $("#searchDataForm").find('.is-invalid').removeClass('is-invalid');
            }else{
                $("#phone_id").parent().addClass('is-invalid');
                $("#phone_id").parent().after('<div class="error invalid-feedback"><i class="icon fas fa-question-circle"></i> Please choose a phone</div>');
            }       
        });
        $(document).on('click','#search-btn', function(){
            let brand_id = $("#brand_id").val();
            let phone_id = $("#phone_id").val();
            if(brand_id){
                $(".error").each(function () {
                        $(this).empty();//remove error text
                    });
                    $("#searchDataForm").find('.is-invalid').removeClass('is-invalid');
                if(phone_id){
                    $(".error").each(function () {
                        $(this).empty();//remove error text
                    });
                    $("#searchDataForm").find('.is-invalid').removeClass('is-invalid');
                    $.ajax({
                        url: "{{route('phone.services')}}",
                        type: "POST",
                        data:{phone_id:phone_id,_token:_token},
                        dataType: "JSON",
                        beforeSend: function () {
                            $('#search-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
                        },
                        complete: function () {
                            $('#search-btn').removeClass('kt-spinner kt-spinner--md kt-spinner--light');
                        },
                        success: function (data) {
                            $('.service-modal-section').removeClass('d-none');
                            $('.service-modal-section .card-body').html('');
                            $('.service-modal-section .card-body').html(data);
                            $('.selectpicker').val('').selectpicker('refresh');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }else{
                    $("#phone_id").parent().addClass('is-invalid');
                    $("#phone_id").parent().after('<div class="error invalid-feedback"><i class="icon fas fa-question-circle"></i> Please choose a phone</div>');
                }
            }else{
                $("#brand_id").parent().addClass('is-invalid');
                $("#brand_id").parent().after('<div class="error invalid-feedback"><i class="icon fas fa-question-circle"></i> Please choose a brand</div>');
            }
            
        });
    });
    function getPhoneList(brand_id){
        if(brand_id){
            $(".error").each(function () {
                    $(this).empty();//remove error text
                });
                $("#searchDataForm").find('.is-invalid').removeClass('is-invalid');
            $.ajax({
                url: "{{route('brand.phone.list')}}",
                type: "POST",
                data:{brand_id:brand_id,_token:_token},
                dataType: "JSON",
                success: function (data) {
                    $('#phone_id').html('');
                    $('#phone_id').html(data);
                    $('#phone_id.selectpicker').selectpicker('refresh');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }

    function hide_modal(){
        $('.service-modal-section').addClass('d-none');
    }

 </script>
@endpush
