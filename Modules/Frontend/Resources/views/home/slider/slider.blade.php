<section id="home" class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col">
                <!-- START Home Slider REVOLUTION SLIDER 6.0.8 -->
                <p class="rs-p-wp-fix"></p>
                <rs-module-wrap id="rev_slider_1_1_wrapper" data-alias="home-slider" data-source="gallery"
                    style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                    <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.0.8">
                        <rs-slides>
                            @if ($data['sliders']->count())
                                @foreach ($data['sliders'] as $key => $item)
                                <rs-slide data-key="rs-{{$key+1}}" data-title="{{$item->title}}" data-thumb="storage/{{SLIDER.$item->image}}"
                                data-anim="ei:d;eo:d;s:d;r:0;t:slotslide-horizontal;sl:d;">
                                <img src="storage/{{SLIDER.$item->image}}" title="{{$item->title}}" width="1920" height="1280"
                                    data-bg="p:center center;" data-parallax="off" class="rev-slidebg"
                                    data-no-retina>
                                <rs-layer id="slider-1-slide-{{$key+1}}-layer-14" class="text-theme-colored1 rs-pxl-1"
                                    data-type="text" data-color="#00c3ed" data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:50px,50px,35px,0;yo:210px,219px,140px,135px;"
                                    data-text="w:normal;s:36,28,30,26;l:54,43,45,42;fw:800;a:left,left,left,center;"
                                    data-dim="w:auto,auto,291px,297px;h:auto,auto,48px,46px;"
                                    data-padding="r:15,11,8,5;l:15,11,12,7;"
                                    data-border="bos:solid;boc:#00c3ed;bow:2px,0,0,5px;"
                                    data-frame_0="rX:70deg;oZ:-50;" data-frame_0_chars="y:cyc(-100||100);o:0;"
                                    data-frame_1="oZ:-50;e:Power4.easeInOut;st:1260;sp:1750;"
                                    data-frame_1_chars="e:Power4.easeInOut;dir:middletoedge;d:10;"
                                    data-frame_999="y:0;o:0;rX:70deg;oZ:-50;e:Power4.easeInOut;st:w;sp:1750;"
                                    data-frame_999_chars="e:Power4.easeInOut;dir:middletoedge;d:10;y:cyc(-100||100);o:0;"
                                    style="z-index:13;background-color:rgba(0,0,0,0.3);font-family:Poppins;">
                                    {{$item->title}}
                                </rs-layer>

                                <rs-layer id="slider-1-slide-{{$key+1}}-layer-19" class="rs-pxl-1" data-type="text"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:50px,50px,35px,2px;yo:280px,291px,202px,208px;"
                                    data-text="w:normal;s:85,76,75,56;l:100,90,90,70;fw:700;a:left,left,left,center;"
                                    data-dim="w:724px,644px,653px,476px;" data-frame_0="x:-50,-38,-28,-17;"
                                    data-frame_1="st:1700;sp:1000;"
                                    data-frame_999="x:-50,-38,-28,-17;o:0;st:w;sp:1000;"
                                    style="z-index:12;font-family:Poppins;">{{$item->sub_title}}
                                </rs-layer>

                                <a href="{{url('/'.$item->button_link) ?? url('/')}}"><rs-layer id="slider-1-slide-{{$key+1}}-layer-20" class="rev-btn rs-pxl-1" data-type="button"
                                    data-rsp_ch="on"
                                    data-xy="x:l,l,l,c;xo:50px,50px,35px,0;y:m,m,m,t;yo:140px,131px,131px,393px;"
                                    data-text="w:normal;s:20,15,16,16;f:left,none,none,none;c:both,none,none,none;l:40,30,22,13;fw:500;a:left,left,left,center;"
                                    data-flcr="f:left,none,none,none;c:both,none,none,none;"
                                    data-dim="minh:0px,none,none,none;"
                                    data-padding="t:10,8,15,16;r:60,46,48,38;b:10,8,15,16;l:60,46,48,38;"
                                    data-border="bor:5px,5px,5px,5px;" data-frame_0="y:bottom;"
                                    data-frame_1="st:2170;sp:1000;sR:2170;"
                                    data-frame_999="o:0;st:w;sp:1500;sR:5830;"
                                    data-frame_hover="bgc:#00c3ed;bor:5px,5px,5px,5px;bri:120%;"
                                    style="z-index:11;background-color:#00c3ed;font-family:Roboto;">Read
                                    More
                                </rs-layer></a>

                            </rs-slide>
                                @endforeach
                            @endif

                        </rs-slides>
                        <rs-static-layers>
                        </rs-static-layers>
                        <rs-progress class="rs-bottom" style="height: 5px; background: rgba(199,199,199,0.5);">
                        </rs-progress>
                    </rs-module>
                </rs-module-wrap>
                <!-- END REVOLUTION SLIDER -->
            </div>
        </div>
    </div>
</section>