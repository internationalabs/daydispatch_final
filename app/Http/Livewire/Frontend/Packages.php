<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Payments\SubscriptionPackages;
use Illuminate\Support\Facades\Auth;

class Packages extends Component
{
    public function render()
    {
        dd('dadada');
        $Pacakges = SubscriptionPackages::first();
        return view('livewire.frontend.packages', compact('Pacakges'))->layout('layouts.master');
    }
}
