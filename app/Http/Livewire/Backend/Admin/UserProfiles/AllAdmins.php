<?php

namespace App\Http\Livewire\Backend\Admin\UserProfiles;

use App\Models\Auth\AuthorizedAdmin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class AllAdmins extends Component
{
    public function render()
    {
        $All_Users = AuthorizedAdmin::orderBy('id', 'DESC')->get();

        return view('livewire.backend.admin.user-profiles.all-admins', compact('All_Users'))->layout('layouts.authorized-admin');
    }

    public function store(Request $request): RedirectResponse
    {
        // Retrieve the authorized admin user based on the given User_ID
        $User = AuthorizedAdmin::where('id', $request->User_ID)->first();
    
        // Retrieve the AdminPermission array from the request
        $adminPermissions = $request->input('AdminPermission', []);
    
        // Convert the array to comma-separated values
        $permissionsString = implode(',', $adminPermissions);
    
        // Update the permission attribute of the user
        $User->permission = $permissionsString;
    
        // Save the changes to the user
        $User->save();
    
        // Flash success message to the session
        Session::flash('success', 'Permissions updated successfully.');
    
        // Redirect back with success message
        return redirect()->back();
    }

    public function getChecked(Request $request)
    {
        $User = AuthorizedAdmin::where('id', $request->User_ID)->first();
        $permission = $User->permission;
        
        return $permission;
    }

}
