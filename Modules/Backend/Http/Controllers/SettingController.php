<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Setting;
use Validator;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Modules\Backend\Entities\Page;

class SettingController extends BaseController
{
    use UploadAble;
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->setPageData('Setting', 'Setting','fas fa-tools');
        $data['about']    = Page::toBase()->select('id','title','image','description')->find(1);
        $data['hardware'] = Page::toBase()->select('id','title','image','description')->find(2);
        $data['software'] = Page::toBase()->select('id','title','image','description')->find(3);
        return view('backend::setting.index',compact('data'));
    }

    public function store(Request $request)
    {

        if ($request->file('site_logo') instanceof UploadedFile) {

            if (config('settings.site_logo') != null) {
                $this->delete_file(config('settings.site_logo'),LOGO);
            }
            $logo = $this->upload_file($request->file('site_logo'), LOGO, 'logo');
            Setting::set('site_logo', $logo);

        } 
        if ($request->file('site_favicon') instanceof UploadedFile) {

            if (config('settings.site_favicon') != null) {
                $this->delete_file(config('settings.site_favicon'),LOGO);
            }
            $favicon = $this->upload_file($request->file('site_favicon'), LOGO);
            Setting::set('site_favicon', $favicon);

        } 
        if(empty($request->file('site_logo')) && empty($request->file('site_favicon'))){

            $keys = $request->except('_token');

            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }
        return redirect('admin/setting')->with('success','Settings updated successfully.');
        
    }

    public function storePageData(Request $request)
    {
        if($request->update_id){
            $collection = collect($request->all())->only(['title','description']);
            $image = $request->old_image;
            if($request->has('image')){
                $image = $this->upload_file($request->file('image'), PAGE);
                if(!empty($request->old_image)){
                    $this->delete_file($request->old_image,PAGE);
                }
            }
            $created_at = $updated_at = DATETIME;
            $collection = $collection->merge(compact('image','updated_at'));
            if(empty($request->update_id)){
                $collection = $collection->merge(compact('created_at'));
            }
            $result = Page::updateOrInsert(['id'=>$request->update_id],$collection->all());
            if($result){
                Page::flushCache();
                session()->flash('success','Data updated successfully.');
            }else{
                session()->flash('error','Data can not update');
            }
            return redirect('admin/setting');
        }
    }
}
