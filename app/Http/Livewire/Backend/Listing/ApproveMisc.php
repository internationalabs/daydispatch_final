<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\WaitingForApproval;
use App\Models\Extras\MiscellenousItems;
use App\Services\ListingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RuntimeException;
use Throwable;

class ApproveMisc extends Component
{

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = $auth_user->id;
        $Listing = MiscellenousItems::orderBy('id', 'DESC')->where('status', 0)->with('authorized_user', 'all_listing')->whereHas('all_listing', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return view('livewire.backend.listing.approve-misc', compact('Listing'))->layout('layouts.authorized');
    }

    public function updateMiscStatus($List_ID, $Status)
    {
        $Listing = MiscellenousItems::find($List_ID);
        $Listing->status = $Status;
        $Listing->save();

        $data = "Status Changed";

        return back();
    }
}