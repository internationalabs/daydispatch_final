<?php

namespace App\Http\Livewire\Backend\Listing;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Profile\MyContract;

use App\Models\Listing\AllUserListing;

class EditListing extends Component
{
    public function render(Request $request)
    {
        $Listed_ID = $request->List_ID;
        $user_id = Auth::guard('Authorized')->user()->id;

        $Lisiting = AllUserListing::with(
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
            "dispatch_listing",
        )->where('id', $Listed_ID)
            ->where('user_id', $user_id)
            ->firstOrFail();

        $Pickup_Services = ($Lisiting->dry_vans_services)->map(function ($List) {
            return [
                Str::replace([' / ', ' ', '/'], "_", $List->Pickup_Service) => $List->Pickup_Service
            ];
        });
        $Delivery_Services = ($Lisiting->dry_vans_services)->mapWithKeys(function ($List) {
            return [
                Str::replace([' / ', ' ', '/'], "_", $List->Delivery_Service) => $List->Delivery_Service
            ];
        });

        $MyContract = MyContract::where('user_id', $user_id)->get();

        $currentRouteMatchesPattern = (\Illuminate\Support\Facades\Request::url() === url('Authorized/Expire-Listing-Re-Enlisted/' . $Listed_ID)) ? 1 : 0;

        return view('livewire.backend.listing.edit-listing', compact('Listed_ID', 'Lisiting', 'Pickup_Services', 'Delivery_Services', 'currentRouteMatchesPattern', 'MyContract'))->layout('layouts.authorized');
    }
}
