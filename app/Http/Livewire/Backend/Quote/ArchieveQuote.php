<?php

namespace App\Http\Livewire\Backend\Quote;

use App\Helpers\DayDispatchHelper;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Quote\Order;

class ArchieveQuote extends Component
{
    // public function render()
    // {
    //     $user_id = Auth::guard('Authorized')->user()->id;

    //     $Lisiting = AllUserListing::where('Listing_Status', 'Archived')->brokerlisting()->where('user_id', $user_id)->get();

    //     return view('livewire.backend.listing.archieve-listing', compact('Lisiting'))->layout('layouts.authorized');
    // }

    

    public function restoreQuote(Request $request)
    {
        try {
            $Listed_ID = $request->List_ID;
            $user_id = Auth::guard('Authorized')->user()->id;

            DB::beginTransaction();

            $archive = Order::withTrashed()
                ->where('id', $Listed_ID)
                ->where('user_id', $user_id)
                ->lockForUpdate()
                ->first();

            if ($archive) {
                $archive->Listing_Status = "New Quote";
                $archive->restore();
            } else {
                return back()->with('Error!', "Order not found or you don't have permission to restore it.");
            }

            DB::commit();

            return redirect()->route('New.Order')->with('success', 'Your order has been restored successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('Error!', "An error occurred while restoring your order. Please try again later.");
        }
    }

    // public function restoreQuote(Request $request)
    // {
    //     try {
    //         $listedId = $request->List_ID;
    //         $userId = Auth::guard('Authorized')->user()->id;

    //         DB::beginTransaction();

    //         $archive = Order::withTrashed()
    //             ->where('id', $listedId)
    //             ->where('user_id', $userId)
    //             ->lockForUpdate()
    //             ->first();

    //         if (!$archive) {
    //             return back()->with('error', "Order not found or you don't have permission to restore it.");
    //         }

    //         switch ($archive->Listing_Status) {
    //             case 'Cancelled':
    //                 $archive->Listing_Status = "Book Order";
    //                 $archive->save();
    //                 break;
    //             case 'Deleted':
    //                 $archive->Listing_Status = "New Quote";
    //                 $archive->restore();
    //                 break;
    //             default:
    //                 return back()->with('error', "Order not found or you don't have permission to restore it.");
    //         }

    //         DB::commit();

    //         return redirect()->route('New.Order')->with('success', 'Your order has been restored successfully!');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error($e->getMessage());
    //         return back()->with('error', "An error occurred while restoring your order. Please try again later.");
    //     }
    // }

}
