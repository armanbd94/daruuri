<div class="row">
    <div class="col-md-12 font-size-10">
        <table class="table table-borderless">
            <tr>
                <td><b>Name</b></td>
                <td>{{$phone->phone_name}}</td>
            </tr>
            <tr>
                <td><b>Brand</b></td>
                <td>{{$phone->brand->brand_name}}</td>
            </tr>
            <tr>
                <td><b>Status</b></td>
                <td>{{TEXT_STATUS[$phone->status]}}</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <th width="60%">Service Name</th>
                <th width="40%" class="text-right">Price</th>
            </thead>
            <tbody>
                @if ($phone->services->count())
                    @foreach ($phone->services as $service)
                    <tr>
                        <td>{{$service->service_name}}</td>
                        <td class="text-right">{{$service->pivot->price}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>