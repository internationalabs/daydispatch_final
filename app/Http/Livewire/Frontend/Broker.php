<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Payments\SubscriptionPackages;

class Broker extends Component
{
    public function render()
    {
        $Pacakges = SubscriptionPackages::first();
        return view('livewire.frontend.brokers', compact('Pacakges'))->layout('layouts.master');
    }
}
