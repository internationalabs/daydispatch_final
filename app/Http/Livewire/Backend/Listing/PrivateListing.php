<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RequestCarrierMail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Listing\AllUserListing;
use App\Models\Listing\WatchList;
use App\Models\Broker\RequestCarrier;
use App\Models\Carrier\RequestBroker;

class PrivateListing extends Component
{
    // public function render(Request $request)
    // {
    //     $auth_user = Auth::guard('Authorized')->user();
    //     $Search_vehicleType = null;
    //     $watchlist = WatchList::where('user_id', $auth_user->id)->get();
    //     if ($auth_user->usr_type === 'Carrier') {
    //         if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
    //             $Search_vehicleType = $request->Search_vehicleType;

    //             if ($request->Search_vehicleType == 'vehicles') {
    //                 # code...
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->with('vehicles')->carrierlisting()->where('Listing_Type', 1)->get();
    //             } elseif ($request->Search_vehicleType == 'heavy_equipments') {
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->with('heavy_equipments')->carrierlisting()->where('Listing_Type', 2)->get();

    //             } elseif ($request->Search_vehicleType == 'dry_vans') {
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->with('dry_vans')->carrierlisting()->where('Listing_Type', 3)->get();

    //             } else {
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->with('dry_vans')->carrierlisting()->where('Listing_Type', 3)->get();

    //             }
    //         } elseif ($request->has('get_comp_listing') && $request->get_comp_listing != null) {

    //             $CMP_ID = $request->get_comp_listing;
    //             $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->where('user_id', $CMP_ID)->get();

    //         } else {

    //             $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->carrierlisting()->get();
    //         }
    //     } else {
    //         if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
    //             $Search_vehicleType = $request->Search_vehicleType;

    //             if ($request->Search_vehicleType == 'vehicles') {
    //                 # code...
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->with('vehicles')->brokerlisting()->where('Listing_Type', 1)->where('user_id', $auth_user->id)->get();
    //             } elseif ($request->Search_vehicleType == 'heavy_equipments') {
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->with('heavy_equipments')->brokerlisting()->where('Listing_Type', 2)->where('user_id', $auth_user->id)->get();

    //             } elseif ($request->Search_vehicleType == 'dry_vans') {
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->with('dry_vans')->brokerlisting()->where('Listing_Type', 3)->where('user_id', $auth_user->id)->get();

    //             } else {
    //                 $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->brokerlisting()->where('user_id', $auth_user->id)->get();

    //             }
    //         } elseif ($request->has('get_comp_listing') && $request->get_comp_listing != null) {

    //             $CMP_ID = $request->get_comp_listing;
    //             $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->where('user_id', $CMP_ID)->get();

    //         } else {
    //             # code...
    //             $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Private_Listing', 1)->active()->brokerlisting()->where('user_id', $auth_user->id)->get();
    //         }

    //     }

    //     return view('livewire.backend.listing.user-listing', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'watchlist'))->layout('layouts.authorized');
    // }

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Search_vehicleType = null;
        $watchlist = WatchList::where('user_id', $auth_user->id)->get();

        // Base Query
        $query = AllUserListing::orderBy('id', 'DESC')
            ->where('Private_Listing', 1)
            ->active();

        // Add listing type constraints
        if ($auth_user->usr_type === 'Carrier') {
            $query->carrierlisting();
        } else {
            $query->brokerlisting()->where('user_id', $auth_user->id);
        }

        // Filter by Search_vehicleType
        if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
            $Search_vehicleType = $request->Search_vehicleType;

            // Map relationships and listing types
            $relationsMap = [
                'vehicles' => ['relation' => 'vehicles', 'type' => 1],
                'heavy_equipments' => ['relation' => 'heavy_equipments', 'type' => 2],
                'dry_vans' => ['relation' => 'dry_vans', 'type' => 3],
            ];

            if (isset($relationsMap[$Search_vehicleType])) {
                $relation = $relationsMap[$Search_vehicleType]['relation'];
                $type = $relationsMap[$Search_vehicleType]['type'];
                $query->with($relation)->where('Listing_Type', $type);
            }
        }

        // Filter by get_comp_listing
        elseif ($request->has('get_comp_listing') && $request->get_comp_listing != null) {
            $CMP_ID = $request->get_comp_listing;
            $query->where('user_id', $CMP_ID);
        }

        // Fetch Listings
        $Lisiting = $query->paginate($request->input('per_page', 10));

        return view('livewire.backend.listing.user-listing', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'watchlist'))
            ->layout('layouts.authorized');
    }
}