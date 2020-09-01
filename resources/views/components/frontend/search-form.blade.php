<section class="overlay-theme-colored2-9 container-fluid bg-theme-colored2" style="width: 100%;" data-tm-bg-img="images/search-form-bg.jpg">
    <div class="container py-5">
        <h6 class="text-white">Repair Cost For Your Smartphone</h6>
        <form method="POST" id="searchDataForm">
            @csrf
            <div class="row">
                
                <div class="form-group col-md-5">
                    <select required name="brand_id" id="brand_id" onchange="getPhoneList(this.value)" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Choose a Brand">
                        <option value="">Select a Brand</option>
                        @if ($brands->count())
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <select required name="phone_id" id="phone_id" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" title="Choose a Phone">
                        <option value="">Select a Phone</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <button type="button"
                        class="wpcf7-form-control wpcf7-submit btn btn-theme-colored1 btn-round" id="search-btn"><i class="fas fa-search"></i> Search</button>
                </div>
            </div>
        </form>
    </div>
</section>