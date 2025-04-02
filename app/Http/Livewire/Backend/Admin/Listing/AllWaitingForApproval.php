<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Services\ListingServices;
use Livewire\Component;

class AllWaitingForApproval extends Component
{
    protected ListingServices $listingServices;
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $Lisiting = $this->listingServices->getWaitingOrders();
        return view('livewire.backend.admin.listing.all-waiting-for-approval', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
