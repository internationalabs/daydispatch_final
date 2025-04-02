<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\DeliverdOrders;
use App\Services\ListingServices;
use Livewire\Component;

class AllDelivered extends Component
{
    protected ListingServices $listingServices;
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $Lisiting = $this->listingServices->getDeliveredOrders();
        return view('livewire.backend.admin.listing.all-delivered', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
