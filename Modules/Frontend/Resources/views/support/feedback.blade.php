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
.star-cb-group {
  /* remove inline-block whitespace */
  font-size: 0;
  /* flip the order so we can use the + and ~ combinators */
  unicode-bidi: bidi-override;
  direction: rtl;
  display: inline-block;
  margin-bottom: 20px;
  /* the hidden clearer */
}
.star-cb-group * {
  font-size: 1rem;
}
.star-cb-group > input {
  display: none;
}
.star-cb-group > input + label {
  /* only enough room for the star */
  display: inline-block;
  overflow: hidden;
  /* text-indent: 9999px; */
  width: 30px;
  height: 30px;
  /* white-space: nowrap; */
  cursor: pointer;
}
.star-cb-group > label:hover
{
    /*transform: rotate(360deg);*/
    transition: all 2s;
    -webkit-transition: all 2s;
}
    
.rating-div
{
  margin-top:20px;
}
.star-cb-group > input + label:before {
  display: inline-block;
  text-indent: -9999px;
  content: '\f005';
  font-family: "Font Awesome 5 Free";
    color: #fff;
    font-size: 20px;
    
}
.star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
  content: '\f005';
  font-family: "Font Awesome 5 Free";
  color: #002e5a;
  font-size: 20px;
    
}
.star-cb-group > .star-cb-clear + label {
  text-indent: -9999px;
  width: 0.5em;
  margin-left: -0.5em;
}
.star-cb-group > .star-cb-clear + label:before {
  width: 0.5em;
}
.star-cb-group:hover > input + label:before {
  content: '\f005';
  font-family: "Font Awesome 5 Free";
  color: #fff;
  text-shadow: none;
  
}
.star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
  content: '\f005';
  font-family: "Font Awesome 5 Free";
  color: #002e5a;
  
  text-shadow: none;
}

#log {
  margin: 25px auto;
  width: 5em;
  text-align: center;
  background: transparent;
}
.star-cb-group label:hover .star-cb-group
{
  position:relative;
}
.star-cb-group label:hover:after {
  content: attr(aria-label);
  position: absolute;
  left: 21px;
  top: 90%;
  /* background:#fff; */
  color:#002e5a;
  font-size:12px;
}

form label {
    color: #002e5a !important;
    font-weight: 300;
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

    <!-- Section: Feedback Form -->
    <section id="feedback" class="bg-white-f4">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tm-sc tm-sc-custom-columns-holder tm-cc-two-columns tm-cc-responsive-mode-1280">

                            <div class="tm-sc tm-sc-custom-columns-holder-item  section-typo-light bg-theme-colored1"
                                data-item-class="econsul-mascot-custom-columns-924797"
                                 data-1200-up="80px 15% 100px 10%"
                                data-1199-down="80px 10% 100px 10%">
                                <div class="item-inner">
                                    <div class="item-content econsul-mascot-custom-columns-924797">
                                        <h2 class="text-center"><img src="svg/satisfaction.svg" alt="Feedback" style="width: 70px;" /> Complete Feedback Form </h2>
                                        
                                        <div  class="wpcf7" dir="ltr">
                                            <form method="post" id="feedback-form">
                                                @csrf
                                                @captcha
                                                <div class="tm-contact-form-transparent pr-0">
                                                    <div class="row">
                                                        <div class="col-md-4"> <span
                                                                class="wpcf7-form-control-wrap your-name"><input type="text"
                                                                    name="name" id="name" value="" size="40"
                                                                    class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                    aria-required="true" aria-invalid="false"
                                                                    placeholder="Name*"></span></div>
                                                        <div class="col-md-4"> <span
                                                                class="wpcf7-form-control-wrap your-email"><input
                                                                    type="email" name="email" id="email" value="" size="40"
                                                                    class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                    aria-required="true" aria-invalid="false"
                                                                    placeholder="Email*"></span></div>
                                                        <div class="col-md-4"> <span
                                                                class="wpcf7-form-control-wrap your-phone"><input
                                                                    type="text" name="phone_no" id="phone_no" value="" size="40"
                                                                    class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                    aria-required="true" aria-invalid="false"
                                                                    placeholder="Phone*"></span></div>
                                                        <div class="col-md-12"> <span
                                                                class="wpcf7-form-control-wrap textarea"><textarea
                                                                    name="description" cols="40" id="description" rows="3"
                                                                    class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required"
                                                                    aria-required="true" aria-invalid="false"
                                                                    placeholder="Reason for Rating*"></textarea></span></div>

                                                        <div class="col-md-6">
                                                            <div class="control-group rating-div">
                                                                <input type="hidden" id="daruuri_rating" name="daruuri_rating">
                                                                <label class="full-width">How would you rate your experience at Daruuri?</label>
                                                                <span class="star-cb-group">
                                                                    <input type="radio" id="rating1-5" name="rating1" value="5" onchange="document.getElementById('daruuri_rating').value=this.value" />
                                                                    <label for="rating1-5" class="rating1" aria-label="Excellent"></label>
                                                                    <input type="radio" id="rating1-4" name="rating1" value="4" onchange="document.getElementById('daruuri_rating').value=this.value" />
                                                                    <label for="rating1-4" class="rating1" aria-label="Good"></label>
                                                                    <input type="radio" id="rating1-3" name="rating1" value="3" onchange="document.getElementById('daruuri_rating').value=this.value" />
                                                                    <label for="rating1-3" class="rating1" aria-label="Average"></label>
                                                                    <input type="radio" id="rating1-2" name="rating1" value="2" onchange="document.getElementById('daruuri_rating').value=this.value" />
                                                                    <label for="rating1-2" class="rating1" aria-label="Needs Improvement"></label>
                                                                    <input type="radio" id="rating1-1" name="rating1" value="1" onchange="document.getElementById('daruuri_rating').value=this.value" />
                                                                    <label for="rating1-1" class="rating1" aria-label="Poor"></label>
                                                                </span>
                                                            </div>
                                                        </div>            
                                                        <div class="col-md-6">
                                                            <div class="control-group rating-div">
                                                                <input type="hidden" id="communication_rating" name="communication_rating">
                                                                <label class="full-width">The store communicated expectations about my device
                                                                    throughout the repair process.</label>
                                                                <span class="star-cb-group">
                                                                    <input type="radio" id="rating2-5" name="rating2" value="5" onchange="document.getElementById('communication_rating').value=this.value"  />
                                                                    <label for="rating2-5" class="rating2" aria-label="Excellent"></label>
                                                                    <input type="radio" id="rating2-4" name="rating2" value="4" onchange="document.getElementById('communication_rating').value=this.value"  />
                                                                    <label for="rating2-4" class="rating2" aria-label="Good"></label>
                                                                    <input type="radio" id="rating2-3" name="rating2" value="3" onchange="document.getElementById('communication_rating').value=this.value"  />
                                                                    <label for="rating2-3" class="rating2" aria-label="Average"></label>
                                                                    <input type="radio" id="rating2-2" name="rating2" value="2" onchange="document.getElementById('communication_rating').value=this.value"  />
                                                                    <label for="rating2-2" class="rating2" aria-label="Needs Improvement"></label>
                                                                    <input type="radio" id="rating2-1" name="rating2" value="1" onchange="document.getElementById('communication_rating').value=this.value"  />
                                                                    <label for="rating2-1" class="rating2" aria-label="Poor"></label>
                                                                </span>
                                                            </div>
                                                        </div>            
                                                        <div class="col-md-6">
                                                            <div class="control-group rating-div">
                                                                <input type="hidden" id="stuff_rating" name="stuff_rating">
                                                                <label class="full-width">The store staff was courteous and helpful throughout
                                                                    my repair process</label>
                                                                <span class="star-cb-group">
                                                                    <input type="radio" id="rating3-5" name="rating3" value="5" onchange="document.getElementById('stuff_rating').value=this.value"  />
                                                                    <label for="rating3-5" class="rating3" aria-label="Excellent"></label>
                                                                    <input type="radio" id="rating3-4" name="rating3" value="4" onchange="document.getElementById('stuff_rating').value=this.value"  />
                                                                    <label for="rating3-4" class="rating3" aria-label="Good"></label>
                                                                    <input type="radio" id="rating3-3" name="rating3" value="3" onchange="document.getElementById('stuff_rating').value=this.value"  />
                                                                    <label for="rating3-3" class="rating3" aria-label="Average"></label>
                                                                    <input type="radio" id="rating3-2" name="rating3" value="2" onchange="document.getElementById('stuff_rating').value=this.value"  />
                                                                    <label for="rating3-2" class="rating3" aria-label="Needs Improvement"></label>
                                                                    <input type="radio" id="rating3-1" name="rating3" value="1" onchange="document.getElementById('stuff_rating').value=this.value"  />
                                                                    <label for="rating3-1" class="rating3" aria-label="Poor"></label>
                                                                </span>
                                                            </div>
                                                        </div>            
                                                        <div class="col-md-6">
                                                            <div class="control-group rating-div">
                                                                <input type="hidden" id="service_rating" name="service_rating">
                                                                <label class="full-width">My device functions and feels as good or better than expected after my repair</label>
                                                                <span class="star-cb-group">
                                                                    <input type="radio" id="rating4-5" name="rating4" value="5" onchange="document.getElementById('service_rating').value=this.value"  />
                                                                    <label for="rating4-5" class="rating4" aria-label="Excellent"></label>
                                                                    <input type="radio" id="rating4-4" name="rating4" value="4" onchange="document.getElementById('service_rating').value=this.value"  />
                                                                    <label for="rating4-4" class="rating4" aria-label="Good"></label>
                                                                    <input type="radio" id="rating4-3" name="rating4" value="3" onchange="document.getElementById('service_rating').value=this.value"  />
                                                                    <label for="rating4-3" class="rating4" aria-label="Average"></label>
                                                                    <input type="radio" id="rating4-2" name="rating4" value="2" onchange="document.getElementById('service_rating').value=this.value"  />
                                                                    <label for="rating4-2" class="rating4" aria-label="Needs Improvement"></label>
                                                                    <input type="radio" id="rating4-1" name="rating4" value="1" onchange="document.getElementById('service_rating').value=this.value"  />
                                                                    <label for="rating4-1" class="rating4" aria-label="Poor"></label>
                                                                </span>
                                                            </div>
                                                        </div>            
                                                        <div class="col-md-6">
                                                            <div class="control-group rating-div">
                                                                <input type="hidden" id="referal_rating" name="referal_rating">
                                                                <label class="full-width">How likely are you to refer a friend or family member to Daruuri?</label>
                                                                <span class="star-cb-group">
                                                                    <input type="radio" id="rating5-5" name="rating5" value="5" onchange="document.getElementById('referal_rating').value=this.value"  />
                                                                    <label for="rating5-5" class="rating5" aria-label="Excellent"></label>
                                                                    <input type="radio" id="rating5-4" name="rating5" value="4" onchange="document.getElementById('referal_rating').value=this.value"  />
                                                                    <label for="rating5-4" class="rating5" aria-label="Good"></label>
                                                                    <input type="radio" id="rating5-3" name="rating5" value="3" onchange="document.getElementById('referal_rating').value=this.value"  />
                                                                    <label for="rating5-3" class="rating5" aria-label="Average"></label>
                                                                    <input type="radio" id="rating5-2" name="rating5" value="2" onchange="document.getElementById('referal_rating').value=this.value"  />
                                                                    <label for="rating5-2" class="rating5" aria-label="Needs Improvement"></label>
                                                                    <input type="radio" id="rating5-1" name="rating5" value="1" onchange="document.getElementById('referal_rating').value=this.value"  />
                                                                    <label for="rating5-1" class="rating5" aria-label="Poor"></label>
                                                                </span>
                                                            </div>
                                                        </div>            
                                                        <div class="col-md-12 pt-3"> 
                                                            <button type="submit" class="wpcf7-form-control wpcf7-submit btn btn-theme-colored2 btn-round" id="submit-btn"><i class="fas fa-check-circle"></i> Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script src="js/toastr.min.js" type="text/javascript"></script>
<script>
    _submitEvent = function() {
        $.ajax({
            url: "{{route('store.feedback')}}",
            type: "POST",
            data: {
                    "_token": "{{ csrf_token() }}",
                    "g-recaptcha-response": $("#feedback-form #g-recaptcha-response").val(),
                    "name": $("#feedback-form #name").val(),
                    "email": $("#feedback-form #email").val(),
                    "phone_no": $("#feedback-form #phone_no").val(),
                    "description": $("#feedback-form #description").val(),
                    "daruuri_rating": $("#feedback-form #daruuri_rating").val(),
                    "communication_rating": $("#feedback-form #communication_rating").val(),
                    "stuff_rating": $("#feedback-form #stuff_rating").val(),
                    "service_rating": $("#feedback-form #service_rating").val(),
                    "referal_rating": $("#feedback-form #referal_rating").val(),
                },
            beforeSend: function () {
                $('#submit-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            complete: function () {
                $('#submit-btn').removeClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            success: function (data) {
                $("#feedback-form").find('.is-error').removeClass('is-error');
                $("#feedback-form").find('.error').remove();

                if (data.status) {
                    notification(data.message,data.status)
                    if (data.status == 'success') {
                        $("#feedback-form")[0].reset();
                    }
                } else {
                    $.each(data.errors, function (key, value) {
                        $("#feedback-form input[name='" + key + "']").addClass('is-error');
                        $("#feedback-form textarea[name='" + key + "']").addClass('is-error');
                        $("#feedback-form input[name='" + key + "']").parent().append('<div id="' + key + '" class="error error-feedback">' + value + '</div>');
                        $("#feedback-form textarea[name='" + key + "']").parent().append('<div id="' + key + '" class="error error-feedback">' + value + '</div>');
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