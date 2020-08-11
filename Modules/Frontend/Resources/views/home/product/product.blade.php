<section>
    <div class="container pt-90">
        <div class="section-title">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="text-center mb-60">
                        <div
                            class="tm-sc tm-sc-section-title section-title section-title-style1 text-center line-bottom-style4-attached-double-lines1">
                            <div class="title-wrapper">
                                <h2 class="title"> <span class="">Our </span> <span
                                        class="text-theme-colored1">Recent</span> Products</h2>
                                <div class="title-seperator-line"></div>
                                <div class="paragraph">
                                    <p>See Our Recent Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                @if ($data['products']->count())
                @foreach ($data['products'] as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="img-box">
                            @if (!empty($product->product_image))
                            <img src="storage/{{PRODUCT.$product->product_image}}" alt="{{$product->product_name}}">
                            @else 
                            <img src="svg/no-phone.svg" alt="{{$product->product_name}}">
                            @endif
                        </div>
                        <div class="content">
                            <h4>{{$product->product_name}}</h4>
                            <span class="badge badge-pill badge-primary">{{$product->brand->brand_name}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
                @endif
                
            </div>
        </div>
    </div>
</section>
