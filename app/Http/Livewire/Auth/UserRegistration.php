<?php

namespace App\Http\Livewire\Auth;

use App\Models\Settings\UserRolesList;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Auth\UserVerify;
use App\Models\Profile\UserCertificates;
use App\Models\Profile\UserInsurrance;
use App\Models\UserSetting;

class UserRegistration extends Component
{
    public function render()
    {
        $User_Roles = UserRolesList::orderBy('id', 'ASC')->get();
        return view('livewire.auth.user-registration', compact('User_Roles'))->layout('layouts.auth');
    }

    // ============== User Registration
    // public function UserRegistration(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Validate form input
    //         $validator = Validator::make($request->all(), [
    //             'Company_Email' => 'required|email|unique:authorized_users,email',
    //             'Company_Name' => 'required',
    //             'Company_USDot' => 'required',
    //             'Mc_Number' => 'required',
    //             'Company_Country' => 'required',
    //             'Company_State' => 'required',
    //             'Company_City' => 'required',
    //             'Contact_Phone' => 'required',
    //             'Company_Address' => 'required',
    //             'Company_Password' => 'required'
    //         ]);

    //         if ($validator->fails()) {
    //             return back()->with('Error!', '400 Bad Request \n Validations Failed');
    //         }


    //         // Register User
    //         $AuthorizedUser = new AuthorizedUsers();
    //         $AuthorizedUser->email = $request->Company_Email;
    //         $AuthorizedUser->password = bcrypt($request->Company_Password);
    //         $AuthorizedUser->Company_Name = $request->Company_Name;
    //         $AuthorizedUser->Company_USDot = $request->Company_USDot;
    //         $AuthorizedUser->Mc_Number = $request->Mc_Number;
    //         $AuthorizedUser->Business_Licence = $request->Business_Licence;
    //         $AuthorizedUser->Company_Country = $request->Company_Country;
    //         $AuthorizedUser->Company_State = $request->Company_State;
    //         $AuthorizedUser->Company_City = $request->Company_City;
    //         $AuthorizedUser->Contact_Phone = $request->Contact_Phone;
    //         $AuthorizedUser->Address = $request->Company_Address;
    //         $AuthorizedUser->usr_type = $request->User_Type;
    //         $AuthorizedUser->ref_code = $request->ref_code;

    //         // Save user
    //         if ($AuthorizedUser->save()) {
    //             $user_id = $AuthorizedUser->id;

    //             // Generate OTP
    //             $otp = rand(100000, 999999); // Generate a random OTP
    //             $AuthorizedUser->otp_code = $otp;
    //             $AuthorizedUser->otp_expires_at = now()->addMinutes(10); // Valid for 10 minutes
    //             $AuthorizedUser->save();

    //             // Store OTP for verification
    //             UserVerify::create([
    //                 'user_id' => $user_id,
    //                 'token' => $otp  // Store OTP in token field
    //             ]);

    //             // Send OTP to user's email
    //             Mail::send('emails.otpVerificationEmail', [
    //                 'otp' => $otp,
    //                 'email' => $request->Company_Email,
    //                 'name' => $request->Company_Name
    //             ], function ($message) use ($request) {
    //                 $message->to($request->Company_Email);
    //                 $message->subject('OTP for Email Verification');
    //             });

    //             DB::commit();
    //             return redirect()->route('Auth.OTPForm', ['user_id' => $user_id])->with('Success!', 'Registration Successful. Please check your email for the OTP.');
    //         }

    //         DB::rollback();
    //         return back()->with('Error!', 'User Registration Failed.');
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         return back()->with('Error!', 'Error occurred during registration: ' . $e->getMessage());
    //     }
    // }

    // public function verifyOtpForm($user_id)
    // {
    //     $slot = '';
    //     return view('auth.otpVerification', compact('slot', 'user_id'));
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'otp' => 'required|numeric|digits:6'
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->with('Error!', 'Invalid OTP');
    //     }

    //     // Check if OTP matches
    //     $userVerify = UserVerify::where('user_id', $request->user_id)->where('token', $request->otp)->first();

    //     if ($userVerify) {
    //         // OTP is correct
    //         // Update user's verified status or any other action needed
    //         AuthorizedUsers::where('id', $request->user_id)->update(['email_verified_at' => now()]);

    //         // return redirect()->route('login')->with('Success!', 'Your email has been verified.');
    //         // return view('livewire.auth.login-form')->with('Success!', 'Your email has been verified.')->layout('layouts.auth');
    //         return redirect()->route('Auth.Forms')->with('Success!', 'Now you can Signin.');

    //     } else {
    //         // OTP is incorrect
    //         return back()->with('Error!', 'Invalid OTP');
    //     }
    // }

    public function UserRegistration(Request $request)
    {
        // dd($request->toArray());
        try {
            DB::beginTransaction();
            
            if (url()->previous() != route('Auth.New.User')) {
                $validator = Validator::make($request->all(), [
                    'Company_Email' => 'required|email|unique:authorized_users,email',
                    'Company_Country' => 'required',
                    'Contact_Phone' => 'required',
                    'Company_Address' => 'required',
                    'Company_Password' => 'required',
                    'Agent_Name' =>  'required'
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'Company_Email' => 'required|email|unique:authorized_users,email',
                    'Company_Name' => 'required',
                    'Company_USDot' => 'required',
                    'Mc_Number' => 'required',
                    'Company_Country' => 'required',
                    'Company_State' => 'required',
                    'Company_City' => 'required',
                    'Contact_Phone' => 'required',
                    'Company_Address' => 'required',
                    'Company_Password' => 'required',
                ]);
            }

            if ($validator->fails()) {
                return back()->with('Error!', '400 Bad Request \n Validations Failed');
            }

            $AuthorizedUser = new AuthorizedUsers();

            $AuthorizedUser->name = $request->Agent_Name;
            $AuthorizedUser->owner_id = $request->owner_id ?? 0;
            $AuthorizedUser->email = $request->Company_Email;
            $AuthorizedUser->password = bcrypt($request->Company_Password);
            $AuthorizedUser->Company_Name = $request->Company_Name;
            $AuthorizedUser->Company_USDot = $request->Company_USDot;
            $AuthorizedUser->Mc_Number = $request->Mc_Number;
            $AuthorizedUser->Business_Licence = $request->Business_Licence;
            $AuthorizedUser->Company_Country = $request->Company_Country;
            $AuthorizedUser->Company_State = $request->Company_State;
            $AuthorizedUser->Company_City = $request->Company_City;
            $AuthorizedUser->Contact_Phone = $request->Contact_Phone;
            $AuthorizedUser->Address = $request->Company_Address;
            $AuthorizedUser->usr_type = $request->User_Type;
            $AuthorizedUser->ref_code = $request->ref_code;
            // $AuthorizedUser->ref_code_dispatcher = $request->ref_code_dispatcher;
            if ($request->has('User_Type')) {
                if ($request->User_Type == 'Dispatcher') {
                    $AuthorizedUser->ref_code_dispatcher = Str::random(10);
                }
            }

            if ($AuthorizedUser->save()) {
                $user_id = $AuthorizedUser->id;
                $token = Str::random(64);

                // Update User Insurance
                UserSetting::firstOrCreate(
                    ['user_id' => $user_id],
                    [
                        'email_notification' => $request->email_notification ?? 1,
                        'custom_notification' => $request->custom_notification ?? 1,
                        'prefer_vehicle' => $request->prefer_vehicle ?? 1,
                        'prefer_heavy' => $request->prefer_heavy ?? 1,
                        'prefer_dryvan' => $request->prefer_dryvan ?? 1,
                    ]
                );

                UserVerify::create([
                    'user_id' => $user_id,
                    'token' => $token
                ]);

                Mail::send(
                    'emails.emailVerificationEmail',
                    [
                        'token' => $token,
                        'email' => $request->Company_Email,
                        'name' => $request->Company_Name
                    ],
                    static function ($message) use ($request) {
                        $message->to($request->Company_Email);
                        $message->subject('Email Verification From Day Dispatch');
                    }
                );

                $UserInsurrance = new UserInsurrance();
                $UserCertificates = new UserCertificates();

                $UserInsurrance->user_id = $user_id;
                $UserInsurrance->save();
                $UserCertificates->user_id = $user_id;
                $UserCertificates->save();

                DB::commit();
                if ($request->owner_id == 0) {
                    return redirect()->route('Auth.Forms')->with('Success!', 'User Registered Successfully!');
                } else {
                    return back()->with('Success!', 'User Registered Successfully!');
                }
            }
            DB::rollback();
            return back()->with('Error!', 'User Registration Failed.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('Error!', 'Error occurred during registration.' . $e->getMessage());
        }
    }

    public function updateUserStatus(Request $request)
    {
        $user = AuthorizedUsers::find($request->user_id);

        if ($user) {
            $user->admin_verify = $request->is_active;
            $user->save();
            dd($user->toArray(), $request->toArray());

            return response()->json(['Success!' => true, 'message' => 'User status updated successfully!']);
        }

        return response()->json(['Error!' => false, 'message' => 'User not found!'], 404);
    }
}