<div class="tile">
    <form action="{{ route('admin.setting.store') }}" method="POST">
        @csrf
        <h3 class="tile-title text-brand">SEO</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="seo_meta_title">SEO Meta Title</label>
                <input class="form-control" type="text" placeholder="Enter seo meta title for store" id="seo_meta_title"
                    name="seo_meta_title" value="{{ config('settings.seo_meta_title') }}" />
            </div>
            <div class="form-group">
                <label class="control-label" for="seo_meta_description">SEO Meta Description</label>
                <textarea class="form-control" rows="4" placeholder="Enter seo meta description for store"
                    id="seo_meta_description"
                    name="seo_meta_description">{{ config('settings.seo_meta_description') }}</textarea>
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
