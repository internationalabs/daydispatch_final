<?php

namespace App\Http\Livewire\Backend\Quote;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile\MyContract;
use App\Models\Listing\AllUserListing;
use App\Models\Quote\Order;
use App\Models\SidebarOption;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;


class NewQuote extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;

        $lastListing = AllUserListing::withTrashed()->max('id');
        $L_PID = $lastListing !== null ? $lastListing + 1 : 1;

        $MyContract = MyContract::where('user_id', $user_id)->get();

        return view('livewire.backend.quote.new', compact('L_PID', 'MyContract'))->layout('layouts.authorizedQuote');
    }

    public function EditQuote($ListId)
    {
    	$slot = '';
    	$user_id = Auth::guard('Authorized')->user()->id;

        $sidebarOptions = SidebarOption::where('user_id', $user_id)->get();

        $Lisiting = Order::with(
            "authorized_user",
            "paymentinfo",
            "additional_info",
            "pickup_delivery_info",
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            "dry_vans_services",
            "routes",
            "listing_origin_location",
            "listing_destination_locations",
            "attachments",
        )->where('id', $ListId)
        ->where('user_id', $user_id)
        ->firstOrFail();
        // dd($Lisiting);


        return view('livewire.backend.quote.edit-quote', compact('Lisiting', 'slot', 'sidebarOptions'))->layout('layouts.authorizedQuote');
    }

    public function ShowQuote($ListId)
    {
        $slot = '';
        $user_id = Auth::guard('Authorized')->user()->id;


        $Lisiting = Order::with(
            "authorized_user",
            "paymentinfo",
            "additional_info",
            "pickup_delivery_info",
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            "dry_vans_services",
            "routes",
            "listing_origin_location",
            "listing_destination_locations",
            "attachments",
        )->where('id', $ListId)
        ->where('user_id', $user_id)
        ->get();
        // dd($Lisiting);


        return view('livewire.backend.quote.listing-quote', compact('Lisiting', 'slot'))->layout('layouts.authorizedQuote');
    }
}
