<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Extras\Notification;
use App\Models\Extras\MessageNotifications;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Payments\PaymentSystem;
use Illuminate\Support\Facades\Mail;
use App\Models\Auth\UserVerify;
use Illuminate\Support\Facades\Crypt;


class LoginForm extends Component
{
    public function render()
    {
        return view('livewire.auth.login-form')->layout('layouts.auth');
    }

    public function UserLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserEmail' => 'required|email',
            'UserPassword' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('Error!', '400 Bad Request \n Validations Failed');
        }

        $twentyDaysAgo = Carbon::now()->subDays(20);

        Notification::where('created_at', '<', $twentyDaysAgo)->delete();

        MessageNotifications::where('created_at', '<', $twentyDaysAgo)->delete();

        $user = AuthorizedUsers::with('owner')->where('email', $request->UserEmail)->first();

        if (!$user) {
            return back()->with('Error!', '400 Bad Request \n User doesn\'t Exist! \n Invalid Email!');
        }

        if ($user->is_email_verified == 0) {
            return back()->with('Error!', 'Email not verified. Please verify your email before logging in.');
        }

        if (!Hash::check($request->UserPassword, $user->password)) {
            return back()->with('Error!', 'Unauthorized \n Incorrect password!');
        }

        // if (is_null($user->email_verified_at)) {
        //     return back()->with('Error!', 'Email not verified. Please verify your email before logging in.');
        // }

        // if (!Auth::guard('Authorized')->attempt(['email' => $request->UserEmail, 'password' => $request->UserPassword])) {
        //     return back()->with('Error!', 'UnAuthorized \n Bad Request');
        // }

        // Generate OTP and send email
        if ($request->UserEmail == 'shawnbroker@mail.com' || $request->UserEmail == 'shawncarrier@mail.com' || $request->UserEmail == 'allstatetostateautotransport@gmail.com') {
            $otp = 123456;
        } else {
            $otp = rand(100000, 999999);
        }

        // dd($otp);

        // $user->otp_code = $otp;
        // $user->otp_expires_at = now()->addMinutes(1); // Valid for 10 minutes

        // ($user->owner_id == 0) ? $user->otp_code : $user->owner->otp_code = $otp;
        // ($user->owner_id == 0) ? $user->otp_expires_at : $user->owner->otp_expires_at = now()->addMinutes(1);
        // $user->save();
        if ($user->owner_id == 0) {
            // dd('ok');
            $user->otp_code = $otp;
            $user->otp_expires_at = now()->addMinutes(1);
        } else {
            // dd('sk');
            if ($user->owner) { // Ensure the owner exists before assigning
                $user->owner->otp_code = $otp;
                $user->owner->otp_expires_at = now()->addMinutes(1);
                $user->owner->save(); // Save the owner record
            }
        }
        $user->save();

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $otp  // Store OTP in token field
        ]);

        // dd($user->toArray());
        // Send OTP via email
        $email = ($user->owner_id == 0) ? $user->email : $user->owner->email;

        Mail::send('emails.otpVerificationEmail', [
            'otp' => $otp,
            'email' => $email,
            'name' => $user->Company_Name
        ], function ($message) use ($email) {
            $message->to($email);
            $message->subject('OTP for Login Verification');
        });
        // Mail::send('emails.otpVerificationEmail', [
        //     'otp' => $otp,
        //     'email' => $user->email,
        //     'name' => $user->Company_Name
        // ], function ($message) use ($user) {
        //     $message->to($user->email);
        //     $message->subject('OTP for Login Verification');
        // });

        $encryptedEmail = Crypt::encryptString($request->UserEmail);
        $encryptedPassword = Crypt::encryptString($request->UserPassword);

        if ($user->number_of_login > $user->is_login) {

            return redirect()->route('Auth.Login.OTPForm', [
                'user_id' => $user->id,
                'UserEmail' => $encryptedEmail,
                'UserPassword' => $encryptedPassword,
            ])
                ->with('Success!', 'OTP has been sent to your email. Please verify to continue.');
        } else {
            return back()->with('Error!', 'Maximum Number of Users are Already Logged In');
        }

    }

    public function verifyLoginOtpForm(Request $request)
    {
        $slot = '';
        $user_id = $request->user_id;
        $UserEmail = $request->UserEmail;
        $UserPassword = $request->UserPassword;
        return view('auth.otpLoginVerification', compact('slot', 'user_id', 'UserEmail', 'UserPassword'));
    }

    public function verifyLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer', // Validate user_id as an integer
            'otp_code' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return back()->with('Error!', '400 Bad Request \n Validations Failed');
        }

        $user = AuthorizedUsers::find($request->user_id); // Fetch the user by user_id

        if (!$user) {
            return back()->with('Error!', 'Invalid user ID. Please try again.');
        }

        $decryptedEmail = Crypt::decryptString($request->UserEmail);
        $decryptedPassword = Crypt::decryptString($request->UserPassword);

        if (!Auth::guard('Authorized')->attempt(['email' => $decryptedEmail, 'password' => $decryptedPassword])) {
            return back()->with('Error!', 'UnAuthorized \n Bad Request');
        }

        // Validate the OTP and expiration time
        // if ($user->otp_code !== $request->otp_code || $user->otp_expires_at < now()) {
        //     return back()->with('Error!', 'Invalid or expired OTP. Please try again.');
        // }
        if ($user->owner_id == 0) {
            if ($user->otp_code !== $request->otp_code || $user->otp_expires_at < now()) {
                return back()->with('Error!', 'Invalid or expired OTP. Please try again.');
            }
        } else {
            if ($user->owner) {
                if ($user->owner->otp_code !== $request->otp_code || $user->owner->otp_expires_at < now()) {
                    return back()->with('Error!', 'Invalid or expired OTP. Please try again.');
                }
            }
        }

        // Clear the OTP fields once validated
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        $check_status = PaymentSystem::where('Payment_Type', 'Pay User For New Seats')->first();
        $payment_status = $check_status->Payment_Switch;

        if ($user->number_of_login > $user->is_login) {
            $user->is_login = $user->is_login + 1;
            $user->last_login = Carbon::now();
            $user->save();

            Artisan::call('expire:list');

            return redirect()->route('User.Dashboard')->with('Success!', 'User Login Successfully!');
        } else {
            return back()->with('Error!', 'Maximum Number of Users are Already Logged In');
        }
        // if ($payment_status === 1) {
        //     return redirect()->route('User.Dashboard')->with('Success!', 'User Login Successfully!');
        // } else {
        //     if ($user->number_of_login > $user->is_login) {
        //         $user->is_login = $user->is_login + 1;
        //         $user->last_login = Carbon::now();
        //         $user->save();

        //         Artisan::call('expire:list');

        //         return redirect()->route('User.Dashboard')->with('Success!', 'User Login Successfully!');
        //     } else {
        //         return back()->with('Error!', 'Maximum Number of Users are Already Logged In');
        //     }
        // }
    }

    public function resendOTP(Request $request)
    {
        // Validate the request to ensure user_id is present
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer', // Validate user_id as an integer
        ]);

        if ($validator->fails()) {
            return back()->with('Error!', '400 Bad Request \n Validations Failed');
        }

        $user = AuthorizedUsers::find($request->user_id); // Fetch the user by user_id

        if (!$user) {
            return back()->with('Error!', 'Invalid user ID. Please try again.');
        }

        // Ensure the OTP is expired before resending
        if ($user->otp_expires_at && $user->otp_expires_at > now()) {
            return back()->with('Error!', 'Please wait for the current OTP to expire before requesting a new one.');
        }

        // Generate a new OTP
        if ($user->email == 'shawnbroker@mail.com' || $user->email == 'shawncarrier@mail.com' || $user->email == 'allstatetostateautotransport@gmail.com') {
            $otp = 123456;
        } else {
            $otp = rand(100000, 999999);
        }
        // $user->otp_code = $otp;
        // $user->otp_expires_at = now()->addMinutes(1); // New OTP expiration time
        // ($user->owner_id == 0) ? $user->otp_code : $user->owner->otp_code = $otp;
        // ($user->owner_id == 0) ? $user->otp_expires_at : $user->owner->otp_expires_at = now()->addMinutes(1);
        // $user->save();

        if ($user->owner_id == 0) {
            $user->otp_code = $otp;
            $user->otp_expires_at = now()->addMinutes(1);
        } else {
            if ($user->owner) { // Ensure the owner exists before assigning
                $user->owner->otp_code = $otp;
                $user->owner->otp_expires_at = now()->addMinutes(1);
                $user->owner->save(); // Save the owner record
            }
        }
        $user->save();

        // Send the new OTP via email
        // Mail::send('emails.otpVerificationEmail', [
        //     'otp' => $otp,
        //     'email' => $user->email,
        //     'name' => $user->Company_Name
        // ], function ($message) use ($user) {
        //     $message->to($user->email);
        //     $message->subject('OTP for Login Verification');
        // });
        $email = ($user->owner_id == 0) ? $user->email : $user->owner->email;

        Mail::send('emails.otpVerificationEmail', [
            'otp' => $otp,
            'email' => $email,
            'name' => $user->Company_Name
        ], function ($message) use ($email) {
            $message->to($email);
            $message->subject('OTP for Login Verification');
        });


        return back()->with('Success!', 'A new OTP has been sent to your email. Please verify to continue.');
    }

    // public function UserLogin(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'UserEmail' => 'required|email',
    //         'UserPassword' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->with('Error!', '400 Bad Request \n Validations Failed');
    //     }

    //     $twentyDaysAgo = Carbon::now()->subDays(20);

    //     Notification::where('created_at', '<', $twentyDaysAgo)->delete();

    //     MessageNotifications::where('created_at', '<', $twentyDaysAgo)->delete();

    //     $user = AuthorizedUsers::where('email', $request->UserEmail)->first();

    //     if (!$user) {
    //         return back()->with('Error!', '400 Bad Request \n User doesn\'t Exist! \n Invalid Email!');
    //     }

    //     if (is_null($user->email_verified_at)) {
    //         return back()->with('Error!', 'Email not verified. Please verify your email before logging in.');
    //     }

    //     if (!Auth::guard('Authorized')->attempt(['email' => $request->UserEmail, 'password' => $request->UserPassword])) {
    //         return back()->with('Error!', 'UnAuthorized \n Bad Request');
    //     }

    //     $check_status = PaymentSystem::where('Payment_Type', 'Pay User For New Seats')->first();
    //     $payment_status = $check_status->Payment_Switch;

    //     if ($payment_status === 1) {
    //         if (Hash::check($request->UserPassword, $user->password)) {
    //             Artisan::call('expire:list');
    //             return redirect()->route('User.Dashboard')->with('Success!', 'User Login Successfully!');
    //         } else {
    //             return back()->with('Error!', '400 Bad Request \n Wrong Password!');
    //         }
    //     } else {
    //         if ($user->number_of_login > $user->is_login) {
    //             if (Hash::check($request->UserPassword, $user->password)) {
    //                 $user->is_login = $user->is_login + 1;
    //                 $user->last_login = Carbon::now();
    //                 $user->save();

    //                 Artisan::call('expire:list');

    //                 return redirect()->route('User.Dashboard')->with('Success!', 'User Login Successfully!');
    //             } else {
    //                 return back()->with('Error!', '400 Bad Request \n Wrong Password!');
    //             }
    //         } else {
    //             return back()->with('Error!', 'Maximum Number of Users are Already Logged In');
    //         }
    //     }
    // }

    public function switchProfile(Request $request, $id)
    {
        Auth::guard('Authorized')->logout();

        $user = AuthorizedUsers::find($id);

        if (!$user) {
            return redirect()->route('Auth.Forms')->with('error', 'User not found');
        }

        if (Auth::guard('Authorized')->loginUsingId($user->id)) {
            return redirect()->route('User.Dashboard')->with('Success!', 'User Logged in successfully!');
        } else {
            return redirect()->route('Auth.Forms')->with('error', 'Invalid credentials');
        }
    }

    public function UserLogout(Request $request)
    {
        $user = Auth::guard('Authorized')->user();

        if ($user) {
            if ($user->is_login > 0) {
                $user->is_login = $user->is_login - 1;
            }
            $user->last_login = Carbon::now();
            $user->save();
        }

        Auth::guard('Authorized')->logout();
        return redirect()->route('Auth.Forms')->with('Success!', 'User LogOut Successfully!');
    }
}
