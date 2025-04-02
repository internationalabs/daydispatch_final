<?php

namespace App\Http\Livewire\Backend\Admin\Frontend;

use App\Models\Extras\InstantQoute;
use App\Models\Frontend\ContactLead;
use App\Models\Frontend\CustomOrderTracker;
use Livewire\Component;

class WebsiteLeads extends Component
{
    public function render()
    {
        $Contact_Leads = ContactLead::orderBy('id', 'DESC')->get();
        $Orders_Tracking = CustomOrderTracker::orderBy('id', 'DESC')->get();
        $Instant_Leads = InstantQoute::orderBy('id', 'DESC')->get();
        return view('livewire.backend.admin.frontend.website-leads', compact('Contact_Leads', 'Orders_Tracking', 'Instant_Leads'))->layout('layouts.authorized-admin');
    }
}
