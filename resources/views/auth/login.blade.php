<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('settings.site_title') ?? env('APP_NAME') }} - Login</title>
	<link rel="shortcut icon" href="storage/{{LOGO.config('settings.site_favicon') }}" />

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="css/backend/login.css" rel="stylesheet" type="text/css" />
		<link href="css/backend/style.bundle.css" rel="stylesheet" type="text/css" />
<style>
    .is-invalid{
        border: 2px solid #fd397a !important;
    }
</style>
		<!--end::Page Custom Styles -->

		</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(images/bg-2.jpg);">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="{{url('admin')}}">
									<img alt="Logo" src="storage/{{LOGO.config('settings.site_logo') }}" style="width: 150px;" />
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Sign In To Admin</h3>
								</div>
								<form class="kt-form" method="POST" action="{{ route('login') }}">
                                    @csrf
									<div class="input-group">
										<input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email"  value="{{ old('email') }}" autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
									<div class="input-group">
                                        <input class="form-control  @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
									</div>
									<div class="row kt-login__extra">
										<div class="col">
											<label class="kt-checkbox">
												<input type="checkbox" name="remember"  id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
												<span></span>
											</label>
										</div>
										<div class="col kt-align-right">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
                                            @endif
										</div>
									</div>
									<div class="kt-login__actions">
										<button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Sign In</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

	</body>

	<!-- end::Body -->
</html>