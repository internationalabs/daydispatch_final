<?php

namespace App\Http\Livewire\Backend\Admin\Permissions;

use App\Models\Listing\LogisticShipper;
use App\Models\Listing\LogisticCarrier;
use App\Models\Listing\LogisticBroker;
use App\Models\Settings\Permission;
use App\Models\Listing\AllCarriers;
use App\Models\Settings\AgentPermission;
use App\Models\Auth\AuthorizedAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AllAgentsPermissions extends Component
{
    public function render()
    {
        $permission = Permission::get();
        $permissionSet = AgentPermission::get();
        $agent = AuthorizedAgent::get();
        return view('livewire.backend.admin.user-profiles.agent-permissions', compact('permission', 'agent', 'permissionSet'))->layout('layouts.authorized-admin');
    }

    public function store(Request $request)
    {
        $check = AgentPermission::where('user_id', $request->agent)
            ->where('permission_name', $request->permission);

        $check = ($check->exists()) ? $check->first() : new AgentPermission();

        $records = AllCarriers::where('user_id', 0)
            ->whereIn('state', $request->state)
            ->limit($request->allow)
            ->update(['user_id' => $request->agent]);


        $check->allow = $request->allow;
        $check->user_id = $request->agent;
        $check->permission_name =$request->permission;
        $check->state = implode(',', $request->state);
        $check->save();

        return redirect()->route('All.Agents.Permissions')->with('success', 'Permission Set created successfully!');

    }

    public function getStates(Request $request)
    {
        $data = AllCarriers::select('state', DB::raw('count(*) as total'))
            ->groupBy('state')
            ->where('type_1',$request->permission)
            ->get();

        return $data;
    }

    public function destroy(Request $request)
    {
        AgentPermission::where('user_id', $request->agent)
        ->where('permission_name', $request->permission)->delete();

        if ($request->permission == 1)
        {
            $records = AllCarriers::where('user_id', $request->agent)
            ->update(['user_id' => 0]);
        }
        elseif ($request->permission == 2)
        {
            $records = LogisticCarrier::where('user_id', $request->agent)
                ->update(['user_id' => 0]);
        }
        elseif ($request->permission == 3)
        {
            $records = LogisticShipper::where('user_id', $request->agent)
                ->update(['user_id' => 0]);
        }
        elseif ($request->permission == 4)
        {
            $records = LogisticBroker::where('user_id', $request->agent)
                ->update(['user_id' => 0]);
        }
    }
}
