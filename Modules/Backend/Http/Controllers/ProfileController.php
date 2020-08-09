<?php

namespace Modules\Backend\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Model\User;
use App\Rules\StrongPassword;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    use UploadAble;
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $this->setPageData('Profile', 'Profile', 'fas fa-user');
        return view('backend::profile.index');
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => ['required','string'],
            'avatar' => ['nullable','image','mimes:svg,png,jpg,jpeg'],
        ]);
        $avatar = $request->old_avatar;
        if($request->hasFile('avatar')){
            $avatar = $this->upload_file($request->file('avatar'),USER);
            if(!empty($request->old_avatar)){
                $this->delete_file($request->old_avatar, USER);
            }
        }
        $result = $this->model->find(Auth::user()->id)->update(array('name' => $request->name,'avatar'=>$avatar));
        if($result){

            session()->flash('success', 'Profile data updated successfully');
            return redirect('admin/profile');
        }else{
            if($request->hasFile('avatar')){
                if($avatar != $request->old_avatar){
                    $this->delete_file($avatar, USER);
                }
            }
            session()->flash('error', 'Profile data cannot update');
            return redirect('admin/profile');
        }
    }
    public function change_password(Request $request)
    {
        $this->validate($request, [

            'old_password' => ['required'],
            'password' => ['required', 'confirmed', new StrongPassword],
            'password_confirmation' => ['required'],
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {

            if (!Hash::check($request->password, $hashedPassword)) {

                $result = $this->model->find(Auth::user()->id)->update(array('password' => $request->password));
                if($result){
                    session()->flash('success', 'password updated successfully');
                    return redirect('admin/profile')->with('active','password_tab');
                }else{
                    session()->flash('error', 'password cannot update');
                    return redirect('admin/profile')->with('active','password_tab');
                }
                
            } else {
                session()->flash('error', 'New password can not be the old password!');
                return redirect('admin/profile')->with('active','password_tab');
            }

        } else {
            session()->flash('error', 'Old password doesnt matched ');
            return redirect('admin/profile')->with('active','password_tab');
        }
    }

}
