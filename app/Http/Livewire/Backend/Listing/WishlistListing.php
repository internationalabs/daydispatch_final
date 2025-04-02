<?php

namespace App\Http\Livewire\Backend\Listing;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing\WatchList;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Http\Request;

class WishlistListing extends Component
{
    public function render(Request $request)
    {
        // $auth_user = Auth::guard('Authorized')->user();
        $user_id = Auth::guard('Authorized')->user()->id;
        $auth_user = AuthorizedUsers::with(["my_watch_list"])->where('id', $user_id)->firstOrFail();
        $Search_vehicleType = null;

        $watch_list = WatchList::orderBy('id', 'DESC')->where('user_id', $user_id)->whereHas('listing', function ($q) {
            $q->where('Listing_Status', 'Listed');
        })->paginate($request->input('per_page', 10));
        // dd($auth_user->my_watch_list->toArray(), $watch_list);

        return view('livewire.backend.listing.watch-list', compact('watch_list', 'auth_user', 'Search_vehicleType'))->layout('layouts.authorized');
    }

    public function store($id)
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $watch_list = WatchList::where('listing_id', $id)
            ->where('user_id', $user_id)
            ->first();
        // dd($watch_list->toArray());
        if ($watch_list) {
            $watch_list->delete();
            if (request()->ajax()) {
                return response()->json(['success' => true, 'isInWatchlist' => false, 'data' => 'Removed from` watchlist']);
            } else {
                return back();
            }
        } else {
            $watch_list = new WatchList;
            $watch_list->user_id = $user_id;
            $watch_list->listing_id = $id;
            $watch_list->save();
            if (request()->ajax()) {
                return response()->json(['success' => true, 'isInWatchlist' => true, 'data' => 'Added to watchlist']);
            } else {
                return back();
            }
        }
    }
}
