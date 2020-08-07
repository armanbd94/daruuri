<div class="tile">
    <form action="{{ route('admin.page') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="update_id" value="{{$data['software']->id}}">
        <h3 class="tile-title text-brand">About</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="title">Title</label>
                <input class="form-control" type="text" placeholder="Enter title" id="title" name="title"
                    value="{{$data['software']->title}}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="description">Description</label>
                <textarea class="form-control" type="text" placeholder="Enter description" id="description"
                    name="description" >{{ $data['software']->description }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="control-label">Image</label>
                <input class="form-control" type="file" name="image" onchange="loadFile(event,'software_image')"/>
                <input type="hidden" name="old_image" value="{{$data['software']->image}}">
            </div>
            <div class="form-group">
                @if ($data['software']->image != null)
                    <img src="storage/{{PAGE.$data['software']->image }}" id="software_image" style="width: 80px; height: auto;">
                @else
                    <img src="svg/upload.svg" id="software_image" style="width: 80px; height: auto;">
                @endif
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-brand" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                        Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>
