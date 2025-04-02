<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\CancelledOrders;
use App\Services\ListingServices;
use Livewire\Component;

class AllCancelled extends Component
{
    protected ListingServices $listingServices;
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $Lisiting = $this->listingServices->getCancelledOrders();
        return view('livewire.backend.admin.listing.all-cancelled', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
