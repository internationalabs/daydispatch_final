<?php

namespace App\Http\Livewire\Backend\Admin\UserProfiles;

use App\Models\Auth\AuthorizedAgent;
use Livewire\Component;

class ManageAgents extends Component
{
    public function render()
    {
        $All_Users = AuthorizedAgent::orderBy('id', 'DESC')->get();
        return view('livewire.backend.admin.user-profiles.manage-agents', compact('All_Users'))->layout('layouts.authorized-admin');
    }
}
