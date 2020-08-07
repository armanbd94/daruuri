<section id="contact" class="bg-white-f4">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tm-sc tm-sc-custom-columns-holder tm-cc-two-columns tm-cc-responsive-mode-1280">
                        <div class="tm-sc tm-sc-custom-columns-holder-item"
                            data-item-class="senior-mascot-custom-columns-283434"
                            data-tm-bg-img="images/contact-image.jpg"
                            style="background-image: url('images/contact-image.jpg');">
                            <div class="item-inner">
                                <div class="item-content senior-mascot-custom-columns-283434">
                                </div>
                            </div>
                        </div>
                        <div class="tm-sc tm-sc-custom-columns-holder-item  section-typo-light bg-theme-colored1"
                            data-item-class="econsul-mascot-custom-columns-924797"
                             data-1200-up="80px 15% 100px 10%"
                            data-1199-down="80px 10% 100px 10%">
                            <div class="item-inner">
                                <div class="item-content econsul-mascot-custom-columns-924797">
                                    <h2>Send Us Message</h2>
                                    <div class="wpb_text_column wpb_content_element  mb-60">
                                        <div class="wpb_wrapper">
                                            <p>To send us message please fill up the form and send.</p>
                                        </div>
                                    </div>
                                    <div  class="wpcf7" dir="ltr">
                                        <form method="post" id="contact-form">
                                            @csrf
                                            @captcha
                                            <div class="tm-contact-form-transparent pr-0">
                                                <div class="row">
                                                    <div class="col-md-6"> <span
                                                            class="wpcf7-form-control-wrap your-name"><input type="text"
                                                                name="name" id="name" value="" size="40"
                                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                aria-required="true" aria-invalid="false"
                                                                placeholder="Name*"></span></div>
                                                    <div class="col-md-6"> <span
                                                            class="wpcf7-form-control-wrap your-email"><input
                                                                type="email" name="email" id="email" value="" size="40"
                                                                class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                aria-required="true" aria-invalid="false"
                                                                placeholder="Email*"></span></div>
                                                    <div class="col-md-6"> <span
                                                            class="wpcf7-form-control-wrap your-phone"><input
                                                                type="text" name="phone" id="phone" value="" size="40"
                                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                aria-required="true" aria-invalid="false"
                                                                placeholder="Phone*"></span></div>
                                                    <div class="col-md-6"> <span
                                                            class="wpcf7-form-control-wrap your-subject"><input
                                                                type="text" name="subject" id="subject" value="" size="40"
                                                                class="wpcf7-form-control wpcf7-text"
                                                                aria-invalid="false" placeholder="Subject*"></span></div>
                                                    <div class="col-md-12"> <span
                                                            class="wpcf7-form-control-wrap textarea"><textarea
                                                                name="message" cols="40" id="message" rows="3"
                                                                class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required"
                                                                aria-required="true" aria-invalid="false"
                                                                placeholder="Message*"></textarea></span></div>
                                                    <div class="col-md-12 pt-3"> 
                                                        <button type="submit" class="wpcf7-form-control wpcf7-submit btn btn-theme-colored2 btn-round" id="submit-btn"><i class="fas fa-paper-plane"></i> Send</button>
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