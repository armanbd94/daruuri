<div class="form-group {{$col ?? ''}} {{$required ?? ''}}">
    <label for="{{$name}}" class="form-control-label">{{$label}}</label>
    <input type="{{$type ?? 'text'}}" class="form-control" name="{{$name}}" id="{{$name}}" value="{{$value ?? ''}}" 
    @if(!empty($onkeyup)) onkeyup="{{$onkeyup ?? ''}}" @endif placeholder="{{$placeholder ?? ''}}">
</div>
