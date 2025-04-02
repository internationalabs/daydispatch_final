<?php

namespace App\Http\Livewire\Auth;

use App\Models\Auth\AuthorizedAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AgentLoginForm extends Component
{
    public function render()
    {
        return view('livewire.auth.agent-login-form')->layout('layouts.auth-agent');
    }

    //  ======== Agent Login Function ==============
    public function AgentLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserEmail' => 'required|email',
            'UserPassword' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('Error!', '400 Bad Request \n Validations Failed');
        }

        if (!Auth::guard('Agent')->attempt(['email' => $request->UserEmail, 'password' => $request->UserPassword])) {
            return back()->with('Error!', 'UnAuthorized \n Bad Request');
        }

        $user = AuthorizedAgent::where('email', $request->UserEmail)->first();

        if ($user) {
            if (Hash::check($request->UserPassword, $user->password)) {
                return redirect()->route('Agent.Dashboard')->with('Success!', 'Agent Login Successfully!');
            }
            return back()->with('Error!', '400 Bad Request \n Wrong Password!');
        }
        return back()->with('Error!', '400 Bad Request \n User does\'nt Exist! \n Invalid Email!');
    }

    public function AgentLogout(Request $request)
    {
        Auth::guard('Agent')->logout();
        return redirect()->route('Auth.Agent.Forms')->with('Success!', 'Agent LogOut Successfully!');
    }
}
