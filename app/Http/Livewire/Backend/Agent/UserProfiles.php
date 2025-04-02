<?php

namespace App\Http\Livewire\Backend\Agent;

use App\Models\Auth\AuthorizedUsers;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfiles extends Component
{
    public function render()
    {
        $Ref_Code = Auth::guard('Agent')->user()->ref_code;
        $All_Users = AuthorizedUsers::with([
            'insurance',
            'certificates'
        ])->orderBy('id', 'DESC')->where('ref_code', $Ref_Code)->get();
        return view('livewire.backend.agent.user-profiles', compact('All_Users'))->layout('layouts.authorized-agent');
    }
}
