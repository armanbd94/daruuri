@extends('frontend.master')

@section('title')
    {{$page_title}}
@endsection

@push('style')
<!-- REVOLUTION STYLE SHEETS -->
<link rel="stylesheet" type="text/css" href="js/frontend/revolution-slider/css/rs6.css">
<link href="css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<link href="css/toastr.min.css" rel="stylesheet" type="text/css" />
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
.product-card{
    position: relative;
    width: 90%;
    height: 220px;
    background: #fff;
    margin: 30px 5%;
    padding: 20px 0;
    border: 2px solid #00c1eb;
    transition: 0.3s ease-in-out;
    
}
.product-card:hover{
    height: 340px;
}
.product-card .img-box{
    position: relative;
    width: 70%;
    height: 220px;
    top: -50px;
    margin: 0 auto;
    z-index: 1;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    background: #fff;
}
.product-card .img-box img{
    width: 100%;
    height: 100%;
}
.product-card .content{
    position: relative;
    margin-top: -120px;
    padding: 10px 15px;
    text-align: center;
    visibility: hidden;
    opacity: 0;
    transition: 0.3s ease-in-out
}
.product-card:hover .content{
    visibility: visible;
    opacity: 1;
    margin-top: -60px;
    transition-delay: 0.3s;
}
.product-card .content h4{
    font-size: 15px;
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
.is-error{
    border-bottom: 2px solid #dc3545 !important;
}
.error-feedback{
    width: 100%;
    margin-top: -1.75rem;
    font-size: 80%;
    color: #dc3545;
}
</style>
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
    <x-frontend.about padding="pt-0"/>

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

    @include('frontend::modal')
</div>

@endsection

@push('script')
 <!-- REVOLUTION JS FILES -->
 
 <script type="text/javascript" src="js/frontend/revolution-slider/js/revolution.tools.min.js"></script>
 <script type="text/javascript" src="js/frontend/revolution-slider/js/rs6.min.js"></script>
 <script src="js/frontend/extra-rev-slider.js"></script>
 <script src="js/backend/bootstrap-select.js" type="text/javascript"></script>
 <script src="js/toastr.min.js" type="text/javascript"></script>
 <script type="text/javascript">
    var _token = "{{csrf_token()}}";
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

    _submitEvent = function() {
        $.ajax({
            url: "{{route('send.contact.message')}}",
            type: "POST",
            data: {
                    "_token": "{{ csrf_token() }}",
                    "g-recaptcha-response": $("#contact-form #g-recaptcha-response").val(),
                    "name": $("#contact-form #name").val(),
                    "email": $("#contact-form #email").val(),
                    "phone": $("#contact-form #phone").val(),
                    "subject": $("#contact-form #subject").val(),
                    "message": $("#contact-form #message").val(),
                },
            beforeSend: function () {
                $('#submit-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            complete: function () {
                $('#submit-btn').removeClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            success: function (data) {
                $("#contact-form").find('.is-error').removeClass('is-error');
                $("#contact-form").find('.error').remove();

                if (data.status) {
                    notification(data.message,data.status)
                    if (data.status == 'success') {
                        $("#contact-form")[0].reset();
                    }
                } else {
                    $.each(data.errors, function (key, value) {
                        $("#contact-form input[name='" + key + "']").addClass('is-error');
                        $("#contact-form textarea[name='" + key + "']").addClass('is-error');
                        $("#contact-form input[name='" + key + "']").after('<div id="' + key + '" class="error error-feedback">' + value + '</div>');
                        $("#contact-form textarea[name='" + key + "']").after('<div id="' + key + '" class="error error-feedback">' + value + '</div>');
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    };
    function notification(message,status){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        
        switch (status) { 
            case 'success': 
                toastr.success(message, 'SUCCESS');
                break;
            case 'error': 
                toastr.error(message, 'ERROR');
                break;
            case 'info': 
                toastr.info(message, 'INFO');
                break;		
            case 'warning': 
                toastr.warning(message, 'WARNING');
                break;
        }
    }

 </script>
@endpush