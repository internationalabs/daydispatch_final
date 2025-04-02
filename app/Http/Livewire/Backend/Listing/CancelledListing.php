<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\WaitingForApproval;
use App\Services\ListingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\CancelledOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use RuntimeException;
use Throwable;

class CancelledListing extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Lisiting = $this->listingServices->getCancelledOrders();
        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
        } else {
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        }
        $Lisiting = new LengthAwarePaginator(
            $Lisiting->forPage($request->input('page', 1), $request->input('per_page', 10)), 
            $Lisiting->count(), 
            $request->input('per_page', 10), 
            $request->input('page', 1), 
            ['path' => $request->url(), 'query' => $request->query()]
        );
        // dd($Lisiting->toArray());
        return view('livewire.backend.listing.cancelled-listing', compact('Lisiting'))->layout('layouts.authorized');
    }

    public function CancelListing(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            $user_id = Auth::guard('Authorized')->user()->id;

            return DB::transaction(static function () use ($request, $listingServices, $user_id) {
                $CancelledOrders = new CancelledOrders();

                $AllUserListing = AllUserListing::where('id', $request->get_Listed_ID)->first();
                $AllUserListing->Listing_Status = 'Cancelled';

                if ($AllUserListing->update()) {
                    $CancelledOrders->user_id = $request->get_User_ID;
                    $CancelledOrders->order_id = $request->get_Listed_ID;
                    $CancelledOrders->CMP_id = $request->get_CMP_ID;
                    $CancelledOrders->Main_Reason = $request->Main_Reason;
                    $CancelledOrders->Detail_Reason = $request->Detail_Reason;
                    $CancelledOrders->Cancelled_By = $user_id;
                    $listingServices->OrderHistory('Cancelled', $user_id, null, $request->get_Listed_ID, $request->get_User_ID, $request->get_CMP_ID);

                    if ($CancelledOrders->save()) {
                        $flag = DayDispatchHelper::SendNotificationOnStatusChanged2('Cancelled', $request->get_Listed_ID);
                        $cancelOrder = DayDispatchHelper::OrderCancel($request->get_Order_Status, $request->get_Listed_ID, $request->get_User_ID, $request->get_CMP_ID);

                        if ($flag && $cancelOrder) {
                            return redirect()->route('Cancelled.Listing')->with('Success!', "Your Order has been Cancelled Successfully!");
                        }
                        DB::rollBack();
                        return back()->with('Error!', "Something went Wrong with Notifications!");
                    }

                    throw new RuntimeException("Error in saving CancelledOrders");
                }

                throw new RuntimeException("Error in updating AllUserListing");
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    public function CancelWaitingRequest(Request $request): RedirectResponse
    {
        try {
            return DB::transaction(static function () use ($request) {
                $AllUserListing = AllUserListing::where('id', $request->get_Listed_ID)->first();
                $AllUserListing->Listing_Status = 'Listed';
                $user_id = Auth::guard('Authorized')->user()->id;

                $CancelledOrders = new CancelledOrders();

                if ($AllUserListing->update()) {
                    $RecordUpdate = WaitingForApproval::where('order_id', $request->get_Listed_ID)->first();

                    if ($RecordUpdate->delete()) {
                        $CancelledOrders->user_id = $request->get_User_ID;
                        $CancelledOrders->order_id = $request->get_Listed_ID;
                        $CancelledOrders->CMP_id = $request->get_CMP_ID;
                        $CancelledOrders->Main_Reason = $request->Main_Reason;
                        $CancelledOrders->Detail_Reason = $request->Detail_Reason;
                        $CancelledOrders->Cancelled_By = $user_id;
                        if ($CancelledOrders->save()) {
                            // return back()->with('Success!', "Your Order Request has been Cancelled Successfully!");
                            return redirect()->route('Cancelled.Listing')->with('Success!', "Your Order has been Cancelled Successfully!");
                        }
                    }
                    throw new RuntimeException("Error in deleting RecordUpdate");
                }

                throw new RuntimeException("Error in updating AllUserListing");
            });
        } catch (Throwable $e) {
            dd($e->getMessage());
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }
}
