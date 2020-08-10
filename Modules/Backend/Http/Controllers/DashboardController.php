<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Method;
use Modules\Backend\Entities\Module;
use Modules\Backend\Entities\RoleModulePermission;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // $menus = Module::doesntHave('parent')
            // ->select('id','module_name','module_link','module_icon','module_sequence')
            // ->orderBy('module_sequence','asc')
            // ->with('children:id,parent_id,module_name,module_link,module_icon,module_sequence')
            // ->get();
        // $role_id = auth()->user()->role_id;
        // $menus = Module::doesntHave('parent')
        //     ->orderBy('module_sequence','asc')
        //     ->with('children');
        // if($role_id != 1){    
        //     $menus->whereHas('roleModulePermission', function($q) use ($role_id){
        //         $q->where('role_id',$role_id);
        //     });
        // }
        // $menus = $menus->get();
        // dd($menus->toArray());

        // $method = Method::select('method_slug');
        // if($role_id != 1){    
        //     $method->whereHas('roleMethodPermission', function($q) use ($role_id){
        //             $q->where('role_id',$role_id);
        //         });
        //     }
        //     dd(collect($method->get()));
        view()->share(['page_title' => 'Dashboard', 'sub_title' => 'Dashboard', 'page_icon' => 'fas fa-home']);
        return view('backend::home');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function unauthorized()
    {
        view()->share(['page_title' => 'Unauthorized', 'sub_title' => 'Unauthorized Access Blocked', 'page_icon' => 'fas fa-ban']);
        return view('backend::unauthorized');
    }

    
}
