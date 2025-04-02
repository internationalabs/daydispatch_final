<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class HopperBottomTrailer extends Component
{
    public function render()
    {
        return view('livewire.frontend.blog.HopperBottomTrailer')->layout('layouts.master');
    }
}
