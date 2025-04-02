<?php

namespace App\Http\ApiControllers;

use App\Models\Extras\InstantQoute;
use App\Models\Frontend\ContactLead;
use App\Models\Frontend\CustomOrderTracker;
use Livewire\Component;

class WebsiteLeads
{
    public function webLeads()
    {
        $contactLeads = ContactLead::orderBy('id', 'DESC')->get();
        $ordersTracking = CustomOrderTracker::orderBy('id', 'DESC')->get();
        $instantLeads = InstantQoute::orderBy('id', 'DESC')->get();
        
        return response()->json([
            'contact_leads' => $contactLeads,
            'orders_tracking' => $ordersTracking,
            'instant_leads' => $instantLeads,
        ], 200);
    }
}
