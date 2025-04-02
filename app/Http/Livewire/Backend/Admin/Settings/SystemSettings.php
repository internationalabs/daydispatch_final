<?php

namespace App\Http\Livewire\Backend\Admin\Settings;

use App\Models\Settings\MiscItemsList;
use App\Models\Ip;
use App\Models\Settings\AdminRolePermissions;
use App\Models\AdminPermissions;
use App\Models\Settings\UserRolesList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Auth\AuthorizedAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Auth\UserVerify;
use App\Models\Profile\UserCertificates;
use App\Models\Profile\UserInsurrance;

class SystemSettings extends Component
{
    public function render()
    {
        $allPermission = AdminPermissions::get();
        $ips = Ip::get();
        $role = AdminRolePermissions::get();
        $Miscellaneous = MiscItemsList::orderBy('id', 'DESC')->get();
        $User_Roles = UserRolesList::orderBy('User_Roles')->get();
        return view('livewire.backend.admin.settings.system-settings', compact('Miscellaneous', 'User_Roles', 'role', 'ips', 'allPermission'))->layout('layouts.authorized-admin');
    }

    public function addMiscItems(Request $request): RedirectResponse
    {
        MiscItemsList::create(
            [
                'Misc_Items' => $request->Misc_Items
            ]
        );
        return back()->with('Success!', "Your Misc Item has been Added to Database!");
    }

    public function deleteMiscItems(Request $request)
    {
        MiscItemsList::find($request->Misc_ID)->delete();
        return back()->with('Success!', "Deleted Successfully!");
    }

    public function addUserRole(Request $request): RedirectResponse
    {
        UserRolesList::create(
            [
                'User_Roles' => $request->User_Roles
            ]
        );
        return back()->with('Success!', "Your User Role has been Added to Database!");
    }

    public function deleteUserRole(Request $request): RedirectResponse
    {
        UserRolesList::find($request->Role_ID)->delete();
        return back()->with('Success!', "Deleted Successfully!");
    }
    
    public function AdminRegistration(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'Admin_Email' => 'required|email|unique:authorized_admins,email',
                'Admin_Password' => 'required',
                'Admin_Name' => 'required',
                'role' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $AuthorizedUser = new AuthorizedAdmin();

            $AuthorizedUser->email = $request->Admin_Email;
            $AuthorizedUser->password = bcrypt($request->Admin_Password);
            $AuthorizedUser->name = $request->Admin_Name;
            $AuthorizedUser->role_id = $request->role;

            if ($AuthorizedUser->save()) {
                DB::commit();
                return back()->with('Success!', 'Admin Registered Successfully!');
            }
            DB::rollback();
            return back()->with('Error!', 'Failed to Register Admin!');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('Error!', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function UserRegistration(Request $request)
    {
        try {
            DB::beginTransaction();

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
                'Company_Password' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('Error!', '400 Bad Request \n Validations Failed');
            }

            $AuthorizedUser = new AuthorizedUsers();

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

                UserVerify::create([
                    'user_id' => $user_id,
                    'token' => $token
                ]);

                Mail::send('emails.emailVerificationEmail',
                    [
                        'token' => $token,
                        'email' => $request->Company_Email,
                        'name' => $request->Company_Name
                    ],
                    static function ($message) use ($request) {
                        $message->to($request->Company_Email);
                        $message->subject('Email Verification From Day Dispatch');
                    });

                $UserInsurrance = new UserInsurrance();
                $UserCertificates = new UserCertificates();

                $UserInsurrance->user_id = $user_id;
                $UserInsurrance->save();
                $UserCertificates->user_id = $user_id;
                $UserCertificates->save();

                DB::commit();
                return back()->with('Success!', 'User Registered Successfully!');
            }
            DB::rollback();
            return back()->with('Error!', 'User Registration Failed.');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('Error!', 'Error occurred during registration.' . $e->getMessage());
        }
    }
    
    public function AddAdminPermissions(Request $request)
    {
        // Define an array of roles and their corresponding permissions
        $roles = [
            'Admin' => 'AdminPermission',
            'GM' => 'GMPermission',
            'Manager' => 'ManagerPermission',
            'Supervisor' => 'SupervisorPermission',
            'QA' => 'QAPermission'
        ];
    
        // Iterate through the roles
        foreach ($roles as $role => $permissionKey) {
            // Check if the request has the permission for the current role
            if ($request->has($permissionKey)) {
                // Find the role in the database
                $adminRole = AdminRolePermissions::where('role', $role)->first();
    
                // If the role exists, update its permissions
                if ($adminRole) {
                    $adminRole->permission = implode(',', $request->input($permissionKey));
                    $adminRole->save();
                }
            }
        }
        
        return back()->with('success', 'Permissions updated successfully.');
    }
    
    public function storePermission(Request $request)
    {
        $data = new AdminPermissions;
        $data->name = $request->name;
        $data->save();
        
        return back();
    }
    
    public function deletePermission($id)
    {
        $data = AdminPermissions::find($id);
        $data->delete();
        
        return back();
    }
    
    public function storeIP(Request $request)
    {
        $data = new Ip;
        $data->ip_address = $request->ip_address;
        $data->save();
        
        return back();
    }
    
    public function deleteIP($id)
    {
        $data = Ip::find($id);
        $data->delete();
        
        return back();
    }


}
