<section>
    <div class="container-fluid pt-0 pb-0">
        <div class="row">
            <div class="col-md-6 p-0">
                {!! config('settings.google_map_iframe') !!}
            </div>
            <div class="col-md-6 pt-5" style="background: #002e5a;">
                <div id="tm_widget_blog_list-1"
                        class="split-nav-menu clearfix widget widget-blog-list clearfix">
                        <h3
                            class="widget-title text-white widget-title-line-bottom line-bottom-footer-widget line-bottom-theme-colored1">
                            Contact</h3>
                        <div class="tm-widget tm-widget-blog-list ">
                            <!-- the loop -->
                            <article class="post media-post clearfix"> <a class="post-thumb" href="javascript:void(0);"><img
                                        style="width: 70%;" src="images/icon/mail.svg" class="" alt="" /></a>
                                <div class="post-right">
                                    <h6 class="post-title text-white"> <a href="javascript:void(0);" class=" text-white">Email </a> </h6>
                                    <span class="post-date">
                                        <time class="entry-date">{{ config('settings.email_address') }}</time>
                                    </span>
                                </div>
                            </article>
                            <article class="post media-post clearfix"> <a class="post-thumb" href="javascript:void(0);"><img
                                        style="width: 70%;" src="images/icon/smartphone.svg" class=""
                                        alt="" /></a>
                                <div class="post-right">
                                    <h6 class="post-title text-white"> <a href="javascript:void(0);" class=" text-white"> Phone </a> </h6>
                                    <span class="post-date">
                                        <time class="entry-date">{{ config('settings.contact_number') }}</time>
                                    </span>
                                </div>
                            </article>
                            <article class="post media-post clearfix"> <a class="post-thumb" href="javascript:void(0);"><img
                                        style="width: 70%;" src="images/icon/address.svg" class="" alt="" /></a>
                                <div class="post-right">
                                    <h6 class="post-title text-white"> <a href="javascript:void(0);" class=" text-white"> Address </a> </h6>
                                    <span class="post-date">
                                        <time class="entry-date">{{ config('settings.contact_address') }}</time>
                                    </span>
                                </div>
                            </article>
                            <!-- end of the loop -->
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>