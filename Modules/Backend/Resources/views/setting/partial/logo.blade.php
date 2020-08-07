<div class="tile">
    <form action="{{ route('admin.setting.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <h3 class="tile-title text-brand">Site Logo</h3>
        <hr>
        <div class="tile-body">
            <div class="row">
                <div class="col-3">
                    @if (config('settings.site_logo') != null)
                        <img src="storage/{{LOGO.config('settings.site_logo') }}" id="logoImg" style="width: 80px; height: auto;">
                    @else
                        <img src="svg/upload.svg" id="logoImg" style="width: 80px; height: auto;">
                    @endif
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label class="control-label">Site Logo</label>
                        <input class="form-control" type="file" name="site_logo" onchange="loadFile(event,'logoImg')"/>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3">
                    @if (config('settings.site_favicon') != null)
                        <img src="storage/{{LOGO.config('settings.site_favicon') }}" id="faviconImg" style="width: 80px; height: auto;">
                    @else
                        <img src="svg/upload.svg" id="faviconImg" style="width: 80px; height: auto;">
                    @endif
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label class="control-label">Site Favicon</label>
                        <input class="form-control" type="file" name="site_favicon" onchange="loadFile(event,'faviconImg')"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-brand" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>

