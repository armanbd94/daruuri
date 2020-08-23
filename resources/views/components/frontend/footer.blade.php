<footer id="footer" class="footer">
    <div class="footer-widget-area">
        <div class="container pt-90 pb-60">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div id="tm_widget_contact_info-1"
                        class="split-nav-menu clearfix widget widget-contact-info clearfix mb-20">
                        <div
                            class="tm-widget tm-widget-contact-info contact-info contact-info-style1  contact-icon-theme-colored1">
                            <div class="thumb">
                                <img alt="Logo" src="storage/{{LOGO.config('settings.site_logo') }}" style="width: 120px;">
                            </div>
                            <div class="description">{{config('settings.footer_description') }}</div>
                        </div>
                    </div>
                    <div id="tm_widget_social_list_custom-1"
                        class="split-nav-menu clearfix widget widget-social-list-custom clearfix">
                        <ul
                            class="tm-widget tm-widget-social-list tm-widget-social-list-custom styled-icons  icon-dark  icon-rounded icon-theme-colored1 ">
                            <li><a class="social-link" href="{{ config('settings.social_facebook') }}"><i class="fab fa-facebook"></i></a></li>
                            <li><a class="social-link" href="{{ config('settings.social_twitter') }}"><i class="fab fa-twitter"></i></a></li>
                            <li><a class="social-link" href="{{ config('settings.social_linkedin') }}"><i class="fab fa-linkedin"></i></a></li>
                            <li><a class="social-link" href="{{ config('settings.social_instagram') }}"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div id="tm_widget_blog_list-1"
                        class="split-nav-menu clearfix widget widget-blog-list clearfix">
                        <h4
                            class="widget-title widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">
                            Contact</h4>
                        <div class="tm-widget tm-widget-blog-list ">
                            <!-- the loop -->
                            <article class="post media-post clearfix"> <a class="post-thumb" href="#"><img
                                        style="width: 70%;" src="images/icon/mail.svg" class="" alt="" /></a>
                                <div class="post-right">
                                    <h6 class="post-title"> <a href="#">Email </a> </h6>
                                    <span class="post-date">
                                        <time class="entry-date">{{ config('settings.email_address') }}</time>
                                    </span>
                                </div>
                            </article>
                            <article class="post media-post clearfix"> <a class="post-thumb" href="#"><img
                                        style="width: 70%;" src="images/icon/smartphone.svg" class=""
                                        alt="" /></a>
                                <div class="post-right">
                                    <h6 class="post-title"> <a href="#"> Phone </a> </h6>
                                    <span class="post-date">
                                        <time class="entry-date">{{ config('settings.contact_number') }}</time>
                                    </span>
                                </div>
                            </article>
                            <article class="post media-post clearfix"> <a class="post-thumb" href="#"><img
                                        style="width: 70%;" src="images/icon/address.svg" class="" alt="" /></a>
                                <div class="post-right">
                                    <h6 class="post-title"> <a href="#"> Address </a> </h6>
                                    <span class="post-date">
                                        <time class="entry-date">{{ config('settings.contact_address') }}</time>
                                    </span>
                                </div>
                            </article>
                            <!-- end of the loop -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div id="nav_menu-1" class="widget widget_nav_menu">
                        <h4
                            class="widget-title widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">
                            Services</h4>
                        <div class="menu-service-nav-menu-container">
                            <ul id="menu-service-nav-menu" class="menu">
                                @if ($highlighted_services->count())
                                    @foreach ($highlighted_services as $service)
                                    <li
                                    class="menu-item menu-item-type-post_type menu-item-object-services menu-item-20545">
                                    <a href="javascript:void(0);">{{$service->service_name}}</a>
                                </li>
                                    @endforeach
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div id="tm_widget_opening_hours_compressed-1"
                        class="split-nav-menu clearfix widget widget-opening-hours-compressed clearfix">
                        <h4
                            class="widget-title widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">
                            Opening Hours</h4>
                        <ul
                            class="tm-widget tm-widget-opening-hours tm-widget-opening-hours-compressed opening-hours border-dark">
                            <li class="clearfix"> <span>Saturday</span>
                                <div class="value">7.00AM - 9.00PM</div>
                            </li>
                            <li class="clearfix"> <span>Sunday</span>
                                <div class="value">7.00AM - 9.00PM</div>
                            </li>
                            <li class="clearfix"> <span>Monday</span>
                                <div class="value">7.00AM - 9.00PM</div>
                            </li>
                            <li class="clearfix"> <span>Tuesday</span>
                                <div class="value">7.00AM - 9.00PM</div>
                            </li>
                            <li class="clearfix"> <span>Wednesday</span>
                                <div class="value">7.00AM - 9.00PM</div>
                            </li>
                            <li class="clearfix"> <span>Thursday</span>
                                <div class="value">7.00AM - 9.00PM</div>
                            </li>
                            <li class="clearfix"> <span>Friday</span>
                                <div class="value">Closed</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom" data-tm-bg-color="#2A2A2A">
            <div class="container">
                <div class="row pt-20 pb-20">
                    <div class="col-sm-6">
                        <div class="footer-paragraph text-left">
                            © {{date('Y')}}. All Rights Reserved Daruuri
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="footer-paragraph text-right">
                            Developed By <a href="https://erevo.net/">Erevo Technology Ltd.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
