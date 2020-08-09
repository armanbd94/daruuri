<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i>
                </button>
            </div>
            <form method="POST" id="changePasswordForm">
                @csrf
                <input type="hidden" class="form-control" name="update_id" id="update_id">
                <div class="modal-body">
                    <div class="row">
                        <x-backend.form.text-box type="password" label="New Password" col="col-md-12" name="password" required="required" placeholder="Enter password"/>
                        <x-backend.form.text-box type="password" label="Confirm Password" col="col-md-12" name="password_confirmation" required="required" placeholder="Re enter password"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-brand btn-sm" id="change-password-btn"></button>
                </div>
            </form>
        </div>
    </div>
</div>
