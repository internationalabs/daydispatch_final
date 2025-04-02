<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Listing\AllUserListing;

class LoardBoard extends Component
{
    public function render()
    {
        $allUserListing = new AllUserListing();


        // $Listing_I = $allUserListing->getListingByType(1, 'vehicles');
        // $Listing_II = $allUserListing->getListingByType(2, 'heavy_equipments');
        // $Listing_III = $allUserListing->getListingByType(3, 'dry_vans');
        // $Listing_IV = $allUserListing->getListingByType(2, 'heavy_equipments', true);
        // $Listing_V = $allUserListing->getListingByType(3, 'dry_vans', true);


        // $Listing_I = $allUserListing->getListingByTypeWithPagination(1, 'vehicles',false, 20);
        $Listing_I = $allUserListing->getListingByType(1, 'vehicles',false);

        $Listing_II = $allUserListing->getListingByType(2, 'heavy_equipments',false);
        $Listing_III = $allUserListing->getListingByType(3, 'dry_vans',false);
        $Listing_IV = $allUserListing->getListingByType(2, 'heavy_equipments', true);
        $Listing_V = $allUserListing->getListingByType(3, 'dry_vans', true);
        // $Listing_II = $allUserListing->getListingByTypeWithPagination(2, 'heavy_equipments',false, 20);
        // $Listing_III = $allUserListing->getListingByTypeWithPagination(3, 'dry_vans',false, 20);
        // $Listing_IV = $allUserListing->getListingByTypeWithPagination(2, 'heavy_equipments', true, 20);
        // $Listing_V = $allUserListing->getListingByTypeWithPagination(3, 'dry_vans', true, 20);




        // New condition
        // $Listing_I = $allUserListing->limit(20)->latest()->get();

        // $perPage = 2;
        // $Listing_I = $allUserListing->latest()->paginate($perPage);

        // $Listing_I = AllUserListing::where('Listing_Status', '=', 'Listed')->latest()->paginate($perPage);

        return view('livewire.frontend.loard-board', compact('Listing_I', 'Listing_II', 'Listing_III', 'Listing_IV', 'Listing_V'))->layout('layouts.master');
    }
}
