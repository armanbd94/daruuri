<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Modules\Backend\Entities\Module;
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
        }

        if($user->role_id == 1){
            $permitted_modules = Module::doesntHave('parent')
            ->select('id','module_name','module_link','module_icon','module_sequence')
            ->orderBy('module_sequence','asc')
            ->with('children:id,parent_id,module_name,module_link,module_icon,module_sequence')
            ->get();
        }else{
            //
        }
        if(!$permitted_modules->isEmpty()){
            Session::put('permitted_modules',$permitted_modules);
        }
        
    }
}
