<?php

namespace App\Http\Livewire\Backend\Profile;

use App\Models\Listing\AllUserListing;
use App\Models\Profile\MyRating;
use App\Services\ListingServices;
use App\Services\OrderRatings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserRatings extends Component
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
        $auth_user = Auth::guard('Authorized')->user();
        $User_Info = $this->orderRatings->getUserRating();
        $My_Rating = [];

        $rating = [
            round($User_Info->ratings_avg_timeliness, 2),
            round($User_Info->ratings_avg_communication, 2),
            round($User_Info->ratings_avg_documentation, 2)
        ];
        $avg_rating = array_sum($rating) / count($rating);

        $User_Rating = $this->orderRatings->getUserRatingRecords();

        $Lisiting = $this->listingServices->getCompletedOrders();
        $DeliveredLisiting = $this->listingServices->getDeliveredOrders();
        $CancelledLisiting = $this->listingServices->getCancelledOrders();

        if ($auth_user->usr_type === 'Carrier') {
            $My_Rating = MyRating::with('authorized_user', 'rated_user', 'all_listing')
                ->where('user_id', $auth_user->id)
                ->orderBy('id', 'DESC')
                ->get();
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
            $CancelledLisiting = $CancelledLisiting->where('CMP_id', $auth_user->id);
        } else {
            $My_Rating = MyRating::with('authorized_user', 'rated_user', 'all_listing')
                ->where('CMP_ID', $auth_user->id)
                ->orderBy('id', 'DESC')
                ->get();
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
            $CancelledLisiting = $CancelledLisiting->where('user_id', $auth_user->id);
        }
        // dd($User_Rating->toArray());
        return view('livewire.backend.profile.user-ratings', compact('User_Info', 'Lisiting', 'User_Rating', 'avg_rating', 'My_Rating', 'CancelledLisiting', 'DeliveredLisiting'))->layout('layouts.authorized');
    }

    public function UserRating(Request $request): RedirectResponse
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $MyRatings = MyRating::where('order_id', $request->get_Listed_ID)->where('CMP_ID', $request->get_Profile_ID)->where('user_id', $user_id)->first();
        
        // $Listing_Update = AllUserListing::where('id', $request->get_Listed_ID)->first();
        $Listing_Update = AllUserListing::findOrFail($request->get_Listed_ID);
        // dd($Listing_Update);
        $Listing_Update->Is_Rate = 1;
        if (is_null($MyRatings)) {
            $MyRatings = new MyRating();
            $MyRatings->Rating = $request->Rating;
            $MyRatings->Timeliness = $request->Timeliness;
            $MyRatings->Communication = $request->Communication;
            $MyRatings->Documentation = $request->Documentation;
            $MyRatings->Rating_Comments = $request->Rating_Comments;
            if (Auth::guard('Authorized')->user()->usr_type === 'Carrier') {
                $MyRatings->CMP_ID = $request->get_Profile_ID;
                $MyRatings->user_id = $Listing_Update->user_id;
            } else {
                $MyRatings->CMP_ID = $Listing_Update->user_id;
                $MyRatings->user_id = $request->get_Profile_ID;
            }
            // $MyRatings->user_id = $user_id;
            $MyRatings->order_id = $request->get_Listed_ID;

            if ($MyRatings->save() && $Listing_Update->update()) {
                return redirect()->route('View.Profile.Ratings', [$user_id])->with('Success!', "Your Ratings Saved For This Profile.");
            }
            return back()->with('Error!', "404 Bad Request. Contact not Added!");
        }

        $MyRatings->Rating = $request->Rating;
        $MyRatings->Timeliness = $request->Timeliness;
        $MyRatings->Communication = $request->Communication;
        $MyRatings->Documentation = $request->Documentation;
        $MyRatings->Rating_Comments = $request->Rating_Comments;

        if ($MyRatings->update() && $Listing_Update->update()) {
            return redirect()->route('View.Profile.Ratings', [$user_id])->with('Success!', "Your Ratings Updated For This Profile.");
        }
        return back()->with('Error!', "404 Bad Request. Contact not Added!");
    }

    public function UserRatingReplied(Request $request): RedirectResponse
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        MyRating::where('id', $request->get_Rate_ID)
            ->update(
                [
                    'Rating_Replied' => $request->Rating_Replied
                ]
            );
        return redirect()->route('View.Profile.Ratings', [$user_id])->with('Success!', "Your Ratings Updated For This Profile.");
    }
}
