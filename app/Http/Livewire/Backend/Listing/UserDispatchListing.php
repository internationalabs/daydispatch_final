<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Services\ListingServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Listing\Dispatch;
use Illuminate\Pagination\LengthAwarePaginator;

class UserDispatchListing extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render(Request $request)
    {
        $Search_vehicleType = null;
        $auth_user = Auth::guard('Authorized')->user();
        
        $Lisiting = $this->listingServices->getDispatchesOrders();
        // $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        // dd($Lisiting->toarray());
        // if ($auth_user->usr_type === 'Carrier') {
        //     $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
        // } else {
        //     $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        // }
        if ($auth_user->usr_type === 'Carrier') {
            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;
                if ($request->Search_vehicleType == 'vehicles') {
                    $Lisiting = Dispatch::orderBy('id', 'DESC')->with('all_listing')->where('CMP_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 1);
                    })->get();
                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = Dispatch::orderBy('id', 'DESC')->with('all_listing')->where('CMP_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 2);
                    })->get();
                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = Dispatch::orderBy('id', 'DESC')->with('all_listing')->where('CMP_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 3);
                    })->get();
                } else {
                    $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
                }
            } else {
                $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
            }
        } else {
            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;
                if ($request->Search_vehicleType == 'vehicles') {
                    $Lisiting = Dispatch::orderBy('id', 'DESC')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 1);
                    })->get();
                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = Dispatch::orderBy('id', 'DESC')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 2);
                    })->get();

                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = Dispatch::orderBy('id', 'DESC')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 3);
                    })->get();

                } else {
                    $Lisiting = $Lisiting->where('user_id', $auth_user->id);

                }
            } else {
                $Lisiting = $Lisiting->where('user_id', $auth_user->id);
            }
        }
        
        $Lisiting = new LengthAwarePaginator(
            $Lisiting->forPage($request->input('page', 1), $request->input('per_page', 10)), 
            $Lisiting->count(), 
            $request->input('per_page', 10), 
            $request->input('page', 1), 
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
        // dd($Lisiting);
        // dd('oks', $Lisiting->toarray());
        return view('livewire.backend.listing.user-dispatch-listing', compact('Lisiting', 'Search_vehicleType'))->layout('layouts.authorized');
    }
}
