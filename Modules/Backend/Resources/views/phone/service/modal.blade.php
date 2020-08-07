<div class="modal fade" id="saveDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
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
                        <x-backend.form.text-box label="Service Name" col="col-md-12"  name="service_name" 
                         required="required" placeholder="Enter service name"/>

                        <x-backend.form.select-box label="Status" col="col-md-12" name="status" required="required">
                            @foreach (TEXT_STATUS as $id => $text)
                            <option value="{{$id}}">{{$text}}</option>
                            @endforeach
                        </x-backend.form.select-box>

                        <x-backend.form.file label="Service Icon" col="col-md-12" name="service_icon" required="required" onchange="loadFile(event,'service-icon')"/>
                        <div class="form-group col-md-12">
                            <img src="svg/upload.svg" class="show-image" id="service-icon" style="width: 80px;">
                            <input type="hidden" name="old_service_icon" id="old_service_icon">
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