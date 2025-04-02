<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\PickupOrders;
use App\Services\ListingServices;
use Livewire\Component;

class AllPickUp extends Component
{
    protected ListingServices $listingServices;
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $Lisiting = $this->listingServices->getPickupOrders();
        return view('livewire.backend.admin.listing.all-pick-up', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
