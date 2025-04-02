<?php

namespace App\Http\Livewire\Backend\Extras;

use App\Models\Listing\ListingRoutes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use JsonException;
use Livewire\Component;

class GoogleTruckSpace extends Component
{
    /**
     * @throws JsonException
     */
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $routes = ListingRoutes::where('user_id', $user_id)->get();

        $ZipCodes = collect($routes)->map(function ($route) {
            return Str::afterLast($route->Origin_ZipCode, ', ');
        });

        $loc = collect($ZipCodes)->map(function ($zipCode) {
            return DB::table('zip_codes')
                ->select('*')
                ->where('zipcode', $zipCode)
                ->first();
        });

        $locations = collect($loc)->map(function ($item) {
            return [$item->city ?? '', $item->latitude ?? 0, $item->longitude ?? 0];
        });
        // dd($locations);

        return view('livewire.backend.extras.google-truck-space', compact('locations'))->layout('layouts.authorized');
    }
}
