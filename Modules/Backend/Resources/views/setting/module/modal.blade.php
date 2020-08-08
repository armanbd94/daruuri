<div class="modal fade" id="saveDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
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
                        <x-backend.form.text-box onkeyup="url_generator(this.value, output_id='module_link')" label="Module Name" col="col-md-12" name="module_name" required="required" placeholder="Enter module name"/>
                        <x-backend.form.text-box label="Module Link" col="col-md-12" name="module_link" required="required" placeholder="Enter module link"/>
                        <x-backend.form.text-box label="Module Icon" col="col-md-12" name="module_icon" required="required" placeholder="Enter module icon"/>
                        <x-backend.form.text-box label="Module Sequence" col="col-md-12" name="module_sequence" required="required" placeholder="Enter module sequence"/>
                        <x-backend.form.select-box label="Parent" col="col-md-12" name="parent_id" />
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
