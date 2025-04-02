<?php

namespace App\Http\Livewire\Backend\Agent;

use App\Models\Listing\AllCarriers;
use App\Models\Listing\LogisticShipper;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\History\LogisticShipperCallHistory;
use App\Models\Listing\LogisticShipperCallCount;

class LogisticShippers extends Component
{
    public function render()
    {
        $auth_agent = Auth::guard('Agent')->user();
        $carrier = [];
        $permission =  $auth_agent->permissions(2);
        if ($auth_agent->permissions(2))
        {
            $state = $permission->state;
            $allow = $permission->allow;
            $carrier = AllCarriers::where('user_id', $auth_agent->id)->take($allow)->paginate(50);
        }
        return view('livewire.backend.agent.logisticShipper', compact('carrier'))->layout('layouts.authorized-agent');
    }

    public function storeHistory(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        // dd($request->toArray());
        $history = new LogisticShipperCallHistory;
        $history->user_id = $auth_agent->id;
        $history->permission = $request->permission;
        $history->connectStatus = $request->connectStatus;
        $history->comment = $request->comment;
        $history->save();

        return LogisticShipperCallHistory::with('user')
            ->where('user_id', $auth_agent->id)
            ->where('permission', $request->permission)
            ->get();
    }

    public function getHistory(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        return LogisticShipperCallHistory::with('user')
            ->where('user_id', $auth_agent->id)
            ->where('permission', $request->HistoryID)
            ->get();

    }

    public function addCallCount(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        $count = new LogisticShipperCallCount;
        $count->user_id = $auth_agent->id;
        $count->company_id = $request->company;
        $count->save();
    }
}
