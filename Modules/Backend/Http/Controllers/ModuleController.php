<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Module;
use Validator;

class ModuleController extends BaseController
{
    public function __construct(Module $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $this->setPageData('Module','Manage Module','fas fa-align-left');
        return view('backend::setting.module.index');
    }

    public function getList(Request $request)
    {
        if($request->ajax()){

            if(!empty($request->module_name)){
                $this->model->setModuleName($request->module_name);
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
                $row[]  = '<i class="'.$value->module_icon.'"></i> '.$value->module_name;
                $row[]  = $value->module_link;
                $row[]  = $value->module_icon;
                $row[]  = $this->model->parent_name($value->parent_id);
                $row[]  = $value->module_sequence;
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

            if($request->module_link != 'javascript:void(0);'){
                
                if(empty($request->update_id)){
                    $rules['module_link'][2]  = 'unique:modules,module_link';
                }else{
                    $rules['module_link'][2]  = 'unique:modules,module_link,'.$request->update_id;
                }
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

    public function edit(Request $request){
        if($request->ajax()){
            $result = $this->model->find($request->id);
            if($result){
                $output['module'] = $result;
            }else{
                $output = $this->error_status();
            }
            return response()->json($output);
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            $result = $this->model->find($request->id)->delete();
            if($result){
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

    public function parent_module_list(Request $request){
        $modules =  $this->model->orderByRaw('-module_sequence DESC') //sequence according to module sequence number in desc order
            ->get()
            ->nest()
            ->setIndent('–– ') //append before child module
            ->listsFlattened('module_name'); //name that will show in frontend

        $output = '<option value="">Select Please</option>';
        foreach ($modules as $key => $value) {
            $output .= "<option value='$key'>$value</option>";
        }
        return $output;
    }
}
