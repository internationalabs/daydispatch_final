<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class FAQ extends Component
{
    public function render()
    {
        return view('livewire.frontend.f-a-q')->layout('layouts.master');
    }
}
