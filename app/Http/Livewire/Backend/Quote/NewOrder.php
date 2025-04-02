<?php

namespace App\Http\Livewire\Backend\Quote;

use App\Models\History\OrderHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile\MyContract;
use App\Models\Quote\Order;
use App\Models\SidebarOption;
use Illuminate\Http\Request;
use App\Models\Listing\AllUserListing;
use App\Models\Quote\CancelledOrdersQuote;

class NewOrder extends Component
{
    public function render(Request $request)
    {
        $slot = '';
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = Auth::guard('Authorized')->user()->id;
        $Search_vehicleType = null;
        $OptionName = SidebarOption::where('user_id', $user_id)->get();

        $Lisiting = Order::with('paymentinfo', 'routes')->where('Listing_Status', 'New Quote')
        ->where('user_id', $user_id)
        ->paginate($request->input('per_page', 10));

        return view('livewire.backend.quote.new_order', compact('Lisiting', 'slot', 'auth_user', 'Search_vehicleType', 'OptionName'))->layout('layouts.authorizedQuote');
    }

    public function BookOrder(Request $request)
    {
        $slot = '';
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = Auth::guard('Authorized')->user()->id;
        $Search_vehicleType = null;
        $OptionName = SidebarOption::where('user_id', $user_id)->get();

        $Lisiting = Order::where('Listing_Status', 'Book Order')->where('user_id', $user_id)->paginate($request->input('per_page', 10));

        return view('livewire.backend.quote.book_order', compact('Lisiting', 'slot', 'auth_user', 'Search_vehicleType', 'OptionName'));
    }


    public function MoveBookOrder(Request $request, $List_ID, $User_ID)
    {
        $order = Order::where('id', $List_ID)->where('user_id', $User_ID)->first();
        // dd($order);
        if ($order) {
            $order->Listing_Status = 'Book Order';
            $order->save();

            return redirect()->route('Book.Order')->with('success', 'Order status updated to Book Order.');
        }

        return redirect()->back()->with('error', 'Order not found.');
    }

    public function bulkActionQuote(Request $request)
{
    $selectedIds = $request->input('selected_ids', []);
    $action = $request->input('action_option');

    // Debug the request data
    // dd($selectedIds, $action);

    if (empty($selectedIds)) {
        return redirect()->back()->with('error', 'No items selected.');
    }

    $user_id = Auth::guard('Authorized')->user()->id;

    switch ($action) {
        case 'delete':
            Order::whereIn('id', $selectedIds)->update(['Listing_Status' => 'Deleted']);
            break;
        case 'cancel_order':
            Order::whereIn('id', $selectedIds)
            ->where('user_id', $user_id)
            ->update(['Listing_Status' => 'Cancelled']);
            foreach ($selectedIds as $orderId) {
                CancelledOrdersQuote::create([
                    'user_id' => $user_id,
                    'order_id' => $orderId,
                ]);
            }
            break;
        case 'book_order':
            Order::whereIn('id', $selectedIds)
            ->where('user_id', $user_id)
            ->update(['Listing_Status' => 'Book Order']);
            break;
        default:
            return redirect()->back()->with('Error!', 'Invalid action.');
    }

    return redirect()->back()->with('Success!', 'Bulk action completed successfully.');
}
}
