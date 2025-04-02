<?php

namespace App\Http\Livewire\Backend\Listing;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile\MyContract;
use App\Models\Listing\AllUserListing;

class NewListing extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;

        $lastListing = AllUserListing::withTrashed()->max('id');
        $L_PID = $lastListing !== null ? $lastListing + 1 : 1;

        $MyContract = MyContract::orderBy('id', 'DESC')->where('user_id', $user_id)->get();

        return view('livewire.backend.listing.new-listing', compact('L_PID', 'MyContract'))->layout('layouts.authorized');
    }
}
