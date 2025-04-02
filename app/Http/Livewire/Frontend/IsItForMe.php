<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class IsItForMe extends Component
{
    public function render()
    {
        return view('livewire.frontend.is-it-for-me')->layout('layouts.master');
    }
}
