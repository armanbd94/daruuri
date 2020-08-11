<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Model\Role;
use Modules\Backend\Entities\Method;
use Modules\Backend\Entities\Module;
use Modules\Backend\Entities\RoleMethodPermission;
use Modules\Backend\Entities\RoleModulePermission;
use Validator;
class RoleController extends BaseController
{

    protected $permission_reserved_keywords = [
        'List','Manage','Access','Add','Edit','View','Delete','Bulk Action Delete',
        'Report','Status Change','Password Change','Permission',
        'General','SMTP','SMS','API','Change Status','Print',
    ];

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }


    public function index()
    {
        if (permission('role-manage')) {
            $this->setPageData('Role', 'Role', 'fas fa-user-cog');
            return view('backend::setting.role.index');
        } else {
            return $this->access_blocked();
        }
        
        
    }

    public function getList(Request $request)
    {
        if($request->ajax()){

            if (permission('role-manage')) {
                if(!empty($request->role)){
                    $this->model->setRoleName($request->role);
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
                    if (permission('role-edit')) {
                    $action .= '<li class="kt-nav__item"><a href="'.route("admin.role.edit",["role" => $value->id]).'" class="kt-nav__link">'.EDIT_ICON.'</a></li>';
                    }
                    if (permission('role-view')) {
                    $action .= '<li class="kt-nav__item"><a href="'.route("admin.role.show",["role" => $value->id]).'" class="kt-nav__link" >'.VIEW_ICON.'</a></li>';
                    }
                    if (permission('role-delete')) {
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
                    if (permission('role-bulk-action-delete')) {
                    $row[]  = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid"><input type="checkbox" name="did[]" value="' . $value->id . '" class="select_data select_item_' . $value->id . '" onchange="select_single_item(' . $value->id . ')">&nbsp;<span></span></label> ';
                    }
                    $row[]  = $no;
                    $row[]  = $value->role;
                    $row[]  = $btngroup;
                    $data[] = $row;
        
                }
                $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
                echo json_encode($output);
            }
        }
    }


    public function create()
    {
        if (permission('role-add')) {
            $this->setPageData('Create Role', 'Create Role', 'fas fa-plus-square');
            $permissions = Module::doesntHave('parent')
            ->select('id','module_name','module_sequence')
            ->orderBy('module_sequence','asc')
            ->with('method:id,module_id,method_name','submenu:id,parent_id,module_name')
            ->get();

            $keywords = $this->permission_reserved_keywords;
            return view('backend::setting.role.create',compact('permissions','keywords'));
        }else{
            return redirect()->route('admin.role')->with(['status'=>'error','message'=>'Unauthorized Access Blocked']);
        }
    }


    public function store(Request $request)
    {
        if($request->ajax()){
            if (permission('role-add') || permission('role-edit')) {
                $rules   = $this->model::VALIDATION_RULES;
                if(!empty($request->update_id)){
                    $rules['role'][2] = 'unique:roles,role,'.$request->update_id;
                }
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $output = array(
                        'errors' => $validator->errors()
                    );
                } else {
                    $collection = collect($request->all())->only('role');
                    $result = $this->model->updateOrCreate(['id' => $request->update_id],$collection->all());
                    if($result){
                        $role = $this->model->with(['roleModulePermission','roleMethodPermission'])->find($result->id);
                        $role->roleModulePermission()->sync($request->module);
                        // $role_method = $this->model->with('roleMethodPermission')->find($result->id);
                        $role->roleMethodPermission()->sync($request->method);
                        $output = $this->success_status();
                    }else{
                        $output = $this->error_status();
                    }
                }
                return response()->json($output);
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Role $role)
    {
        if (permission('role-view')) {
            $this->setPageData('Role Details', 'Role Details', 'fas fa-eye');
            $permissions = Module::doesntHave('parent')
            ->select('id','module_name','module_sequence')
            ->orderBy('module_sequence','asc')
            ->with('method:id,module_id,method_name','submenu:id,parent_id,module_name')
            ->get();
            $role_modules = [];
            foreach ($role->roleModulePermission as  $value) {
                array_push($role_modules,$value->id);
            }
            $role_methods = [];
            foreach ($role->roleMethodPermission as  $value) {
                array_push($role_methods,$value->id);
            }
            $keywords = $this->permission_reserved_keywords;
            return view('backend::setting.role.view',compact('role','permissions','keywords','role_modules','role_methods'));
        }else{
            return redirect()->route('admin.role')->with(['status'=>'error','message'=>'Unauthorized Access Blocked']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Role $role)
    {
        if (permission('role-edit')) {
            $this->setPageData('Edit Role', 'Edit Role', 'fas fa-plus-square');
            $permissions = Module::doesntHave('parent')
            ->select('id','module_name','module_sequence')
            ->orderBy('module_sequence','asc')
            ->with('method:id,module_id,method_name','submenu:id,parent_id,module_name')
            ->get();
            $role_modules = [];
            foreach ($role->roleModulePermission as  $value) {
                array_push($role_modules,$value->id);
            }
            $role_methods = [];
            foreach ($role->roleMethodPermission as  $value) {
                array_push($role_methods,$value->id);
            }
            $keywords = $this->permission_reserved_keywords;
            return view('backend::setting.role.edit',compact('role','permissions','keywords','role_modules','role_methods'));
        }else{
            return redirect()->route('admin.role')->with(['status'=>'error','message'=>'Unauthorized Access Blocked']);
        }
    }

    
    public function destroy(Request $request)
    {
        if($request->ajax()){
            if(permission('role-delete')){
                $role = $this->model->with(['roleModulePermission','roleMethodPermission'])->find($request->id);
                if($role){
                    $delete_role_modules = $role->roleModulePermission()->detach();
                    $delete_role_methods = $role->roleMethodPermission()->detach();
                    if($delete_role_modules && $delete_role_methods){
                        $role->delete();
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
    }

    public function bulk_action_delete(Request $request)
    {
        if($request->ajax()){
            if(permission('role-bulk-action-delete')){
                try {
                    
                    $delete_role_methods = RoleMethodPermission::whereIn('role_id',$request->id)->delete();
                    $delete_role_modules = RoleModulePermission::whereIn('role_id',$request->id)->delete(); 
                    if($delete_role_modules && $delete_role_methods){
                        $result = $this->model->destroy($request->id);
                        if($result){
                            $output = $this->success_status();
                        }else{
                            $output = $this->error_status();
                        }
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
