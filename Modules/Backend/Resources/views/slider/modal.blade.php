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
                        <x-backend.form.text-box label="Title" col="col-md-6"  name="title"  required="required" placeholder="Enter title"/>
                        <x-backend.form.text-box label="Sub Title" col="col-md-6"  name="sub_title"  required="required" placeholder="Enter sub title"/>
                        <x-backend.form.text-box label="Button Link" col="col-md-6"  name="button_link" placeholder="Enter button link"/>
                        <x-backend.form.text-box label="Sorting No" col="col-md-6"  name="sorting"  required="required" placeholder="Enter sorting number"/>

                        <x-backend.form.file label="Image" col="col-md-6" name="image" required="required" onchange="loadFile(event,'slider-image')"/>
                        <div class="form-group col-md-6">
                            <img src="svg/upload.svg" class="show-image" id="slider-image" style="width: 80px;">
                            <input type="hidden" name="old_image" id="old_image">
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