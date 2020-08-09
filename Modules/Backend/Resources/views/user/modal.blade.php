<div class="modal fade" id="saveDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                        <x-backend.form.text-box label="Name" col="col-md-6" name="name" required="required" placeholder="Enter name"/>
                        <x-backend.form.text-box type="email" label="Email" col="col-md-6" name="email" required="required" placeholder="Enter email"/>
                        <x-backend.form.text-box type="password" label="Password" col="col-md-6" name="password" required="required" placeholder="Enter password"/>
                        <x-backend.form.text-box type="password" label="Confirm Password" col="col-md-6" name="password_confirmation" required="required" placeholder="Re enter password"/>
                        <x-backend.form.select-box label="Role" col="col-md-6" name="role_id" required="required">
                            @if (!empty($data['roles']))
                            @foreach ($data['roles'] as $role)
                            <option value="{{$role->id}}">{{$role->role}}</option>
                            @endforeach
                            @endif
                        </x-backend.form.select-box>
                        <x-backend.form.select-box label="Status" col="col-md-6" name="status" required="required">
                            @foreach (TEXT_STATUS as $id => $text)
                            <option value="{{$id}}">{{$text}}</option>
                            @endforeach
                        </x-backend.form.select-box>
                        <x-backend.form.file label="Avatar" col="col-md-6" name="avatar" onchange="loadFile(event,'avatar-image')"/>
                        <div class="form-group col-md-6">
                            <img src="svg/upload.svg" class="show-image" id="avatar-image" style="width: 80px;">
                            <input type="hidden" name="old_avatar" id="old_avatar">
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
