<div class="row pt-5 justify-content-center">
    <div class="col-md-12 text-center pb-5">
        <h3 style="margin: 0;">Services for <span style="color: #1bacd6;">{{$phones->brand->brand_name.' '.$phones->phone_name}}</span></h3>
        <span>You feel it's expensive? just give us a call for best prices : <b style="color: #1bacd6;">{{config('settings.contact_number')}}</b></span>
    </div>
    @if ($phones->count())
        @foreach ($phones->services as $service)
            <div class="services-style-four col-md-3 col-sm-6 col-xs-12">
                <div class="inner-box text-center">
                    <div class="icon-box">
                        <img style="width: 50px;" src="storage/{{SERVICE_ICON.$service->service_icon}}" alt="{{$service->service_name}}" />
                    </div>
                    <h5>{{$service->service_name}}</h5>
                    <p>{{config('settings.currency_symbol').$service->pivot->price}}</p>
                </div>
            </div>
        @endforeach
    @endif
    
</div>
