<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Auth\UserVerify;
use App\Models\Auth\AuthorizedUsers;


class AuthController extends Controller
{
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = AuthorizedUsers::where('id', $verifyUser->user_id)->first();
              
            if(!$user->is_email_verified) {
                $user->is_email_verified = 1;
                $user->update();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('Auth.Forms')->with('message', $message);
    }
}
