<?php

namespace App\Http\Livewire\Backend\Listing;

use App\Helpers\DayDispatchHelper;
use App\Models\Listing\ArchiveListing;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Listing\AllUserListing;

class ArchieveListing extends Component
{
    public function render(Request $request)
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $per_page = $request->input('per_page', 10);
        // $Lisiting = AllUserListing::orderBy('id', 'DESC')->where('Listing_Status', 'Archived')->brokerlisting()->where('user_id', $user_id)->get();
        $Lisiting = ArchiveListing::orderBy('id', 'DESC')
        ->with('all_listing') // Eager load the relationship
        ->where('user_id', $user_id) // Filter by user_id
        ->paginate($per_page);
        // dd($Lisiting);
        return view('livewire.backend.listing.archieve-listing', compact('Lisiting'))->layout('layouts.authorized');
    }

    public function archiveListing(Request $request, $List_ID): RedirectResponse
    {
        try {
            // $Listed_ID = (int)$request->List_ID;
            $Listed_ID = (int) $List_ID;
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            // $archive = AllUserListing::where('id', $Listed_ID)->where('user_id', $user_id)->lockForUpdate()->first();
            // $archive->Listing_Status = "Archived";

            $ArchiveListing = new ArchiveListing();
            $ArchiveListing->user_id = $user_id;
            $ArchiveListing->order_id = $Listed_ID;

            // if ($archive->update() && $ArchiveListing->save()) {
            if ($ArchiveListing->save()) {
                // AllUserListing::find($Listed_ID)->delete();
                $flag = DayDispatchHelper::SendNotificationOnStatusChanged2('Archived', $Listed_ID);
                if ($flag) {
                    DB::commit();
                    return redirect()->route('User.Archived.Listing')->with('Success!', "Your Order Has been Archived.");
                }
                DB::rollBack();
                return back()->with('Error!', "Something went Wrong with Notifications!");
            }

            DB::rollBack();
            return back()->with('Error!', "Your Order Hasn't Archived!.");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('Error!', "An error occurred while archiving your order. Please try again later.");
        }
    }

    public function restoreListing(Request $request): RedirectResponse
    {
        try {
            $Listed_ID = $request->List_ID;
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            // $archive = AllUserListing::withTrashed()->where('id', $Listed_ID)->where('user_id', $user_id)->lockForUpdate()->first();
            // $archive->Listing_Status = "Listed";
            $RecordUpdate = ArchiveListing::where('order_id', $Listed_ID)->where('user_id', $user_id)->first();

            // if ($archive->update() && $RecordUpdate->delete()) {
            if ($RecordUpdate->delete()) {
                // AllUserListing::withTrashed()->find($Listed_ID)->restore();
                $flag = DayDispatchHelper::SendNotificationOnStatusChanged2('Listed', $Listed_ID);
                if ($flag) {
                    DB::commit();
                    return redirect()->route('User.Archived.Listing')->with('Success!', "Your Order Has been Restored.");
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
}