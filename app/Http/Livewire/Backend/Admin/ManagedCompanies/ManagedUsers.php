<?php

namespace App\Http\Livewire\Backend\Admin\ManagedCompanies;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Extras\ManagedUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;

class ManagedUsers extends Component
{
    public function render()
    {
        $All_Users = ManagedUser::with('user')->get();
        // dd('ok', $All_Users->toArray());
        return view('livewire.backend.admin.managedCompanies.managed', compact('All_Users'))->layout('layouts.authorized-admin');
    }

    public function assignCompany(Request $request, $User_ID, $USR_TYPE)
    {
        $user = new ManagedUser;
        $user->dispatcher_id = $User_ID;
        $user->user_id = $request->assignUser;
        if ($user->save()) {
            return back()->with('Success!', "User Assigned!");
            // return redirect()->route('All.Managed.Companies')->with('Success!', "User Assigned!");
        } else {
            return back()->with('Error!', "User Didn't Assign!");
        }
    }

    public function removeAccess(Request $request, $User_ID, $USR_TYPE)
    {
        $user = ManagedUser::where('user_id', $User_ID)->first();
        
        if ($user->delete()) {
            return back()->with('Success!', "Access Removed!");
            // return redirect()->route('All.Managed.Companies')->with('Success!', "User Assigned!");
        } else {
            return back()->with('Error!', "Access Didn't Remove!");
        }
    }

}
