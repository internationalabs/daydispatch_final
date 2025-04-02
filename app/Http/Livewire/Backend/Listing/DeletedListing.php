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
use App\Models\Listing\WatchList;
use RuntimeException;
use Throwable;

class DeletedListing extends Component
{

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Search_vehicleType = null;
        $watchlist = WatchList::where('user_id', $auth_user->id)->get();

        // Retrieve soft-deleted listings
        $Lisiting = AllUserListing::orderBy('id', 'DESC')->with('paymentinfo')->withTrashed()->where('user_id', $auth_user->id)->where('Listing_Status', 'Deleted');

        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting->where('user_id', $auth_user->id);
        } else {
            $Lisiting->where('user_id', $auth_user->id);
        }

        $Lisiting = $Lisiting->get();

        // dd($Lisiting->toArray());

        return view('livewire.backend.listing.deleted-listing', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'watchlist'))->layout('layouts.authorized');
    }

    public function restoreDeletedListing(Request $request, $List_ID)
    {
        // dd($request->toArray());
        try {
            $Listed_ID = $request->List_ID;
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            $delete = AllUserListing::withTrashed()->where('id', $Listed_ID)->where('user_id', $user_id)->lockForUpdate()->first();
            // dd($delete->toArray());
            $delete->Listing_Status = "Listed";

            if ($delete->save()) {
                AllUserListing::withTrashed()->find($Listed_ID)->restore();
                $flag = DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $Listed_ID);
                if ($flag) {
                    DB::commit();
                    return redirect()->route('User.Listing')->with('Success!', "Your Order Has been Restored.");
                }
                DB::rollBack();
                return back()->with('Error!', "Something went Wrong with Notifications!");
            }

            DB::rollBack();
            return back()->with('Error!', "Your Order Hasn't Restored!.");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred while restoring your order. Please try again later.");
        }
    }

    public function deleteListing(Request $request, $listID)
    {
        try {
            $listing = AllUserListing::find($listID);

            if ($listing) {
                $listing->Listing_Status = 'Deleted';
                $listing->save();
                $listing->delete();

                return redirect()->route('Deleted.Listing')->with('success', "Your order has been deleted successfully!");
            } else {
                return back()->with('error', "The specified listing could not be found or you don't have permission to delete it.");
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('error', "An error occurred. Please try again later.");
        }
    }
}