<?php

namespace App\Http\Livewire\Backend\Admin\Listing;

use App\Models\Listing\AllUserListing;
use App\Models\Listing\ArchiveListing;
use Livewire\Component;

class AllArchived extends Component
{
    public function render()
    {
        // $Lisiting = AllUserListing::archived()->brokerlisting()->get();
        $Lisiting = ArchiveListing::with(['all_listing' => function ($query) {
            $query->brokerListing();
        }])->get();
        return view('livewire.backend.admin.listing.all-archived', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
}
