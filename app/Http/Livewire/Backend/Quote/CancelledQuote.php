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

class CancelledQuote extends Component
{

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Search_vehicleType = null;
        $watchlist = WatchList::where('user_id', $auth_user->id)->get();
        
        // Retrieve soft-deleted listings or quotes
        $Lisiting = Order::withTrashed()->where('user_id', $auth_user->id)->where('Listing_Status', 'Cancelled');
    
        // if ($auth_user->usr_type === 'Carrier') {
        //     $Lisiting->where('user_id', $auth_user->id);
        // } else {
        //     $Lisiting->where('user_id', $auth_user->id);
        // }
    
        $Lisiting = $Lisiting->paginate($request->input('per_page', 10));
        // dd($Lisiting);
    
        return view('livewire.backend.quote.cancelled_quote', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'watchlist'))->layout('layouts.authorizedQuote');
    }

}
