<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Classified extends Component
{
    public function render()
    {
        return view('livewire.frontend.classified')->layout('layouts.master');
    }
}
