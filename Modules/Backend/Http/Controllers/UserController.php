<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Mail\NewRegistration;
use App\Model\User;
use App\Model\Role;
use Validator;
use App\Traits\UploadAble;
use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseController
{
    use UploadAble;
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        if (permission('user-manage')) {
            $this->setPageData('User','User','fas fa-users');
            $data['roles'] = Role::allRoles();
            return view('backend::user.index',compact('data'));
        } else {
            return $this->access_blocked();
        }
        
        
    }

    public function getList(Request $request)
    {
        if($request->ajax()){
            if (permission('user-manage')) {
                if(!empty($request->name)){
                    $this->model->setName($request->name);
                }
                if(!empty($request->email)){
                    $this->model->setEmail($request->email);
                }
                if(!empty($request->role_id)){
                    $this->model->setRoleID($request->role_id);
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
                    if (permission('user-edit')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link edit_data" data-id="' . $value->id . '" >'.EDIT_ICON.'</a></li>';
                    }
                    if (permission('user-view')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link view_data" data-id="' . $value->id . '" >'.VIEW_ICON.'</a></li>';
                    }
                    if (permission('user-delete')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link delete_data" data-id="'.$value->id .'" >'.DELETE_ICON.'</a></li>';
                    }
                    if (permission('user-password-change')) {
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link change_password_data" data-id="'.$value->id .'" data-name="'.$value->name.'">'.PASSWORD_ICON.'</a></li>';
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
                    if (permission('user-bulk-action-delete')) {
                    $row[]  = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid"><input type="checkbox" name="did[]" value="' . $value->id . '" class="select_data select_item_' . $value->id . '" onchange="select_single_item(' . $value->id . ')">&nbsp;<span></span></label> ';
                    }
                    $row[]  = $no;
                    $row[]  = self::avatar($value->avatar,$value->name);
                    $row[]  = $value->name;
                    $row[]  = $value->role->role;
                    $row[]  = $value->email;
                    $row[]  = BUTTON_STATUS[$value->status];
                    $row[]  = $btngroup;
                    $data[] = $row;
        
                }
                $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
                echo json_encode($output);
            }
        }
    }

    private static function avatar(string $image = null, string $name){
        return !empty($image) ? "<img src='storage/".USER.$image."' alt='".$name."' style='width:50px;'/>" : "<img src='svg/add.svg' alt='".$name."' style='width:50px;'/>";
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            if (permission('user-add') || permission('user-edit')) {
                $rules = $this->model::VALIDATION_RULES;
                $message = $this->model::MESSAGE;
                if(!empty($request->update_id)){
                    $rules['email'][2]  = 'unique:users,email,'.$request->update_id;
                }else{
                    $rules['password'] = ['required','confirmed', new StrongPassword];
                    $rules['password_confirmation'] = ['required']; 
                }
                $validator = Validator::make($request->all(), $rules, $message);
                if ($validator->fails()) {
                    $output = array(
                        'errors' => $validator->errors()
                    );
                } else {
                    
                    $collection = collect($request->all())->only(['role_id','name','email',
                    'password','status']);
                    $avatar = $request->old_avatar;
                    if($request->hasFile('avatar')){
                        $avatar = $this->upload_file($request->file('avatar'),USER);
                        if(!empty($request->old_avatar)){
                            $this->delete_file($request->old_avatar, USER);
                        }
                    }
                    $created_at = $updated_at = DATETIME;
                    $collection = $collection->merge(compact('avatar','updated_at'));
                    if(empty($request->update_id)){
                        $collection = $collection->merge(compact('created_at'));
                    }
                    $result = $this->model->updateOrCreate(['id' => $request->update_id],$collection->all());
                    if($result){
                        if(empty($request->update_id)){
                            Mail::to($request->email)->send(new NewRegistration($collection->all()));
                            if(!Mail::failures()){
                                $output = ['status'=>'success','message'=>'A login link sent to this user with account credentials.'];
                            }else{
                                $output = $this->success_status();
                            }
                        }else{
                            $output = $this->success_status();
                        }
                        
                    }else{
                        if($request->hasFile('avatar')){
                            if($avatar != $request->old_avatar){
                                $this->delete_file($avatar, USER);
                            }
                        }
                        $output = $this->error_status();
                    }
                }
                return response()->json($output);
            }
        }
    }

    public function show(Request $request){
        if($request->ajax()){
            if (permission('user-view')) {
                $user = $this->model->with('role:id,role')->find($request->id);
                if($user){
                    $output['user'] = view('backend::user.details',compact('user'))->render();
                    $output['name'] = $user->name;
                }else{
                    $output = $this->error_status();
                }
                return response()->json($output);
            }
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            if (permission('user-edit')) {
                $result = $this->model->with('role:id,role')->find($request->id);
                if($result){
                    $output['user'] = $result;
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
            if (permission('user-delete')) {
                $result = $this->model->find($request->id);
                if($result->avatar){
                    $this->delete_file($request->avatar, USER);
                }
                if($result->delete()){
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
            if (permission('user-bulk-action-delete')) {
                try {
                    $products = $this->model->toBase()->select('avatar')->whereIn('id',$request->id)->get();
                    $result = $this->model->destroy($request->id);
                    if($result){
                        if(!empty($products)){
                            foreach ($products as $product) {                   
                                if($product->avatar != null)
                                {
                                    $this->delete_file($product->avatar,USER);    
                                }
                            }
                        }
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

    public function change_password(Request $request)
    {
        if ($request->ajax()) {
            if (permission('user-password-change')) {
                if(!empty($request->update_id)){
                    $rules['password']              = ['required','confirmed', new StrongPassword];
                    $rules['password_confirmation'] = 'required'; 
                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        $output = array(
                            'errors' => $validator->errors()
                        );
                    } else {

                        $result  = $this->model->find((int)$request->update_id)->update(['password'=>$request->password]);
                        
                        if ($result) {
                            $output['status']  = 'success';
                            $output['message'] = 'Password has been updated successfully';
                        }else{
                            $output['status']   = 'danger';
                            $output['message']  = 'Password can not update';
                        }
                    }
                }else{
                    $output['status']   = 'danger';
                    $output['message']  = 'Password can not update';
                }
                return response()->json($output);
            }
        }
    }
}
