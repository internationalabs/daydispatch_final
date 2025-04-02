<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\PickupOrders;
use App\Services\ListingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\DeliverApprovals;
use Throwable;

class DeliverApproval extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Lisiting = $this->listingServices->getDeliverApprovalOrders();
        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
        } else {
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        }
        // dd($Lisiting->toArray());
        return view('livewire.backend.listing.deliver-approval', compact('Lisiting'))->layout('layouts.authorized');
    }

    public function OrderDeliveredApproval(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $DeliverApprovals = new DeliverApprovals();

            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'Deliver Approval';

            $RecordUpdate = PickupOrders::where('order_id', $request->List_ID)->first();

            $DeliverApprovals->user_id = $RecordUpdate->user_id;
            $DeliverApprovals->order_id = $request->List_ID;
            $DeliverApprovals->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $DeliverApprovals->save()) {
                $listingServices->OrderHistory('Deliver Approval', null, null, $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                if ($RecordUpdate->delete()) {
                    $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Deliver Approval', $request->List_ID);
                    if ($flag) {
                        DB::commit();
                        return redirect()->route('Deliver.Approval.Listing')->with('Success!', "Your Listing has been Delivered Successfully!");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Something went Wrong with Notifications!");
                }
                DB::rollBack();
                return back()->with('Error!', "Your Listing hasn't Waiting's!");
            }
            DB::rollBack();
            return back()->with('Error!', "Listing not Updated!");
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

    public function OrderNotDeliveredApproval(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $PickupOrders = new PickupOrders();
            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'PickUp';

            $RecordUpdate = DeliverApprovals::where('order_id', $request->List_ID)->first();

            $PickupOrders->user_id = $RecordUpdate->user_id;
            $PickupOrders->order_id = $request->List_ID;
            $PickupOrders->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $PickupOrders->save()) {
                $listingServices->RemoveOrderHistory('Deliver Approval', $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                if ($RecordUpdate->delete()) {
                    DB::commit();
                    return redirect()->route('PickUp.Listing')->with('Success!', "Your Listing has been Delivered Successfully!");
                }
                DB::rollBack();
                return back()->with('Error!', "Your Listing hasn't Waiting's!");
            }
            DB::rollBack();
            return back()->with('Error!', "Listing not Updated!");
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

}
