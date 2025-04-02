<?php

namespace App\Http\Livewire\Auth;

use App\Models\Auth\AuthorizedAdmin;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminRegistration extends Component
{
    public function render()
    {
        return view('livewire.auth.admin-registration')->layout('layouts.auth-admin');
    }

    // ============== Admin Registration

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
                return redirect()->route('Auth.Admin.Forms')->with('Success!', 'Admin Registered Successfully!');
            }
            DB::rollback();
            return back()->with('Error!', 'Failed to Register Admin!');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('Error!', 'An error occurred: ' . $e->getMessage());
        }
    }

}
