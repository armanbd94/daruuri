@component('mail::message')

Hello,

{{$data['message']}}

Thanks,<br>
<b>{{$data['name']}}</b><br>
{{$data['phone']}}<br>
{{$data['email']}}
@endcomponent
