<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class LandollTrailers extends Component
{
    public function render()
    {
        return view('livewire.frontend.blog.LandollTrailers')->layout('layouts.master');
    }
}
