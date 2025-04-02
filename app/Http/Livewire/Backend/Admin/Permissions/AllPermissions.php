<?php

namespace App\Http\Livewire\Backend\Admin\Permissions;

use App\Models\Extras\InstantQoute;
use App\Models\Settings\Permission;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AllPermissions extends Component
{
    public function render()
    {
        $permission = Permission::get();
        return view('livewire.backend.admin.user-profiles.all-permissions', compact('permission'))->layout('layouts.authorized-admin');
    }

    public function store(Request $request)
    {
        $permission = Permission::updateOrCreate(
            ['id' => $request->id], // Check if permission exists
            [
                'name' => $request->name,
                'label' => $request->label,
            ]
        );
        return redirect()->route('All.Permissions')->with('success', 'Permission created successfully!');

    }
}
