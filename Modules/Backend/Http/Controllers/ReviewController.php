<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Review;

class ReviewController extends BaseController
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        if (permission('customer-feedback-access')) {
            $this->setPageData('Customer Feedback','Customer Feedback','fas fa-comment-dots');
            return view('backend::feedback.index');
        } else {
            return $this->access_blocked();
        }
    }

    public function getList(Request $request)
    {
        if($request->ajax()){
            if (permission('customer-feedback-access')) {
                if(!empty($request->from_date)){
                    $this->model->setFromDate($request->from_date);
                }
                if(!empty($request->to_date)){
                    $this->model->setToDate($request->to_date);
                }
                if(!empty($request->daruuri_rating)){
                    $this->model->setDaruuriRating($request->daruuri_rating);
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
                    if (permission('customer-feedback-view')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link view_data" data-id="' . $value->id . '" >'.VIEW_ICON.'</a></li>';
                    }
                    if (permission('customer-feedback-delete')) {
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
                    if (permission('customer-feedback-bulk-action-delete')) {
                    $row[]  = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid"><input type="checkbox" name="did[]" value="' . $value->id . '" class="select_data select_item_' . $value->id . '" onchange="select_single_item(' . $value->id . ')">&nbsp;<span></span></label> ';
                    }
                    $row[]  = $no;
                    $row[]  = $value->name;
                    $row[]  = $value->phone_no;
                    $row[]  = $value->email;
                    $row[]  = $value->daruuri_rating;
                    $row[]  = $value->communication_rating;
                    $row[]  = $value->stuff_rating;
                    $row[]  = $value->service_rating;
                    $row[]  = $value->referal_rating;
                    $row[]  = read_more($value->description,100);
                    $row[]  = date('d-M-Y',strtotime($value->created_at));
                    $row[]  = $btngroup;
                    $data[] = $row;
        
                }
                $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
                echo json_encode($output);
            }
        }
    }

    public function show(Request $request){
        if($request->ajax()){
            if(permission('phone-view')){
                $feedback = $this->model->find($request->id);
                if($feedback){
                    $output['feedback'] = view('backend::feedback.details',compact('feedback'))->render();
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
            if (permission('customer-feedback-delete')) {
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
            if (permission('customer-feedback-bulk-action-delete')) {
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
