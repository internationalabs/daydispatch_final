<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Services\ListingServices;
use Livewire\Component;

class AllDeliverApproval extends Component
{
    protected ListingServices $listingServices;
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $Lisiting = $this->listingServices->getDeliverApprovalOrders();
        return view('livewire.backend.admin.listing.all-deliver-approval', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
