<header id="header" class="header header-layout-type-header-2rows">
    
    <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed green">
            <div class="menuzord-container header-nav-container green ">
                <div class="container position-relative">
                    <div class="row">
                        <div class="col">
                            <div class="row header-nav-col-row">
                                <div class="col-sm-auto align-self-center">
                                    <a class="menuzord-brand site-brand" href="index-mp-layout1.html">
                                        <img class="logo-default logo-1x" src="storage/{{LOGO.config('settings.site_logo') }}" alt="Logo">
                                        <img class="logo-default logo-2x retina" src="storage/{{LOGO.config('settings.site_logo') }}"
                                            alt="Logo">
                                    </a>
                                </div>
                                <div class="col-sm-auto ml-auto pr-0 align-self-center">
                                    <nav id="top-primary-nav" class="menuzord green" data-effect="fade"
                                        data-animation="none" data-align="right">
                                        <ul id="main-nav" class="menuzord-menu">
                                            <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
                                            <li class="{{ (request()->is('about')) ? 'active' : '' }}"><a href="{{route('about')}}">About</a></li>
                                            <li class="
                                            @if ($categories->count())
                                            @foreach ($categories as $category)
                                            {{ (request()->is("product/{$category->category_slug}")) ? 'active' : '' }}
                                            @endforeach @endif"><a href="javascript:void(0);">Product</a>
                                                <ul class="dropdown">
                                                    @if ($categories->count())
                                                        @foreach ($categories as $category)
                                                        <li><a href="{{route('product',['category' => $category->category_slug])}}">{{$category->category_name}}</a></li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('service')) ? 'active' : '' }}"><a href="{{route('service')}}">Service</a></li>
                                            <li  class="{{ (request()->is('faqs')) ? 'active' : '' }} {{ (request()->is('feedback')) ? 'active' : '' }}">
                                                <a href="javascript:void(0);">Support</a>
                                                <ul class="dropdown">
                                                    <li><a href="{{route('faqs')}}">FAQs</a></li>
                                                    <li><a href="{{route('feedback')}}">Feedback</a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ (request()->is('contact')) ? 'active' : '' }}"><a href="{{route('contact')}}">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="row d-block d-xl-none">
                                <div class="col-12">
                                    <nav id="top-primary-nav-clone"
                                        class="menuzord d-block d-xl-none default menuzord-color-default menuzord-border-boxed menuzord-responsive"
                                        data-effect="slide" data-animation="none" data-align="right">
                                        <ul id="main-nav-clone"
                                            class="menuzord-menu menuzord-right menuzord-indented scrollable">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>