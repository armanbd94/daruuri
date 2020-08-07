@component('mail::message')
Hello,

{{$data['message']}}

Thanks,<br>
{{$data['name']}}<br>
{{$data['phone']}}
@endcomponent
