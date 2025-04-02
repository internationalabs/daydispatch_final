<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Models\Listing\ListingAttachments;
use Illuminate\Http\Request;
use Livewire\Component;

class ListingGallery extends Component
{
    public function render(Request $request)
    {
        $Order_Attachments = ListingAttachments::orderBy('id', 'DESC')->where('order_id', $request->List_ID)->get();
        return view('livewire.backend.listing.listing-gallery', compact('Order_Attachments'))->layout('layouts.authorized');
    }
}
