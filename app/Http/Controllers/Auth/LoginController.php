<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Modules\Backend\Entities\Module;
use Modules\Backend\Entities\Method;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private $permitted_modules;
    private $permitted_methods;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->status != 1){
            $this->guard()->logout();
            return back()->with('error', 'You account is disabled. Please contact with admin to enable account.');
        }else{
            $role_id = auth()->user()->role_id;

            /* 
            * *get module list
            */
            $menus = Module::doesntHave('parent')
                ->orderBy('module_sequence','asc')
                ->with('children');

            /*
            * *get method list* *
            */
            $methods = Method::select('method_slug');

            /* 
            * ! if not super admin then permission wise modules and methods data fetched !
            */
            if($role_id != 1){    
                $menus->whereHas('roleModulePermission', function($q) use ($role_id){
                    $q->where('role_id',$role_id);
                });

                $methods->whereHas('roleMethodPermission', function($q) use ($role_id){
                    $q->where('role_id',$role_id);
                });
            }
            $this->permitted_modules = $menus->get(); //permitted module list
            
            $this->permitted_methods = $methods->get(); //permitted method list

            if(!$this->permitted_modules->isEmpty()){
                Session::put('permitted_modules',$this->permitted_modules); //permitted modules putted into session
            }
            $permissions = [];
            if(!$this->permitted_methods->isEmpty()){
                foreach ($this->permitted_methods as $value) {
                    array_push($permissions,$value->method_slug);
                }
                Session::put('permissions',$permissions); //permitted methods putted into session
            }

        }  
    }
}
