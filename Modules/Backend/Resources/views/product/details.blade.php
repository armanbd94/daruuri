<div class="row">
    <div class="col-md-12 text-center">
        <img src="storage/{{PRODUCT.$product->product_image}}" alt="{{$product->product_name}}" style="width:60%;">
    </div>
    <div class="col-md-12 font-size-10">
        <table class="table table-borderless">
            <tr>
                <td><b>Name</b></td>
                <td>{{$product->product_name}}</td>
            </tr>
            <tr>
                <td><b>Brand</b></td>
                <td>{{$product->brand->brand_name}}</td>
            </tr>
            <tr>
                <td><b>Category</b></td>
                <td>{{$product->category->category_name}}</td>
            </tr>
            <tr>
                <td><b>Status</b></td>
                <td>{{TEXT_STATUS[$product->status]}}</td>
            </tr>
            <tr>
                <td><b>Description</b></td>
                <td>{{$product->description}}</td>
            </tr>
        </table>
    </div>
</div>