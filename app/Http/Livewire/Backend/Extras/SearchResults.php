<?php

namespace App\Http\Livewire\Backend\Extras;

use App\Models\Listing\CompletedOrders;
use App\Models\Listing\AllUserListing;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrier\RequestBroker;
use App\Models\Listing\WaitingForApproval;
use App\Models\Listing\PickupOrders;
use App\Models\Listing\PickUpApprovals;
use App\Models\Listing\DeliverApprovals;
use App\Models\Listing\DeliverdOrders;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\Dispatch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\ListingServices;

class SearchResults extends Component
{
    protected ListingServices $listingServices;
    
    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = Auth::guard('Authorized')->user()->id;
        $From = '';
        $Lisiting = [];

        if ($request->has('Search_Value')) {
            $Search = $request->Search_Value;
            $From = 'listing';
            
            
            if ($auth_user->usr_type === 'Carrier') {
                // $completed = $this->listingServices->getProfileCompCompleteList($user_id, $Search);
                // $dispatched = $this->listingServices->getDispatchesOrdersSearch($user_id, $Search);
                // Completed-Listing
                $completed = CompletedOrders::where('CMP_id', $user_id)->with('authorized_user')->has('all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Dispatched-Listing
                $dispatched = Dispatch::where('CMP_id', $user_id)->with('authorized_user')->has('all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                $requested = RequestBroker::active()->where('CMP_id', $user_id)->with('authorized_user')->has('all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                $waitingForApproval = WaitingForApproval::where('CMP_id', $user_id)->with('authorized_user')->has('all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Pickup-Approval-Listing
                $pickupApproval = PickUpApprovals::where('CMP_id', $user_id)->with('authorized_user')->has('all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Pickup-Listing
                $pickupOrders = PickupOrders::where('CMP_id', $user_id)->with('authorized_user')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Deliver-Approval-Listing
                $deliverApprovalListing = DeliverApprovals::where('CMP_id', $user_id)->with('authorized_user', 'all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Delivered-Listing
                $deliverdOrders = DeliverdOrders::where('CMP_id', $user_id)->with('authorized_user', 'all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Delivered-Listing
                $cancelledOrders = CancelledOrders::where('CMP_id', $user_id)->with('authorized_user', 'all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
            }
            else {
                // $completed = $this->listingServices->getProfileCompCompleteList($user_id, $Search);
                // $dispatched = $this->listingServices->getDispatchesOrdersSearch($user_id, $Search);
                // Completed-Listing
                $completed = CompletedOrders::where('user_id', $user_id)->with('authorized_user')->has('all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Dispatched-Listing
                $dispatched = Dispatch::where('user_id', $user_id)->with('authorized_user')->has('all_listing')->whereHas('authorized_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                $requested = RequestBroker::active()->where('user_id', $user_id)->with('requested_user')->has('all_listing')->whereHas('requested_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                $waitingForApproval = WaitingForApproval::where('user_id', $user_id)->with('waiting_users')->has('all_listing')->whereHas('waiting_users', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Pickup-Approval-Listing
                $pickupApproval = PickUpApprovals::where('user_id', $user_id)->with('pickup_approval_user')->has('all_listing')->whereHas('pickup_approval_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Pickup-Listing
                $pickupOrders = PickupOrders::where('user_id', $user_id)->with('pickup_user')->has('all_listing')->whereHas('pickup_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Deliver-Approval-Listing
                $deliverApprovalListing = DeliverApprovals::where('user_id', $user_id)->with('deliver_approval_user', 'all_listing')->whereHas('deliver_approval_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Delivered-Listing
                $deliverdOrders = DeliverdOrders::where('user_id', $user_id)->with('delivered_user', 'all_listing')->whereHas('delivered_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();
                // Delivered-Listing
                $cancelledOrders = CancelledOrders::where('user_id', $user_id)->with('cancel_user', 'all_listing')->whereHas('cancel_user', function ($q) use ($Search) {
                    $q->where('Company_Name', 'LIKE', '%'.$Search.'%');
                })->get();

            }

            $Lisiting = [
                'completed' => $completed,
                'requested' => $requested,
                'dispatched' => $dispatched,
                'waitingForApproval' => $waitingForApproval,
                'pickupApproval' => $pickupApproval,
                'pickupOrders' => $pickupOrders,
                'deliverApprovalListing' => $deliverApprovalListing,
                'deliverdOrders' => $deliverdOrders,
                'cancelledOrders' => $cancelledOrders,
            ];
            
            // dd($Lisiting);
        }
        elseif ($request->has('Search_Bar'))
        {
            $Search = $request->Search_Bar;
            $From = 'header';
            $Lisiting = AuthorizedUsers::where('Company_Name', 'LIKE', '%'.$Search.'%')->get();
        }

        // dd('deliverApprovalListing', $deliverApprovalListing->toArray(), 'Lisiting', $Lisiting);
        
        return view('livewire.backend.extras.search-results', compact('Lisiting', 'From'))->layout('layouts.authorized');
    }
}