<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\AllUserListing;
use Livewire\Component;

class AllListing extends Component
{
    public function render()
    {
        $Lisiting = AllUserListing::active()->carrierlisting()->get();
        return view('livewire.backend.admin.listing.all-listing', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
