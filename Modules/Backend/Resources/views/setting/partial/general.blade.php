<div class="tile">
    <form action="{{ route('admin.setting.store') }}" method="POST">
        @csrf
        <h3 class="tile-title text-brand">General Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_title">Site Title</label>
                <input class="form-control" type="text" placeholder="Enter site title" id="site_title" name="site_title"
                    value="{{ config('settings.site_title') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="email_address">Contact Email</label>
                <input class="form-control" type="email" placeholder="Enter store default email address"
                    id="email_address" name="email_address" value="{{ config('settings.email_address') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="contact_number">Contact Number</label>
                <input class="form-control" type="text" placeholder="Enter store default email address"
                    id="contact_number" name="contact_number" value="{{ config('settings.contact_number') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="contact_address">Contact Address</label>
                <input class="form-control" type="text" placeholder="Enter store default email address"
                    id="contact_address" name="contact_address" value="{{ config('settings.contact_address') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="currency_symbol">Currency Symbol</label>
                <input class="form-control" type="text" placeholder="Enter store currency symbol" id="currency_symbol"
                    name="currency_symbol" value="{{ config('settings.currency_symbol') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="google_map_iframe">Google Map</label>
                <textarea class="form-control" type="text" placeholder="Enter map iframe" id="google_map_iframe"
                    name="google_map_iframe" >{{ config('settings.google_map_iframe') }}</textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="footer_description">Footer Description</label>
                <textarea class="form-control" type="text" placeholder="Enter footer description" id="footer_description"
                    name="footer_description" >{{ config('settings.footer_description') }}</textarea>
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
