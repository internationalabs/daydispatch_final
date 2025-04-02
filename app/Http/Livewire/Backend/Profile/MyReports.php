<?php

namespace App\Http\Livewire\Backend\Profile;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\WaitingForApproval;
use App\Models\Listing\Dispatch;
use App\Models\Listing\PickUpApprovals;
use App\Models\Listing\PickupOrders;
use App\Models\Listing\DeliverApprovals;
use App\Models\Listing\DeliverdOrders;
use App\Models\Listing\CompletedOrders;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\WatchList;
use App\Models\Profile\MyRating;
use App\Services\ListingServices;
use App\Services\OrderRatings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Carrier\RequestBroker;
use App\Models\Extras\MiscellenousItems;
use App\Models\Auth\AuthorizedUsers;

class MyReports extends Component
{
    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $orderCount = DayDispatchHelper::getOrderCounts($auth_user->id, $auth_user->usr_type);
        
        return view('livewire.backend.profile.myReports', compact('orderCount'))->layout('layouts.authorized');
    }

    public function getListingData(Request $request)
    {
        if ($request->has('UserID') && $request->UserID != null)
        {
            $auth_user = AuthorizedUsers::where('id', $request->UserID)->first();
            $usr_type = $auth_user->usr_type;
            $user_id = $auth_user->id;
        }
        else {
            $auth_user = Auth::guard('Authorized')->user();
            $usr_type = $auth_user->usr_type;
            $user_id = $auth_user->id;
        }
        // dd($request->toArray(), $usr_type, $user_id);
        $commonConditions = $usr_type === 'Carrier' ? 'CMP_id' : 'user_id';
        $Listed = $usr_type === 'Carrier'? AllUserListing::whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get() : AllUserListing::where('user_id', $user_id)->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get();

        if ($request->has('typeCheck')) 
        {
            if ($request->typeCheck == "Listed")
            {
                $data = [
                    'Listed' => $Listed,
                    ];
            }
            if ($request->typeCheck == "Requested")
            {
                $data = [
                    'Requested' => RequestBroker::with('all_listing')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                ];
            }
            // if ($request->typeCheck == "Waiting_Approval")
            // {
            //     $data = [
            //         'Waiting_Approval' => WaitingForApproval::with('all_listing')->where($commonConditions, $user_id)
            //             ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
            //         ];
            // }
            if ($request->typeCheck == "Dispatch")
            {
                $data = [
                    'Dispatch' => Dispatch::with('all_listing')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "PickUp_Approval")
            {
                $data = [
                    'PickUp_Approval' => PickUpApprovals::with('all_listing', 'waiting_users')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "PickUp")
            {
                $data = [
                    'PickUp' => PickupOrders::with('all_listing')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "Deliver_Approval")
            {
                $data = [
                    'Deliver_Approval' => DeliverApprovals::with('all_listing')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "Delivered")
            {
                $data = [
                    'Delivered' => DeliverdOrders::with('all_listing')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "Completed")
            {
                $data = [
                    'Completed' => CompletedOrders::with('all_listing')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "Cancelled")
            {
                $data = [
                    'Cancelled' => CancelledOrders::with('all_listing')->where($commonConditions, $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "Archived")
            {
                $data = [
                    'Archived' => AllUserListing::onlyTrashed()->where('user_id', $user_id)
                        ->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
            }
            if ($request->typeCheck == "WatchList")
            {
                $data = [
                    'WatchList' => WatchList::with('listing')->where('user_id', $user_id)->whereHas('listing', function($q){
                        $q->where('Listing_Status', 'Listed');
                    })->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(), //count for My Watchlist
                    ];
            }


            if ($request->typeCheck == "Waiting_Approval")
            {
                $data = [
                    'Waiting_Approval' => WaitingForApproval::withTrashed()->with('all_listing')->whereBetween('created_at',[Carbon::parse($request->start_Date)->format('Y-m-d'),Carbon::parse($request->end_Date)->format('Y-m-d')])->get(),
                    ];
                // $data = [
                //     'Waiting_Approval' => WaitingForApproval::where($commonConditions, $user_id)
                //         ->withTrashed()
                //         ->with('all_listing')
                //         ->whereBetween('created_at', [
                //             Carbon::parse($request->start_Date)->startOfDay(),
                //             Carbon::parse($request->end_Date)->endOfDay()
                //         ])
                //         ->get()
                // ];
            }
            // if ($request->typeCheck == "Waiting_Approval") {
            //     $data = [
            //         'Waiting_Approval' => WaitingForApproval::with(['all_listing' => function ($query) {
            //             $query->withTrashed()
            //             // ->where('user_id', $user_id)
            //                   ->where('Listing_Status', 'Waiting For Approval');
            //         }])
            //         // ->where('user_id', $user_id)  // Filter by user_id
            //         ->whereBetween('created_at', [
            //             Carbon::parse($request->start_Date)->format('Y-m-d'),
            //             Carbon::parse($request->end_Date)->format('Y-m-d')
            //         ])
            //         ->get(),
            //     ];
            // }            
            // dd($request->toArray(), 'ss', $request->typeCheck, $data['Waiting_Approval']->count());
            
            return view('livewire.backend.profile.loadReport', compact('data'));
        }
    }

    public function getCounts(Request $request)
    {
        dd('ok');
        // dd($request->toArray());
        
        $data = 2;
        
        return $data;
    }
}
