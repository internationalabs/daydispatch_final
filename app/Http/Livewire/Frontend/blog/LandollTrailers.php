<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class ReeferContainers extends Component
{
    public function render()
    {
        return view('livewire.frontend.LandollTrailers')->layout('layouts.master');
    }
}
