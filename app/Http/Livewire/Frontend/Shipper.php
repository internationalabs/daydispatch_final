<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Payments\SubscriptionPackages;

class Shipper extends Component
{
    public function render()
    {
        $Pacakges = SubscriptionPackages::first();
        return view('livewire.frontend.shippers', compact('Pacakges'))->layout('layouts.master');
    }
}
