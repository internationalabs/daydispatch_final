<?php

namespace App\Http\Livewire\Backend\Extras;

use Livewire\Component;

class FrieghtCalculator extends Component
{
    public function render()
    {
        return view('livewire.backend.extras.frieght-calculator')->layout('layouts.authorized');
    }
}
