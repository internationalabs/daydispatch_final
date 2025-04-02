<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class AuthorizedForgotPassword extends Component
{
    public function render()
    {
        return view('livewire.auth.authorized-forgot-password')->layout('layouts.auth');
    }

    public function submitForgetPasswordForm(Request $request): RedirectResponse
    {
//dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:authorized_users',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forget-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('Success!', 'We have e-mailed your password reset link!');
    }
}
