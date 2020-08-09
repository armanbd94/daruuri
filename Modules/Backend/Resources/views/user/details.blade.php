<div class="row">
    <div class="col-md-12 text-center">
        @if (!empty($user->avatar))
        <img src="storage/{{USER.$user->avatar}}" alt="{{$user->name}}" style="width:60%;">
        @else 
        <img src="svg/add.svg" alt="{{$user->name}}" style="width:60%;">
        @endif
    </div>
    <div class="col-md-12 font-size-10 pt-3">
        <table class="table table-borderless">
            <tr>
                <td><b>Name</b></td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <td><b>Role</b></td>
                <td>{{$user->role->role}}</td>
            </tr>
            <tr>
                <td><b>Status</b></td>
                <td>{{TEXT_STATUS[$user->status]}}</td>
            </tr>
        </table>
    </div>
</div>
