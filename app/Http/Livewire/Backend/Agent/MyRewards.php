<?php

namespace App\Http\Livewire\Backend\Agent;

use App\Services\DayDispatchServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyRewards extends Component
{
    protected DayDispatchServices $dayDispatchServices;
    public function mount(DayDispatchServices $dayDispatchServices): void
    {
        $this->dayDispatchServices = $dayDispatchServices;
    }
    public function render()
    {
        $auth_agent = Auth::guard('Agent')->user();
        $Revenue = $this->dayDispatchServices->getAgentRevenue($auth_agent->id);

        $currentMonth = $Revenue->currentMonth()->get();
        $overallRevenue = $Revenue->get();

        return view('livewire.backend.agent.my-rewards', compact('currentMonth', 'overallRevenue'))->layout('layouts.authorized-agent');
    }
}
