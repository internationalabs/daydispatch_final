<?php

namespace App\Http\Livewire\Backend\Profile;

use App\Services\ListingServices;
use App\Services\OrderRatings;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Profile\MyNetwork;
use App\Models\Profile\MyRating;
use App\Models\Listing\AllUserListing;
use App\Models\CertificateAssign;
use Illuminate\Support\Facades\DB;

class ViewProfile extends Component
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
        $Lisiting_Count = "";
        $Profile_ID = $request->user_id;
        $auth_user = Auth::guard('Authorized')->user();
        $User_Info = $this->orderRatings->getUserRating($Profile_ID);

        // dd($User_Info->ratings_avg_timeliness, $User_Info->toArray());
        // ratings_avg_timeliness

        $rating = [
            round($User_Info->ratings_avg_timeliness, 2),
            round($User_Info->ratings_avg_communication, 2),
            round($User_Info->ratings_avg_documentation, 2)
        ];
        // dd($rating);
        $avg_rating = array_sum($rating) / count($rating);

        $User_Rating = $this->orderRatings->getUserRatingRecords($Profile_ID);

        $Certificates_assigns = CertificateAssign::where('user_id', Auth::guard('Authorized')->user()->id)->get();
        // $Certificates_assigns = CertificateAssign::with('certificate_assigns')->where('user_id', $Profile_ID)->get();
        $results = DB::table('user_certificates as uc')
            ->join('certificates_assigns as ca', function ($join) {
                $join
                    // ->on('uc.id', '=', 'ca.certificate_id')
                    ->on('uc.user_id', '=', 'ca.user_id');
            })
            ->select('uc.USDOT_Certificate as USDOT_Certificate', 'uc.Insurance_Certificate as Insurance_Certificate', 'uc.W_Nine as W_Nine', 'uc.id', 'uc.user_id') // ya jo bhi columns chahiye
            // ->where('uc.certificate_id', $certificateId) // replace with actual variable or value
            ->where('uc.user_id', $Profile_ID) // replace with actual variable or value
            ->get();
        // dd($results);

        $Lisiting = $this->listingServices->getCompletedOrders();
        $CancelledLisiting = $this->listingServices->getCancelledOrders();
        $CMP_ID = $Profile_ID;
        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
            $Lisiting_Count = AllUserListing::active()->where('user_id', $CMP_ID)->get();
            $Lisiting_Count = count($Lisiting_Count);
            $CancelledLisiting = $CancelledLisiting->where('CMP_id', $auth_user->id);
        } else {
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
            $Lisiting_Count = AllUserListing::active()->where('user_id', $CMP_ID)->get();
            $Lisiting_Count = count($Lisiting_Count);
            $CancelledLisiting = $CancelledLisiting->where('user_id', $auth_user->id);
        }
        $LisitingCount = $this->listingServices->getOrderRequests();

        $Profile_Info = AuthorizedUsers::with(["insurance", "certificates"])->where('id', $Profile_ID)->firstOrFail();
        $Profile_Network = MyNetwork::where('CMP_ID', $Profile_ID)->where('user_id', $auth_user->id)->first();

        // dd($auth_user);

        return view('livewire.backend.profile.view-profile', compact('Profile_Info', 'Profile_ID', 'Profile_Network', 'User_Info', 'Lisiting', 'User_Rating', 'avg_rating', 'LisitingCount', 'Lisiting_Count', 'CancelledLisiting', 'Certificates_assigns', 'results'))->layout('layouts.authorized');
    }

    public function addMyNetwork(Request $request): RedirectResponse
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $business_type = Auth::guard('Authorized')->user()->usr_type;

        // dd($request->toArray(), $user_id);

        $MyNetwork_check = MyNetwork::where('CMP_ID', $request->Profile_ID)->where('user_id', $user_id)->first();
        if (is_null($MyNetwork_check) && $request->CMP_ID !== $user_id) {
            $MyNetwork = new MyNetwork();
            $MyNetwork->My_Network = $request->CMP_Find;
            $MyNetwork->Business_Type = $business_type;
            $MyNetwork->CMP_ID = $request->CMP_ID;
            $MyNetwork->user_id = $user_id;

            if ($MyNetwork->save()) {
                // return redirect()->route('View.Profile', [$request->Profile_ID])->with('Success!', "Your Network Saved.");
                return back()->with('Success!', "Your Network Saved.");
            } else {
                return back()->with('Error!', "404 Bad Request. Network not Saved!");
            }
        } else {
            return back()->with('Error!', "This Network is Already in Your Preferred List!");
        }
    }

    public function blockedMyNetwork(Request $request): RedirectResponse
    {

        $user_id = Auth::guard('Authorized')->user()->id;
        $business_type = Auth::guard('Authorized')->user()->usr_type;

        // dd($request->toArray(), $user_id);

        $MyNetwork_check = MyNetwork::where('CMP_ID', $request->Profile_ID)->where('user_id', $user_id)->first();
        if (is_null($MyNetwork_check) && $request->CMP_ID !== $user_id) {
            $MyNetwork = new MyNetwork();
            $MyNetwork->My_Network = $request->CMP_Find;
            $MyNetwork->Business_Type = $business_type;
            $MyNetwork->CMP_ID = $request->CMP_ID;
            $MyNetwork->status = 1;
            $MyNetwork->user_id = $user_id;

            if ($MyNetwork->save()) {
                // return redirect()->route('View.Profile', [$request->Profile_ID])->with('Success!', "Network Blocked.");
                return back()->with('Success!', "Your Network Saved.");
            } else {
                return back()->with('Error!', "404 Bad Request. Network not Blocked!");
            }
        } else {
            return back()->with('Error!', "This Network is Already in Your Blocked List!");
        }
    }

    public function updateMyNetwork(Request $request): RedirectResponse
    {

        $user_id = Auth::guard('Authorized')->user()->id;
        $Profile_ID = $request->CMP_ID;

        $MyNetwork = MyNetwork::where('CMP_ID', $Profile_ID)->where('user_id', $user_id)->first();
        $MyNetwork->status == 1 ? $MyNetwork->status = 0 : $MyNetwork->status = 1;
        if ($MyNetwork->update()) {
            return redirect()->route('View.Profile', [$Profile_ID])->with('Success!', "Network Updated.");
        } else {
            return back()->with('Error!', "404 Bad Request. Network not Blocked!");
        }
    }
}
