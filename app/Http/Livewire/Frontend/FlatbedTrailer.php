<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class FlatbedTrailer extends Component
{
    public function render()
    {
        return view('livewire.frontend.blog.FlatbedTrailer')->layout('layouts.master');
    }
}
