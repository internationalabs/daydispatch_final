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

}
