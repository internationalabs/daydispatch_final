<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Listing\AllUserListing;

class ExpiredListing extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        // $Lisiting = AllUserListing::has('routes', 'paymentinfo')->orderBy('id', 'DESC')->expired()->brokerlisting()->where('user_id', $user_id)->get();
        $Lisiting = AllUserListing::with(['routes', 'paymentinfo'])
            ->whereHas('routes')
            ->whereHas('paymentinfo')
            ->orderBy('id', 'DESC')
            ->expired()
            ->brokerlisting()
            ->where('user_id', $user_id)
            ->get();
        // dd($Lisiting->toArray());

        return view('livewire.backend.listing.expired-listing', compact('Lisiting'))->layout('layouts.authorized');
    }

    public function ReEnlistListing(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $ExpiredListing = AllUserListing::expired()->where('id', $request->List_ID)->first();
            $ExpiredListing->Listing_Status = 'Listed';
            $ExpiredListing->expire_at = Carbon::now()->addDays(5);

            if ($ExpiredListing->update()) {
                $flag = DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $request->List_ID);
                if ($flag) {
                    DB::commit();
                    return back()->with('Success!', "Your Expired Listing Re-Enlisted Successfully!");
                }
                DB::rollBack();
                return back()->with('Error!', "Something went Wrong with Notifications!");
            }

            DB::rollBack();
            return back()->with('Error!', "Failed to Re-Enlist your Expired Listing.");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred. Please try again later.");
        }
    }
}
