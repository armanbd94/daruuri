<div class="row">
    <div class="col-md-12 font-size-10">
        <table class="table table-borderless">
            <tr>
                <td><b>Name</b></td>
                <td>{{$feedback->name}}</td>
            </tr>
            <tr>
                <td><b>Phone</b></td>
                <td>{{$feedback->phone_no}}</td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td>{{$feedback->email}}</td>
            </tr>
            <tr>
                <td><b>Daruuri Rating</b></td>
                <td>{{$feedback->daruuri_rating}}</td>
            </tr>
            <tr>
                <td><b>Communication Rating</b></td>
                <td>{{$feedback->communication_rating}}</td>
            </tr>
            <tr>
                <td><b>Stuff Rating</b></td>
                <td>{{$feedback->stuff_rating}}</td>
            </tr>
            <tr>
                <td><b>Service Rating</b></td>
                <td>{{$feedback->service_rating}}</td>
            </tr>
            <tr>
                <td><b>Referal Rating</b></td>
                <td>{{$feedback->referal_rating}}</td>
            </tr>
            <tr>
                <td><b>Feedback Date</b></td>
                <td>{{date('d-M-Y',strtotime($feedback->created_at))}}</td>
            </tr>
            <tr>
                <td><b>Message</b></td>
                <td>{{$feedback->description}}</td>
            </tr>

        </table>
       
    </div>
</div>
