<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Services\ListingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\{AllUserListing, OnlineBol, PickUpApprovals, PickupOrders};
use Throwable;
use App\Models\Listing\Dispatch;

class PickupApproval extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Lisiting = $this->listingServices->getPickupApprovalOrders();

        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
        } else {
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        }

        return view('livewire.backend.listing.pickup-approval', compact('Lisiting'))->layout('layouts.authorized');
    }

    public function OrderPickup(Request $request, ListingServices $listingServices): RedirectResponse
    {
        $auth_user = Auth::guard('Authorized')->user();
        $existingOnlineBol = OnlineBol::where('order_id', $request->List_ID)->with('online_bol_imgs', 'online_bol_items')->first();
        if (empty($existingOnlineBol) && $auth_user->usr_type === 'Carrier') {
            return redirect()->route('User.Bol.Listing',[$request->List_ID]);
        }
        try {
            DB::beginTransaction();

            $PickupOrders = new PickupOrders();

            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'PickUp';

            // $RecordUpdate = PickUpApprovals::where('order_id', $request->List_ID)->first();
            $RecordUpdate = Dispatch::where('order_id', $request->List_ID)->first();


            $PickupOrders->user_id = $RecordUpdate->user_id;
            $PickupOrders->order_id = $request->List_ID;
            $PickupOrders->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $PickupOrders->save()) {
                $listingServices->OrderHistory('PickUp', null, null, $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);

                if ($RecordUpdate->delete()) {
                    $flag = DayDispatchHelper::SendNotificationOnStatusChanged('PickUp', $request->List_ID);

                    if ($flag) {
                        DB::commit();
                        return redirect()->route('PickUp.Listing')->with('Success!', "Your Listing has been PickUp Successfully!");
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

    public function OrderNotPickup(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $PickUpApprovals = new PickUpApprovals();

            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'PickUp Approval';

            $RecordUpdate = PickupOrders::where('order_id', $request->List_ID)->first();

            $PickUpApprovals->user_id = $RecordUpdate->user_id;
            $PickUpApprovals->order_id = $request->List_ID;
            $PickUpApprovals->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $PickUpApprovals->save()) {
                $listingServices->RemoveOrderHistory('PickUp', $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);

                if ($RecordUpdate->delete()) {
                    DB::commit();
                    return redirect()->route('PickUp.Approval.Listing')->with('Success!', "Your Listing hasn't been PickUp Successfully!");
                }

                DB::rollBack();
                return back()->with('Error!', "Your Listing hasn't Waiting's!");
            }

            DB::rollBack();
            return back()->with('Error!', "Listing not Updated!");
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred: " . $e->getMessage());
        }
    }

}
