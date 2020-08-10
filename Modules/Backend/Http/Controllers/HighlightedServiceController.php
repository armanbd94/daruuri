<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\HighlightedService;
use Validator;
use App\Traits\UploadAble;

class HighlightedServiceController extends BaseController
{
    use UploadAble;
    public function __construct(HighlightedService $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        if (permission('highlighted-service-access')) {
            $this->setPageData('Highlighted Service','Highlighted Service','fas fa-tools');
            return view('backend::highlighted-service.index');
        }else{
            return $this->access_blocked();
        }
    }

    public function getList(Request $request)
    {
        if($request->ajax()){
                if (permission('highlighted-service-access')) {
                if(!empty($request->service_name)){
                    $this->model->setServiceName($request->service_name);
                }
                
                $this->model->setOrderValue($request->input('order.0.column'));
                $this->model->setDirValue($request->input('order.0.dir'));
                $this->model->setLengthValue($request->input('length'));
                $this->model->setStartValue($request->input('start'));
        
                $list   = $this->model->getList();
                $data   = array();
                $no     = $request->input('start');
                foreach ($list as $value) {
                    $no++;
                    $action = '';
                    if (permission('highlighted-service-edit')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link edit_data" data-id="' . $value->id . '" >'.EDIT_ICON.'</a></li>';
                    }
                    if (permission('highlighted-service-delete')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link delete_data" data-id="'.$value->id .'" >'.DELETE_ICON.'</a></li>';
                    }
                    $btngroup = '<span style="overflow: visible; position: relative;">   
                                    <div class="dropdown"> 
                                        <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-lg cursor-pointer"> <i class="flaticon-more-1 text-brand"></i> </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                '.$action.'
                                            </ul>
                                        </div>
                                    </div>
                                </span>';
        
        
                    $row    = array();
                    if (permission('highlighted-service-bulk-action-delete')) {
                    $row[]  = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid"><input type="checkbox" name="did[]" value="' . $value->id . '" class="select_data select_item_' . $value->id . '" onchange="select_single_item(' . $value->id . ')">&nbsp;<span></span></label> ';
                    }
                    $row[]  = $no;
                    $row[]  = "<img src='storage/".SERVICE.$value->image."' alt='".$value->service_name."' style='width:50px;'/>";
                    $row[]  = $value->service_name;
                    $row[]  = self::readMore($value->description, $limit=250);
                    $row[]  = $value->sorting;
                    $row[]  = $btngroup;
                    $data[] = $row;
        
                }
                $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
                echo json_encode($output);
            }
        }
    }

    private static function readMore($text, $limit = 400){
        $text = $text." ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text."...";
        return $text;
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            if (permission('highlighted-service-add') || permission('highlighted-service-edit')) {
                $rules = $this->model::VALIDATION_RULES;
                if(!empty($request->update_id)){
                    $rules['service_name'][2] = 'unique:highlighted_services,service_name,'.$request->update_id;
                    $rules['image'][0] = 'nullable';
                }
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $output = array(
                        'errors' => $validator->errors()
                    );
                } else {
                    
                    $collection = collect($request->all())->only(['service_name','description','sorting']);
                    $image = $request->old_image;
                    if($request->hasFile('image')){
                        $image = $this->upload_file($request->file('image'),SERVICE);
                        if(!empty($request->old_image)){
                            $this->delete_file($request->old_image, SERVICE);
                        }
                    }
                    $created_at = $updated_at = DATETIME;
                    $collection = $collection->merge(compact('image','updated_at'));
                    if(empty($request->update_id)){
                        $collection = $collection->merge(compact('created_at'));
                    }
                    $result = $this->model->updateOrInsert(['id' => $request->update_id],$collection->all());
                    if($result){
                        $this->model->flushCache();
                        $output = $this->success_status();
                    }else{
                        if($request->hasFile('image')){
                            if($image != $request->old_image){
                                $this->delete_file($image, SERVICE);
                            }
                        }
                        $output = $this->error_status();
                    }
                }
                return response()->json($output);
            }
        }
    }


    public function edit(Request $request){
        if($request->ajax()){
            if (permission('highlighted-service-edit')) {
                $result = $this->model->toBase()->find($request->id);
                if($result){
                    $output['service'] = $result;
                }else{
                    $output = $this->error_status();
                }
                return response()->json($output);
            }
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            if (permission('highlighted-service-delete')) {
                $result = $this->model->find($request->id);
                if($result->image){
                    $this->delete_file($request->image, SERVICE);
                }
                if($result->delete()){
                    $this->model->flushCache();
                    $output = $this->success_status();
                }else{
                    $output = $this->error_status();
                }
                return response()->json($output);
            }
        }
    }

    public function bulk_action_delete(Request $request)
    {
        if($request->ajax()){
            if (permission('highlighted-service-bulk-action-delete')) {
                try {
                    $images = $this->model->toBase()->select('image')->whereIn('id',$request->id)->get();
                    $result = $this->model->destroy($request->id);
                    if($result){
                        if(!empty($images)){
                            foreach ($images as $image) {                   
                                if($image->image != null)
                                {
                                    $this->delete_file($image->image,SERVICE);    
                                }
                            }
                        }
                        $this->model->flushCache();
                        $output = $this->success_status();
                    }else{
                        $output = $this->error_status();
                    }
                } catch (\Throwable $e) {
                    $output = ['status' => 'error','message'=> $e->getMessage()];
                }
                
                return response()->json($output);
            }
        }
    }
}
