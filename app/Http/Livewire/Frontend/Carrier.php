<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Payments\SubscriptionPackages;

class Carrier extends Component
{
    public function render()
    {
        $Pacakges = SubscriptionPackages::first();
        return view('livewire.frontend.carriers', compact('Pacakges'))->layout('layouts.master');
    }
}
