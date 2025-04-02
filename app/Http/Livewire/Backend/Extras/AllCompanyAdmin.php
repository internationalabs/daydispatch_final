<?php

namespace App\Http\Livewire\Backend\Extras;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Http\Request;

class AllCompanyAdmin extends Component
{
    public function render()
    {
        return view('livewire.backend.extras.all-admin-company')->layout('layouts.authorized-admin');
    }
}