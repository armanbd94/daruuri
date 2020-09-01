<section class="bg-img-no-repeat bg-img-right" data-tm-bg-img="images/bg/bg-shape-bconsul2.png">
    <div class="container {{$padding ?? ''}}">
        <div class="section-content">
            <div class="row">
                <div class="col-sm-12 col-lg-5 col-md-5">
                    <img  class="lazyload" src="svg/spinner.svg" data-src="storage/{{PAGE.$about->image}}" class="attachment-full" alt="{{$about->title}}" />
                </div>
                <div class="col-sm-12 col-lg-7 col-md-7 text-justify" id="content-text">
                    <style>
                        #content-text p{
                            margin-bottom: 0 !important;
                        }
                        #content-text ul li::marker{
                            color: #1bacd6 !important;
                            font-size: 20px;
                        }
                    </style>
                    <h2>{{$about->title}}</h2>

                    {!! $about->description !!}
                </div>
            </div>
        </div>
    </div>
</section>