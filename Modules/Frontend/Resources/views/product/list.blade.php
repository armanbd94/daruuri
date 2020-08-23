@if ($products->count())
    <div class="col-md-12 pb-5">
        @if (!empty($phone))
        <h4 class="text-left" style="color: #1bacd6;font-weight:bold;">
            Search Result for <b class="text-danger">"{{$phone}}"</b>
        </h4>
        @endif
        @if (!empty($brand_name))
        <h4 class="text-left" style="color: #1bacd6;font-weight:bold;">
            Filtered Result for <b class="text-danger">"{{$brand_name}}"</b>
        </h4>
        @endif
        <b>Showing {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}} result</b>
    </div>
    @foreach ($products as $product)
        <div class="col-md-4">
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
    <div class="col-md-12 pt-3" style="padding-left: 5px !important;padding-right:5px !important;">
       {{$products->onEachSide(1)->links()}}
    </div>
@else
<div class="col-md-12">
    <h4 class="text-center text-danger">No Product Found</h4>
</div>
@endif
