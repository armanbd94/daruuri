@component('mail::message')
Hello {{$data['name']}}

Your account has been created successfully. Your account credentials are: <br>
<b>Email:</b> {{$data['email']}}<br>
<b>Password:</b> {{$data['password']}}<br>

@component('mail::button', ['url' => url('admin')])
Click to Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
