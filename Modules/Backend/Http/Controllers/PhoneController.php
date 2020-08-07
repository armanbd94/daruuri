<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Phone;
use Modules\Backend\Entities\Brand;
use Modules\Backend\Entities\Service;
use Validator;

class PhoneController extends BaseController
{
    public function __construct(Phone $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $this->setPageData('Phone','Phone','fas fa-mobile');
        $data['brands'] = Brand::allBrands();
        $data['services'] = Service::allServices();
        return view('backend::phone.index',compact('data'));
    }


    public function getList(Request $request)
    {
        if($request->ajax()){

            if(!empty($request->brand_id)){
                $this->model->setBrandID($request->brand_id);
            }
            if(!empty($request->phone_name)){
                $this->model->setPhoneName($request->phone_name);
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
                $action .= '<li class="kt-nav__item"><a class="kt-nav__link view_data" data-id="' . $value->id . '" >'.VIEW_ICON.'</a></li>';
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
                $row[]  = $value->phone_name;
                $row[]  = $value->brand->brand_name;
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
            $rules   = $this->model::VALIDATION_RULES;
            $message = $this->model::MESSAGE;
            if(!empty($request->update_id)){
                $rules['phone_name'][2] = 'unique:phones,phone_name,'.$request->update_id;
            }
            $services = [];
            if($request->has('service')){
                foreach($request->service as $key => $value)
                {
                    $rules['service.'.$key.'.price']              = ['required','numeric','min:1'];
                    $message['service.'.$key.'.price.required']   = 'The price field is required';
                    $message['service.'.$key.'.price.numeric']    = 'The price field value must be numeric';
                    $services[$value['service_id']] = [
                            'price' => $value['price']
                    ];
                }
                
            }
            $validator = Validator::make($request->all(), $rules, $message);
            if ($validator->fails()) {
                $output = array(
                    'errors' => $validator->errors()
                );
            } else {
                $collection = collect($request->all())->only(['brand_id','phone_name','status']);
                $result = $this->model->updateOrCreate(['id' => $request->update_id],$collection->all());
                if($result){
                    $phone = $this->model->with('services')->find($result->id);
                    $phone->services()->sync($services);
                    $output = $this->success_status();
                }else{
                    $output = $this->error_status();
                }
            }
            return response()->json($output);
        }
    }

    public function show(Request $request){
        if($request->ajax()){
            $phone = $this->model->with(['brand:id,brand_name','services'])->find($request->id);
            if($phone){
                $output['phone'] = view('backend::phone.details',compact('phone'))->render();
                $output['phone_name'] = $phone->phone_name;
            }else{
                $output = $this->error_status();
            }
            return response()->json($output);
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            $result = $this->model->with('services')->find($request->id);
            if($result){
                $output['phone'] = $result;
            }else{
                $output = $this->error_status();
            }
            return response()->json($output);
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            $phone = $this->model->with('services')->find($request->id);
            if($phone){
                $delete_services = $phone->services()->detach();
                if($delete_services){
                    $phone->delete();
                    $output = $this->success_status();
                }else{
                    $output = $this->error_status();
                }
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
                foreach ($request->id as $id) {
                    $phone = $this->model->with('services')->find($id);
                    if($phone){
                        $delete_services = $phone->services()->detach();
                        if($delete_services){
                            $phone->delete();
                            $output = $this->success_status();
                        }else{
                            $output = $this->error_status();
                        }
                    }else{
                        $output = $this->error_status();
                    }
                }
                
            } catch (\Throwable $e) {
                $output = ['status' => 'error','message'=> $e->getMessage()];
            }
            
            return response()->json($output);
        }
    }
}
