<div class="form-group {{$col ?? ''}} {{$required ?? ''}}">
    <label for="{{$name}}" class="form-control-label">{{$label}}</label>
    <select  class="form-control selectpicker" name="{{$name}}" id="{{$name}}" 
    data-live-search="true" data-live-search-placeholder="Search" title="Choose one of the following...">
    <option value="">Select Please</option>
    {{$slot}}
    </select>
</div>