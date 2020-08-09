<div class="tile">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="tile-title text-brand">My Profile</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group col-md-12">
                <label class="control-label" for="name">Name</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{Auth::user()->name}}" />
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <label class="control-label" for="email">Email</label>
                <input class="form-control" type="email" id="email" value="{{Auth::user()->email}}" disabled />
            </div>
            <div class="form-group col-md-12">
                <label class="control-label">Avatar</label>
                <input class="form-control @error('avatar') is-invalid @enderror" type="file" name="avatar" onchange="loadFile(event,'avatar-image')"/>
                <input class="form-control" type="hidden" name="old_avatar" value="{{Auth::user()->avatar}}"/>
                @error('avatar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-12">
                @if (Auth::user()->avatar != null)
                    <img src="storage/{{USER.Auth::user()->avatar}}" id="avatar-image" style="width: 80px; height: auto;">
                @else
                    <img src="svg/upload.svg" id="avatar-image" style="width: 80px; height: auto;">
                @endif
            </div>
            
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-brand" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
