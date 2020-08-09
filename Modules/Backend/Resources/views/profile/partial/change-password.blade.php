<div class="tile">
    <form action="{{ route('admin.profile.change.password') }}" method="POST">
        @csrf
        <h3 class="tile-title text-brand">Change Password</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group col-md-8 required">
                <label for="old_password">{{ __('Old Password') }}</label>
                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"
                    name="old_password" required>

                @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-8 required">
                <label for="password">{{ __('New Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-md-8 required">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" required>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-brand" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                        Password</button>
                </div>
            </div>
        </div>
    </form>
</div>
