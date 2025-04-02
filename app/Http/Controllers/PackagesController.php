<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payments\SubscriptionPackages;

class PackagesController extends Controller
{
    public function index(Request $request)
    {
        $slot = '';
        $type = '';
        if ($request->type)
        {
            $type = $request->type;
        }
        $Pacakges = SubscriptionPackages::first();
        return view('livewire.frontend.packages', compact('Pacakges', 'type', 'slot'));
    }
}
