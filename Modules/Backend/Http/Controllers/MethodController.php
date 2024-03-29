<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Method;
use Validator;

class MethodController extends BaseController
{
    public function __construct(Method $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        if (permission('method-manage')) {
            $this->setPageData('Method','Manage Method','fas fa-align-left');
            return view('backend::setting.method.index');
        }else{
            return $this->access_blocked();
        }
    }

    public function getList(Request $request)
    {
        if($request->ajax()){
            if (permission('method-manage')) {
                if(!empty($request->method_name)){
                    $this->model->setMethodName($request->method_name);
                }
                if(!empty($request->module_id)){
                    $this->model->setModuleID($request->module_id);
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
                    if (permission('method-edit')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link edit_data" data-id="' . $value->id . '" >'.EDIT_ICON.'</a></li>';
                    }
                    if (permission('method-delete')) {
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
                    if (permission('method-bulk-action-delete')) {
                    $row[]  = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid"><input type="checkbox" name="did[]" value="' . $value->id . '" class="select_data select_item_' . $value->id . '" onchange="select_single_item(' . $value->id . ')">&nbsp;<span></span></label> ';
                    }
                    $row[]  = $no;
                    $row[]  = $value->method_name;
                    $row[]  = $value->method_slug;
                    $row[]  = '<i class="'.$value->module->module_icon.'"></i> '.$value->module->module_name;
                    $row[]  = $btngroup;
                    $data[] = $row;
        
                }
                $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
                echo json_encode($output);
            }
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            if (permission('method-add') || permission('method-edit')) {
                $rules = $this->model::VALIDATION_RULES;

                if(!empty($request->update_id)){
                    $rules['method_slug'][2]  = 'unique:methods,method_slug,'.$request->update_id;
                }

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $output = array(
                        'errors' => $validator->errors()
                    );
                } else {
                    $collection = collect($request->all())->except(['_token','update_id']);
                    $result = $this->model->updateOrInsert(['id' => $request->update_id],$collection->all());
                    if($result){
                        $output = $this->success_status();
                    }else{
                        $output = $this->error_status();
                    }
                }
                return response()->json($output);
            }
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            if (permission('method-edit')) {
                $result = $this->model->find($request->id);
                if($result){
                    $output['method'] = $result;
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
            if (permission('method-delete')) {
                $result = $this->model->find($request->id)->delete();
                if($result){
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
            if (permission('method-bulk-action-delete')) {
                try {
                    $result = $this->model->destroy($request->id);
                    if($result){
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
