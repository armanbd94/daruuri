<div class="form-group {{$col ?? ''}} {{$required ?? ''}}">
    <label for="{{$name}}" class="form-control-label">{{$label}}</label>
    <textarea class="form-control" name="{{$name}}" id="{{$name}}" placeholder="{{$placeholder ?? ''}}">{{$value ?? ''}}</textarea>
</div>