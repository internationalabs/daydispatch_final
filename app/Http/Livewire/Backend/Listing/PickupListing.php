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
use App\Models\Extras\MiscellenousItems;
use App\Models\Listing\{AllUserListing, Dispatch, PickUpApprovals, PickupOrders};
use Throwable;
use App\Models\Listing\OnlineBol;
use Illuminate\Pagination\LengthAwarePaginator;

class PickupListing extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $idsArray = OnlineBol::where('user_id', $auth_user->id)->pluck('order_id')->toArray();

        $Lisiting = $this->listingServices->getPickupOrders();
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
        return view('livewire.backend.listing.pickup-listing', compact('Lisiting', 'idsArray'))->layout('layouts.authorized');
    }

    public function OrderPickupApproval(Request $request, ListingServices $listingServices): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $PickUpApprovals = new PickUpApprovals();

            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'PickUp Approval';

            $RecordUpdate = Dispatch::where('order_id', $request->List_ID)->first();

            $PickUpApprovals->user_id = $RecordUpdate->user_id;
            $PickUpApprovals->order_id = $request->List_ID;
            $PickUpApprovals->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $PickUpApprovals->save()) {
                $listingServices->OrderHistory('PickUp Approval', null, null, $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                if ($RecordUpdate->delete()) {
                    $flag = DayDispatchHelper::SendNotificationOnStatusChanged('PickUp Approval', $request->List_ID);
                    if ($flag) {
                        DB::commit();
                        return redirect()->route('PickUp.Approval.Listing')->with('Success!', "Your Listing has been PickUp Successfully!");
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

    public function OrderNotPickupApproval(Request $request, ListingServices $listingServices): RedirectResponse
    {
        // dd('ok');
        try {
            DB::beginTransaction();

            $Dispatch = new Dispatch();

            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'Dispatch';

            // $RecordUpdate = PickUpApprovals::where('order_id', $request->List_ID)->first();
            $RecordUpdate = PickupOrders::where('order_id', $request->List_ID)->first();


            $Dispatch->user_id = $RecordUpdate->user_id;
            $Dispatch->order_id = $request->List_ID;
            $Dispatch->CMP_id = $RecordUpdate->CMP_id;

            if ($AllUserListing->update() && $Dispatch->save()) {
                // $listingServices->RemoveOrderHistory('PickUp Approval', $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                $listingServices->RemoveOrderHistory('PickUp', $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);

                if ($RecordUpdate->delete()) {
                    DB::commit();
                    // return redirect()->route('Dispatch.Listing')->with('Success!', "Your Listing has been PickUp Successfully!");
                    return redirect()->route('Dispatch.Listing')->with('Success!', "Your Listing has been Dispatch Successfully!");

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

    public function AddMiscellaneous(Request $request): RedirectResponse
    {
        // dd($request->toArray());
        try {
            DB::beginTransaction();

            $user_id = Auth::guard('Authorized')->user()->id;
            $MiscellenousItems = new MiscellenousItems();
            $MiscellenousItems->Item_Name = $request->Misc_Item;
            $MiscellenousItems->Other = $request->Other_Misc_Item;
            $MiscellenousItems->Item_Price = (int) $request->Misc_Item_Amount;
            $MiscellenousItems->order_id = $request->Listed_ID;
            $MiscellenousItems->user_id = $user_id;

            if ($MiscellenousItems->save()) {
                DB::commit();
                return redirect()->back()->with('Success!', "Your Misc. Item Added Successfully!");
            }
            DB::rollBack();
            return back()->with('Error!', "Bad Request 404");
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }

}
