<?php

namespace App\Http\Livewire\Backend\Agent;

use App\Models\Listing\AllCarriers;
use App\Models\Listing\LogisticBroker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\History\LogisticBrokerCallHistory;
use App\Models\Listing\LogisticBrokerCallCount;

class LogisticBrokers extends Component
{
    public function render()
    {
        $auth_agent = Auth::guard('Agent')->user();
        $lgCarrier = [];
        if ($auth_agent->permissions(3))
        {
            $state = $auth_agent->permissions(3)->state;
            $allow = $auth_agent->permissions(3)->allow;
            // $lgCarrier = LogisticCarrier::where('city', 'like', '%' . $state)->take($allow)->get();
            $carrier = AllCarriers::where('user_id', $auth_agent->id)->take($allow)->paginate(50);
        }
        return view('livewire.backend.agent.logisticBroker', compact('carrier'))->layout('layouts.authorized-agent');
    }

    public function storeHistory(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        // dd($request->toArray());
        $history = new LogisticBrokerCallHistory;
        $history->user_id = $auth_agent->id;
        $history->permission = $request->permission;
        $history->connectStatus = $request->connectStatus;
        $history->comment = $request->comment;
        $history->save();

        return LogisticBrokerCallHistory::with('user')
            ->where('user_id', $auth_agent->id)
            ->where('permission', $request->permission)
            ->get();
    }

    public function getHistory(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        return LogisticBrokerCallHistory::with('user')
            ->where('user_id', $auth_agent->id)
            ->where('permission', $request->HistoryID)
            ->get();

    }

    public function addCallCount(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        $count = new LogisticBrokerCallCount;
        $count->user_id = $auth_agent->id;
        $count->company_id = $request->company;
        $count->save();
    }
}
