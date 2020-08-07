@extends('frontend.master')

@section('title')
    {{$page_title}}
@endsection

@push('style')
<link href="css/toastr.min.css" rel="stylesheet" type="text/css" />
<style>
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
<div class="main-content">

    <!-- Section: Banner -->
    @include('frontend::banner.banner')

     <!-- Section: About -->
    @include('frontend::contact.partial.form')

    <!-- Section: How We Works -->
    @include('frontend::contact.partial.map')
</div>
@endsection

@push('script')
<script src="js/toastr.min.js" type="text/javascript"></script>
<script>
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