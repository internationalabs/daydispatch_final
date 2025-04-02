<?php

namespace App\Http\Livewire\Backend\Agent;

use App\Models\Auth\AuthorizedUsers;
use App\Services\ListingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewProfiles extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices)
    {
        $this->listingServices = $listingServices;
    }

    public function render(Request $request)
    {
        $Ref_Code = Auth::guard('Agent')->user()->ref_code;
        $user_id = $request->User_ID;
        $usr_type = $request->USR_TYPE;
        $User_Info = AuthorizedUsers::with(
            [
                "insurance",
                "certificates",
            ])->where('id', $user_id)->where('ref_code', $Ref_Code)->firstOrFail();
        $Completed = $this->listingServices->getProfileCompleteList($user_id);
        return view('livewire.backend.agent.view-profiles', compact('User_Info', 'usr_type', 'Completed'))->layout('layouts.authorized-agent');
    }
}
