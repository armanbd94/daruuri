<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Faq;
use Validator;
class FaqsController extends BaseController
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $this->setPageData('Faqs','Faqs','fas fa-question-circle');
        return view('backend::faqs.index');
    }

    public function getList(Request $request)
    {
        if($request->ajax()){

            if(!empty($request->question)){
                $this->model->setQuestion($request->question);
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
                $row[]  = $value->question;
                $row[]  = self::readMore($value->answer, $limit = 250);
                $row[]  = $value->sorting;
                $row[]  = $btngroup;
                $data[] = $row;
    
            }
            $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
            echo json_encode($output);
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
            $rules = $this->model::VALIDATION_RULES;
            if(!empty($request->update_id)){
                $rules['question'][2] = 'unique:faqs,question,'.$request->update_id;
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $output = array(
                    'errors' => $validator->errors()
                );
            } else {
                $collection = collect($request->all())->only(['question','answer','sorting']);
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
                $output['faqs'] = $result;
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
                $this->model->flushCache();
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
