<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Services\ListingServices;
use App\Services\OrderRatings;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use App\Models\Listing\AllUserListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrier\RequestBroker;

class RequestedListing extends Component
{
    protected ListingServices $listingServices;
    protected OrderRatings $orderRatings;

    public function mount(ListingServices $listingServices, OrderRatings $orderRatings)
    {
        $this->listingServices = $listingServices;
        $this->orderRatings = $orderRatings;
    }

    public function render(Request $request)
    {
        $Search_vehicleType = null;
        $Profile_ID = $request->user_id;
        $auth_user = Auth::guard('Authorized')->user();
        $User_Info = $this->orderRatings->getUserRating($Profile_ID);
        $rating = [
            round($User_Info->ratings_avg_timeliness, 2),
            round($User_Info->ratings_avg_communication, 2),
            round($User_Info->ratings_avg_documentation, 2)
        ];
        // dd($rating);
        $avg_rating = array_sum($rating) / count($rating);
        $perPage = $request->input('per_page', 10);

        $User_Rating = $this->orderRatings->getUserRatingRecords($Profile_ID);
        // $Lisiting = $this->listingServices->getOrderRequests();
        $Lisiting = RequestBroker::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->active()->with('all_listing', 'requested_user')->has('all_listing');
        if ($auth_user->usr_type === 'Carrier') {
            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;
                if ($request->Search_vehicleType == 'vehicles') {
                    $Lisiting = RequestBroker::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->active()->where('status', 'Pending')->with('all_listing')->where('cmp_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 1);
                    })->paginate($perPage);
                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = RequestBroker::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->active()->where('status', 'Pending')->with('all_listing')->where('cmp_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 2);
                    })->paginate($perPage);
                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = RequestBroker::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->active()->where('status', 'Pending')->with('all_listing')->where('cmp_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 3);
                    })->paginate($perPage);
                } else {
                    $Lisiting = $Lisiting->where('cmp_id', $auth_user->id)->paginate($perPage);
                }
            } else {
                $Lisiting = $Lisiting->where('cmp_id', $auth_user->id)->paginate($perPage);
            }
        } else {
            if ($request->has('Search_vehicleType') && $request->Search_vehicleType != null) {
                $Search_vehicleType = $request->Search_vehicleType;
                if ($request->Search_vehicleType == 'vehicles') {
                    $Lisiting = RequestBroker::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->active()->where('status', 'Pending')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 1);
                    })->paginate($perPage);
                } elseif ($request->Search_vehicleType == 'heavy_equipments') {
                    $Lisiting = RequestBroker::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->active()->where('status', 'Pending')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 2);
                    })->paginate($perPage);
                } elseif ($request->Search_vehicleType == 'dry_vans') {
                    $Lisiting = RequestBroker::whereDoesntHave('all_listing.agreement')->orderBy('id', 'DESC')->active()->where('status', 'Pending')->with('all_listing')->where('user_id', $auth_user->id)->whereHas('all_listing', function ($query) {
                        $query->where('Listing_Type', 3);
                    })->paginate($perPage);
                } else {
                    $Lisiting = $Lisiting->where('user_id', $auth_user->id)->paginate($perPage);
                }
            } else {
                $Lisiting = $Lisiting->where('user_id', $auth_user->id)->paginate($perPage);
            }
        }

        foreach ($Lisiting as $listing) {
            $requested_user = $listing->requested_user;
            if ($requested_user) {
                $userRating = $this->orderRatings->getUserRating($requested_user->id);
                $requested_user->avg_rating = $userRating
                    ? (array_sum([
                        $userRating->ratings_avg_timeliness,
                        $userRating->ratings_avg_communication,
                        $userRating->ratings_avg_documentation,
                    ]) / 3)
                    : null;

                $requested_user->ratings_count = $this->orderRatings->getUserRatingRecords($requested_user->id)->count();
            }
        }
            // dd('oks', $Lisiting->toArray());

        return view('livewire.backend.listing.requested-listing', compact('Lisiting', 'Search_vehicleType', 'User_Rating', 'User_Info', 'avg_rating'))->layout('layouts.authorized');
    }

    public function CancelOrderRequest(Request $request, $List_ID): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user_id = Auth::guard('Authorized')->user()->id;
            // RequestBroker::where('order_id', $request->List_ID)
            //     ->where('user_id', $user_id)
            //     ->update([
            //         'is_cancel' => 1
            //     ]);
            RequestBroker::where('id', $request->List_ID)
                // ->where('cmp_id', $user_id)
                ->update([
                    'is_cancel' => 1
                ]);
            DB::commit();
            return back()->with('Success!', "Request Has Been Cancelled!");
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    public function viewCarrierRequest(Request $request)
    {
        $requestLoad = RequestBroker::with('all_listing')->find($request->request_ID);
        // dd($request->toArray(), $requestLoad->toArray());
        return $requestLoad;
    }
}
