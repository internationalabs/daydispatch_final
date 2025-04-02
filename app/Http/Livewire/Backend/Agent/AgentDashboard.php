<?php

namespace App\Http\Livewire\Backend\Agent;

use App\Helpers\DayDispatchHelper;
use App\Services\DayDispatchServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgentDashboard extends Component
{
    protected DayDispatchServices $dayDispatchServices;

    public function mount(DayDispatchServices $dayDispatchServices): void
    {
        $this->dayDispatchServices = $dayDispatchServices;
    }

    public function render()
    {
        $auth_agent = Auth::guard('Agent')->user();
        $Agent_Revenue = $this->dayDispatchServices->calculateAgentRevenue($auth_agent->id);
        $Agent_Count = DayDispatchHelper::getAgentCounts($auth_agent->ref_code);

        return view('livewire.backend.agent.agent-dashboard', compact('Agent_Revenue', 'Agent_Count'))->layout('layouts.authorized-agent');
    }
}
