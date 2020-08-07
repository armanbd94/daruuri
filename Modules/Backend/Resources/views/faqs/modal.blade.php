<div class="modal fade" id="saveDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
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
                        <x-backend.form.text-box label="Question" col="col-md-12" name="question" required="required" placeholder="Enter question"/>
                        <x-backend.form.textarea label="Answer" col="col-md-12"  name="answer" required="required" placeholder="Enter question answer" />
                        <x-backend.form.text-box label="Sorting No" col="col-md-12" name="sorting" required="required" placeholder="Enter sorting number"/>
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