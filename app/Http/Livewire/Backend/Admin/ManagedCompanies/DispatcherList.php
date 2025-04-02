<?php

namespace App\Http\Livewire\Backend\Admin\ManagedCompanies;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;

class DispatcherList extends Component
{
    public function render()
    {
        $All_Users = AuthorizedUsers::where('usr_type', 'Dispatcher')->orderBy('id', 'DESC')->get();
        return view('livewire.backend.admin.managedCompanies.dispatched', compact('All_Users'))->layout('layouts.authorized-admin');
    }

    public function assignCompany(Request $request)
    {
        dd('ok', $request->toArray());
        $User = AuthorizedUsers::where('id', $request->User_ID)->first();
        $User->admin_verify = 1;
        $User->Profile_Update = 1;
        $User->is_email_verified = 1;
        if ($User->update()) {
            return redirect()->route('All.Users')->with('Success!', "User Verification Done!");
        } else {
            return back()->with('Error!', "User Didn't Verify!");
        }
    }

}
