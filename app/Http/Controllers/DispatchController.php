<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payments\SubscriptionPackages;

class DispatchController extends Controller
{
    public function index(Request $request)
    {
        $slot = '';
        $Pacakges = SubscriptionPackages::first();
        return view('livewire.frontend.dispatch', compact('slot', 'Pacakges'))->layout('layouts.master');
    }
}
