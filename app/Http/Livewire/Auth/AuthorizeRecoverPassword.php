<?php

namespace App\Http\Livewire\Auth;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AuthorizeRecoverPassword extends Component
{
    public function render(Request $request)
    {
        $token = $request->token;
        return view('livewire.auth.authorize-recover-password', compact('token'))->layout('layouts.auth');
    }

    public function submitResetPasswordForm(Request $request): Redirector|Application|RedirectResponse
    {
//        dd($request->all());
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('Error!', 'Invalid token!');
        }

        AuthorizedUsers::where('email', $updatePassword->email)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        DB::table('password_resets')
            ->where([
                'token' => $request->token
            ])->delete();

        return redirect()->route('Auth.Forms')->with('Success!', 'Your password has been changed!');
    }
}
