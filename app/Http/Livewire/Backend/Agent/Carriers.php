<?php

namespace App\Http\Livewire\Backend\Agent;

use App\Models\Listing\AllCarriers;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\History\CarrierCallHistory;
use App\Models\Listing\CarrierCallCount;

class Carriers extends Component
{
    public function render()
    {
        $auth_agent = Auth::guard('Agent')->user();
        $carrier = [];
        $permission =  $auth_agent->permissions(1);
        if ($auth_agent->permissions(1))
        {
            $state = $permission->state;
            $allow = $permission->allow;
            $carrier = AllCarriers::where('user_id', $auth_agent->id)->take($allow)->paginate(50);
        }

        return view('livewire.backend.agent.carrier', compact('carrier'))->layout('layouts.authorized-agent');
    }

    public function storeHistory(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        $history = new CarrierCallHistory;
        $history->user_id = $auth_agent->id;
        $history->permission = $request->permission;
        $history->connectStatus = $request->connectStatus;
        $history->comment = $request->comment;
        $history->save();

        return CarrierCallHistory::with('user')
            ->where('user_id', $auth_agent->id)
            ->where('permission', $request->permission)
            ->get();
    }

    public function addCallCount(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        $count = new CarrierCallCount;
        $count->user_id = $auth_agent->id;
        $count->company_id = $request->company;
        $count->type = $request->Num;
        $count->save();
    }

    public function getHistory(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        return CarrierCallHistory::with('user')
            ->where('user_id', $auth_agent->id)
            ->where('permission', $request->HistoryID)
            ->get();

    }
}
