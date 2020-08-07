<div class="modal fade" id="saveDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i>
                </button>
            </div>
            <form method="POST" id="saveDataForm">
                @csrf
                <input type="hidden" class="form-control" name="update_id" id="update_id">
                <div class="modal-body">
                    <div class="row">
                        <x-backend.form.text-box label="Phone Name" col="col-md-4"  name="phone_name" 
                        required="required" placeholder="Enter phone name"/>
                        
                        <x-backend.form.select-box label="Brand" col="col-md-4" name="brand_id" required="required">
                            @if (!empty($data['brands']))
                                @foreach ($data['brands'] as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            @endif
                        </x-backend.form.select-box>

                        <x-backend.form.select-box label="Status" col="col-md-4" name="status" required="required">
                            @foreach (TEXT_STATUS as $id => $text)
                            <option value="{{$id}}">{{$text}}</option>
                            @endforeach
                        </x-backend.form.select-box>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead class="bg-primary text-white">
                                    <th width="60%">Service Name</th>
                                    <th width="40%" class="text-right">Price</th>
                                </thead>
                                <tbody>
                                    @if ($data['services']->count())
                                        @foreach ($data['services'] as $service)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" onchange="disable_price(this.value)" name="service[{{$service->id}}][service_id]" value="{{$service->id}}" id="{{$service->id.'_service'}}" checked>
                                                    <label class="custom-control-label" for="{{$service->id.'_service'}}">{{$service->service_name}}</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-right price_box" name="service[{{$service->id}}][price]" id="service_{{$service->id}}_price">
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-brand btn-sm" id="save-btn"></button>
                </div>
            </form>
        </div>
    </div>
</div>