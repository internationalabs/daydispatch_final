<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Models\Agents\AgentRevenue;
use App\Models\Auth\AuthorizedAgent;
use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\DeliverApprovals;
use App\Models\Listing\PickupOnlineBol;
use App\Models\Listing\PickupOrders;
use App\Services\ListingServices;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\AllUserListing;
use App\Models\Listing\ArchiveListing;
use App\Models\Listing\DeliverdOrders;
use Illuminate\Pagination\LengthAwarePaginator;

class DeliverdListing extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render(Request $request)
    {

        $auth_user = Auth::guard('Authorized')->user();
        $Lisiting = $this->listingServices->getDeliveredOrders();
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
        return view('livewire.backend.listing.deliverd-listing', compact('Lisiting'))->layout('layouts.authorized');
    }

    public function OrderDelivered(Request $request, ListingServices $listingServices): RedirectResponse
    {
        // try {
        //     DB::beginTransaction();

           $auth_user = Auth::guard('Authorized')->user();
            $existingOnlineBol = PickupOnlineBol::where('order_id', $request->List_ID)->with('pickup_online_bol_imgs', 'pickup_online_bol_items')->first();
            if (empty($existingOnlineBol) && $auth_user->usr_type === 'Carrier') {
                return redirect()->route('PostPickup.Bol.Listing',[$request->List_ID]);
            }

            $DeliverdOrders = new DeliverdOrders();

            $AllUserListing = AllUserListing::where('id', $request->List_ID)->first();
            $AllUserListing->Listing_Status = 'Delivered';

            // $RecordUpdate = DeliverApprovals::where('order_id', $request->List_ID)->first();
            $RecordUpdate = PickupOrders::withTrashed()->where('order_id', $request->List_ID)->first();


            $DeliverdOrders->user_id = $RecordUpdate->user_id;
            $DeliverdOrders->order_id = $request->List_ID;
            $DeliverdOrders->CMP_id = $RecordUpdate->CMP_id;

            $auth_user = AuthorizedUsers::where('id', $RecordUpdate->user_id)->first();
            $this->AgentReward($auth_user->ref_code, $request->List_ID);

            if ($AllUserListing->update() && $DeliverdOrders->save()) {
                $listingServices->OrderHistory('Delivered', null, null, $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                if ($RecordUpdate->delete()) {
                    $flag = DayDispatchHelper::SendNotificationOnStatusChanged('Delivered', $request->List_ID);
                    if ($flag) {
                        DB::commit();
                        return redirect()->route('Delivered.Listing')->with('Success!', "Your Listing has been Delivered Successfully!");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Something went Wrong with Notifications!");
                }
                DB::rollBack();
                return back()->with('Error!', "Your Listing hasn't Waiting's!");
            }
            DB::rollBack();
            return back()->with('Error!', "Listing not Updated!");

        // } catch (Exception $e) {
        //     dd($e->getMessage());
        //     DB::rollBack();
        //     Log::error($e->getMessage());
        //     return back()->with('Error!', "An error occurred. Please try again later.");
        // }
    }

    public function OrderNotDelivered(Request $request, ListingServices $listingServices): RedirectResponse
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
                $listingServices->RemoveOrderHistory('PickUp', $request->List_ID, $RecordUpdate->user_id, $RecordUpdate->CMP_id);
                if ($RecordUpdate->delete()) {
                    DB::commit();
                    return redirect()->route('PickUp.Listing')->with('Success!', "Your Listing has been Delivered Successfully!");
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

    private function AgentReward($Ref_Code, $Order_ID): void
    {
        if ($Ref_Code === null) {
            return;
        }

        try {
            DB::beginTransaction();

            $Agent = AuthorizedAgent::where('ref_code', $Ref_Code)->first();
            AgentRevenue::create([
                'Agent_Reward' => 10,
                'order_id' => $Order_ID,
                'user_id' => $Agent->id
            ]);

            DB::commit();

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
