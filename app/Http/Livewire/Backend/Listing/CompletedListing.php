<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\DeliverdOrders;
use App\Services\ListingServices;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\CompletedOrders;

class CompletedListing extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices)
    {
        $this->listingServices = $listingServices;
    }

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Lisiting = $this->listingServices->getCompletedOrders();
        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
        } else {
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        }
        return view('livewire.backend.listing.completed-listing', compact('Lisiting'))->layout('layouts.authorized');
    }

    public function OrderCompleted(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $CompletedOrders = new CompletedOrders();
            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'Completed';
            $RecordUpdate = DeliverdOrders::where('order_id', $request->List_ID)->first();

            $CompletedOrders->user_id = $RecordUpdate->user_id;
            $CompletedOrders->order_id = $request->List_ID;
            $CompletedOrders->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $CompletedOrders->save()) {
                if ($RecordUpdate->delete()) {
                    $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Completed', $request->List_ID);
                    $listingServices->OrderHistory('Completed', null, null, $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                    if ($flag) {
                        DB::commit();
                        return redirect()->route('Completed.Listing')->with('Success!', "Your Listing has been Completed Successfully!");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Something went Wrong with Notifications!");
                }
                DB::rollBack();
                return back()->with('Error!', "Your Listing hasn't Waiting's!");
            }
            DB::rollBack();
            return back()->with('Error!', "Listing not Updated!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    public function OrderNotCompleted(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $DeliverdOrders = new DeliverdOrders();
            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'Delivered';
            $RecordUpdate = CompletedOrders::where('order_id', $request->List_ID)->first();

            $DeliverdOrders->user_id = $RecordUpdate->user_id;
            $DeliverdOrders->order_id = $request->List_ID;
            $DeliverdOrders->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $DeliverdOrders->save()) {
                $listingServices->RemoveOrderHistory('Completed', $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                if ($RecordUpdate->delete()) {
                    DB::commit();
                    return redirect()->route('Delivered.Listing')->with('Success!', "Your Listing has been Delivered Successfully!");
                }
                DB::rollBack();
                return back()->with('Error!', "Your Listing hasn't Waiting's!");
            }
            DB::rollBack();
            return back()->with('Error!', "Listing not Updated!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

}
