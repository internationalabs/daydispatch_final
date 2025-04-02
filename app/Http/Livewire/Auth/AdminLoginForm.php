<?php

namespace App\Http\Livewire\Auth;

use App\Models\Auth\AuthorizedAdmin;
use App\Models\Ip;
use App\Models\LastActivity;
use Session;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginForm extends Component
{
    public function render()
    {
        return view('livewire.auth.admin-login-form')->layout('layouts.auth-admin');
    }

    //  ======== Admin Login Function ==============
    public function AdminLogin(Request $request)
    {
        // $ip = Ip::where('ip_address',$request->ip())->where('status', 1)->first();
        
        // if(isset($ip->id))
        // {
            $validator = Validator::make($request->all(), [
                        'UserEmail' => 'required|email',
                        'UserPassword' => 'required'
                    ]);
    
            if ($validator->fails()) {
                return back()->with('Error!', '400 Bad Request \n Validations Failed');
            }
    
            if (!Auth::guard('Admin')->attempt(['email' => $request->UserEmail, 'password' => $request->UserPassword])) {
                return back()->with('Error!', 'UnAuthorized \n Bad Request');
            }
    
            $user = AuthorizedAdmin::where('email', $request->UserEmail)->first();
    
            if ($user) {
                if (Hash::check($request->UserPassword, $user->password)) {
                    $this->lastAct($request->ip(),($user->name),'Login');
                    return redirect()->route('Admin.Dashboard')->with('Success!', 'Admin Login Successfully!');
                }
                return back()->with('Error!', '400 Bad Request \n Wrong Password!');
            }
            return back()->with('Error!', '400 Bad Request \n User does\'nt Exist! \n Invalid Email!');
        // }
        // else
        // {
        //     Session::flash('flash_message', 'No Ip matched!');
        //     return redirect()->back();
        // }
    }

    public function AdminLogout(Request $request)
    {
        $this->lastAct($request->ip(),(Auth::guard('Admin')->user()->name),'Logout');
        Auth::guard('Admin')->logout();
        return redirect()->route('Auth.Admin.Forms')->with('Success!', 'Admin LogOut Successfully!');
    }
    
    public function lastAct($ip,$name,$activity)
    {
        $data = new LastActivity;
        $data->name = $name;
        $data->ip = $ip;
        $data->location = 'location';
        $data->activity = $activity;
        $data->save();
        
        return $data;
    }
}
