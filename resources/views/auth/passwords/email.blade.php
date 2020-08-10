<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{asset('/')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('settings.site_title') ?? env('APP_NAME') }} - Forgot Password</title>
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
									<h3 class="kt-login__title">Forgot Your Password?</h3>
								</div>
								@if (session('error'))
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button class="close" type="button" data-dismiss="alert">×</button>
									<strong>Error! </strong> {{ session('error') }}
								</div>
                                @endif
                                @if (session('status'))
                                <div class="alert alert-success alert-dismissible" role="alert">
									<button class="close" type="button" data-dismiss="alert">×</button>
                                    <strong>Success! </strong>  {{ session('status') }}
                                </div>
                                @endif
								<form class="kt-form" method="POST" action="{{ route('password.email') }}">
                                    @csrf
									<div class="input-group">
										<input class="form-control @error('email') is-invalid @enderror" type="email" name="email"  value="{{ old('email') }}" placeholder="Enter email to receive password reset link" autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
									<div class="kt-login__actions">
										<button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
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
