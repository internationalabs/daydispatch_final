<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadboardRole;

class LoadboardRoleController extends Controller
{
    public function index()
    {
        $roles = LoadboardRole::all();
        $slot = '';
        return view('livewire.backend.admin.loadboard_roles.index', compact('roles', 'slot'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        LoadboardRole::create($request->all());
        return redirect()->route('loadboard.roles')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = LoadboardRole::findOrFail($id);
        return view('livewire.backend.admin.loadboard_roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        $role = LoadboardRole::findOrFail($id);
        $role->update($request->all());

        return redirect()->route('loadboard.roles')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        LoadboardRole::findOrFail($id)->delete();
        return redirect()->route('loadboard.roles')->with('success', 'Role deleted successfully.');
    }

    public function active($id)
    {
        $role = LoadboardRole::findOrFail($id);
        $role->update(['status' => 1]);

        return redirect()->route('loadboard.roles')->with('success', 'Role activated.');
    }

    public function notActive($id)
    {
        $role = LoadboardRole::findOrFail($id);
        $role->update(['status' => 0]);

        return redirect()->route('loadboard.roles')->with('success', 'Role deactivated.');
    }
}
