<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\AllUserListing;
use Livewire\Component;

class AllExpired extends Component
{
    public function render()
    {
        $Lisiting = AllUserListing::expired()->brokerlisting()->get();
        return view('livewire.backend.admin.listing.all-expired', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
