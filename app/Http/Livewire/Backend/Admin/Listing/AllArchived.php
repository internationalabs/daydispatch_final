<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\AllUserListing;
use Livewire\Component;

class AllArchived extends Component
{
    public function render()
    {
        $Lisiting = AllUserListing::archived()->brokerlisting()->get();
        return view('livewire.backend.admin.listing.all-archived', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
