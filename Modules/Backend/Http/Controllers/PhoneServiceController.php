<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Service;
use Validator;
use App\Traits\UploadAble;
class PhoneServiceController extends BaseController
{
    use UploadAble;
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $this->setPageData('Phone Service','Phone Service','fas fa-tools');
        return view('backend::phone.service.index');
    }

    public function getList(Request $request)
    {
        if($request->ajax()){

            if(!empty($request->service_name)){
                $this->model->setServiceName($request->service_name);
            }
            if(!empty($request->status)){
                $this->model->setStatus($request->status);
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
                $action .= '<li class="kt-nav__item"><a class="kt-nav__link edit_data" data-id="' . $value->id . '" >'.EDIT_ICON.'</a></li>';

                $action .= '<li class="kt-nav__item"><a class="kt-nav__link delete_data" data-id="'.$value->id .'" >'.DELETE_ICON.'</a></li>';
                
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
                $row[]  = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid"><input type="checkbox" name="did[]" value="' . $value->id . '" class="select_data select_item_' . $value->id . '" onchange="select_single_item(' . $value->id . ')">&nbsp;<span></span></label> ';
                $row[]  = $no;
                $row[]  = "<img src='storage/".SERVICE_ICON.$value->service_icon."' alt='".$value->service_name."' style='width:50px;'/>";
                $row[]  = $value->service_name;
                $row[]  = BUTTON_STATUS[$value->status];
                $row[]  = $btngroup;
                $data[] = $row;
    
            }
            $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
            echo json_encode($output);
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()){
           
            $rules = $this->model::VALIDATION_RULES;
            if(!empty($request->update_id)){
                $rules['service_name'][2] = 'unique:services,service_name,'.$request->update_id;
                $rules['service_icon'][0] = 'nullable';
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $output = array(
                    'errors' => $validator->errors()
                );
            } else {
                
                $collection = collect($request->all())->only(['service_name','status']);
                $service_icon = $request->old_service_icon;
                if($request->hasFile('service_icon')){
                    $service_icon = $this->upload_file($request->file('service_icon'),SERVICE_ICON);
                    if(!empty($request->old_service_icon)){
                        $this->delete_file($request->old_service_icon, SERVICE_ICON);
                    }
                }
                $created_at = $updated_at = DATETIME;
                $collection = $collection->merge(compact('service_icon','updated_at'));
                if(empty($request->update_id)){
                    $collection = $collection->merge(compact('created_at'));
                }
                $result = $this->model->updateOrInsert(['id' => $request->update_id],$collection->all());
                if($result){
                    $this->model->flushCache();
                    $output = $this->success_status();
                }else{
                    $output = $this->error_status();
                }
            }
            return response()->json($output);
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            $result = $this->model->find($request->id);
            if($result){
                $output['service'] = $result;
            }else{
                $output = $this->error_status();
            }
            return response()->json($output);
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            $result = $this->model->find($request->id);
            if($result->service_icon){
                $this->delete_file($request->service_icon, SERVICE_ICON);
            }
            if($result->delete()){
                $output = $this->success_status();
            }else{
                $output = $this->error_status();
            }
            return response()->json($output);
        }
    }

    public function bulk_action_delete(Request $request)
    {
        if($request->ajax()){
            try {
                $services = $this->model->toBase()->select('service_icon')->whereIn('id',$request->id)->get();
                $result = $this->model->destroy($request->id);
                if($result){
                    if(!empty($services)){
                        foreach ($services as $service) {                   
                            if($service->service_icon != null)
                            {
                                $this->delete_file($service->service_icon,SERVICE_ICON);    
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
