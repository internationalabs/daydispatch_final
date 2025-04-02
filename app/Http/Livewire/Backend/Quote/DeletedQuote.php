<?php

namespace App\Http\Livewire\Backend\Quote;

use App\Services\ListingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\AllUserListing;
use App\Models\Quote\Order;
use App\Models\Listing\CancelledOrders;
use App\Models\Listing\WatchList;
use RuntimeException;
use Throwable;
use Illuminate\Http\Response;
use App\Models\Quote\CancelledOrdersQuote;
use App\Models\SidebarOption;

class DeletedQuote extends Component
{

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Search_vehicleType = null;
        $watchlist = WatchList::where('user_id', $auth_user->id)->get();
        $OptionName = SidebarOption::where('user_id', $auth_user->id)->get();
        $Lisiting = Order::withTrashed()->where('user_id', $auth_user->id)->where('Listing_Status', 'Deleted');

        // if ($auth_user->usr_type === 'Carrier') {
        //     $Lisiting->where('user_id', $auth_user->id);
        // } else {
        //     $Lisiting->where('user_id', $auth_user->id);
        // }

        $Lisiting = $Lisiting->paginate($request->input('per_page', 10));
        // dd($Lisiting);

        return view('livewire.backend.quote.deleted_quote', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'watchlist', 'OptionName'))->layout('layouts.authorizedQuote');
    }

    public function DeleteQuote(Request $request, $listID)
    {
        try {
            $listing = Order::find($listID);

            if ($listing) {
                $listing->Listing_Status = 'Deleted';
                $listing->save();
                $listing->delete();

                return redirect()->route('Deleted.Quote')->with('success', "Your quote has been deleted successfully!");
            } else {
                return back()->with('error', "The specified quote could not be found or you don't have permission to delete it.");
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('error', "An error occurred. Please try again later.");
        }
    }



    public function OrderCancelledQuote(Request $request)
    {
        try {
            $auth_user = Auth::guard('Authorized')->user();

            $order = Order::withTrashed()
                ->where('user_id', $auth_user->id)
                ->where('id', $request->quote_id)
                ->first();

            if ($order) {
                $order->Listing_Status = $request->history_status;
                $order->save();

                CancelledOrdersQuote::create([
                    'user_id' => $auth_user->id,
                    'order_id' => $request->quote_id,
                    'description' => $request->history_description,
                ]);

                return redirect()->back()->with('success', 'Order Cancelled successfully!');
            } else {
                return redirect()->back()->with('error', 'Order not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function GetCancelledReasone(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();

        $listID = $request->input('list_id');

        $reason = CancelledOrdersQuote::where('user_id', $auth_user->id)->where('order_id', $listID)->get();

        $content = json_encode($reason);
        return new Response($content, 200, ['Content-Type' => 'application/json']);
    }
}
