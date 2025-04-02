<?php

namespace App\Http\Livewire\Backend\Extras;

use App\Models\Extras\TruckSpace;
use App\Models\Extras\TruckSpaceDry;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Extras\HeavyTruckSpace;

class MyAllTrucks extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $auth_user = Auth::guard('Authorized')->user();
        $Listing = AllUserListing::active()->with([
            "pickup_delivery_info",
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            "dry_vans_services",
            "routes"
        ])->whereNotIn('Listing_Status', ['Completed', 'Cancelled', 'Expired', 'Deleted'])
            ->get();
            // dd($Listing->toArray()); 
            // ->where('user_id', $user_id)

        $Truck_Space = TruckSpace::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->get();
            // dd($Truck_Space->toArray());
        // ->where('user_id', $user_id)

        $Heavy_Truck_Space = HeavyTruckSpace::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->get();
        // ->where('user_id', $user_id)


        $Truck_Space_Dry = TruckSpaceDry::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->get();
            // dd($Truck_Space_Dry->toArray());
        // ->where('user_id', $user_id)
            
        $All_Listing = AllUserListing::active()->with([
            "pickup_delivery_info",
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            "dry_vans_services",
            "routes"
        ])->whereNotIn('Listing_Status', ['Completed', 'Cancelled', 'Expired', 'Deleted'])
            ->get();

        // dd($All_Listing->toArray());

        return view('livewire.backend.extras.my_all_trucks', compact('Listing', 'Truck_Space', 'All_Listing', 'auth_user', 'Heavy_Truck_Space', 'Truck_Space_Dry'))->layout('layouts.authorized');
    }
}
