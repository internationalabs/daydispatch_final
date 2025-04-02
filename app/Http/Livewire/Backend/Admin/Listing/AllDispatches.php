<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\Dispatch;
use App\Services\ListingServices;
use Livewire\Component;

class AllDispatches extends Component
{
    protected ListingServices $listingServices;
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }
    public function render()
    {
        $Lisiting = $this->listingServices->getDispatchesOrders();
        return view('livewire.backend.admin.listing.all-dispatches', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
