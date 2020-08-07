<div class="modal fade" id="saveDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i>
                </button>
            </div>
            <form method="POST" id="saveDataForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" name="update_id" id="update_id">
                <div class="modal-body">
                    <div class="row">
                        <x-backend.form.text-box label="Product Name" col="col-md-6"  name="product_name" 
                         required="required" placeholder="Enter product name"/>

                        <x-backend.form.select-box label="Brand" col="col-md-6" name="brand_id">
                            @if (!empty($data['brands']))
                                @foreach ($data['brands'] as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            @endif
                        </x-backend.form.select-box>

                        <x-backend.form.select-box label="Category" col="col-md-6" name="category_id" required="required">
                            @if (!empty($data['categories']))
                                @foreach ($data['categories'] as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            @endif
                        </x-backend.form.select-box>

                        <x-backend.form.select-box label="Status" col="col-md-6" name="status" required="required">
                            @foreach (TEXT_STATUS as $id => $text)
                            <option value="{{$id}}">{{$text}}</option>
                            @endforeach
                        </x-backend.form.select-box>

                        <x-backend.form.textarea label="Description" col="col-md-12"  name="description" 
                         placeholder="Enter product short description" />

                        <x-backend.form.file label="Product Image" col="col-md-6" name="product_image" required="required" onchange="loadFile(event,'product-image')"/>
                        <div class="form-group col-md-6">
                            <img src="svg/upload.svg" class="show-image" id="product-image" style="width: 80px;">
                            <input type="hidden" name="old_product_image" id="old_product_image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-brand btn-sm" id="save-btn"></button>
                </div>
            </form>
        </div>
    </div>
</div>