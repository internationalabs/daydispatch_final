<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class TermsConditions extends Component
{
    public function render()
    {
        return view('livewire.frontend.terms-conditions')->layout('layouts.master');
    }
}
