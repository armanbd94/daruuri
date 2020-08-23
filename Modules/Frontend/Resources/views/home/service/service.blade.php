<section class="bg-img-no-repeat" data-tm-bg-img="images/bg/bg-shape-bconsul1.png">
    <div class="container pt-50">
        <div class="section-title">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="text-center mb-60">
                        <div
                            class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style4-attached-double-lines1">
                            <div class="title-wrapper">
                                <h2 class="title"> <span class="">Our </span> <span
                                        class="text-theme-colored1">Service</span> Areas</h2>
                                <div class="title-seperator-line"></div>
                                <div class="paragraph">
                                    <p>Explore Our Completed Services!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                @if ($highlighted_services->count())
                @foreach ($highlighted_services as $service)
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="services-block mb-50">
                        <div class="inner-box">
                            <div class="thumb">
                                <img src="storage/{{SERVICE.$service->image}}" alt="{{$service->service_name}}" style="height: 300px;" />
                            </div>
                            <div class="content">
                                <h4><a href="javascript:void(0);">{{$service->service_name}}</a></h4>
                                <p>{{$service->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
