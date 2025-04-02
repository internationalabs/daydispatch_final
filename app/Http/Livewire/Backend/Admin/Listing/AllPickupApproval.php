<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\PickUpApprovals;
use App\Services\ListingServices;
use Livewire\Component;

class AllPickupApproval extends Component
{
    protected ListingServices $listingServices;
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $Lisiting = $this->listingServices->getPickupApprovalOrders();
        return view('livewire.backend.admin.listing.all-pickup-approval', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
