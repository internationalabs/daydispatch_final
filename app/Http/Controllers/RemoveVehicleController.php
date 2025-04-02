<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing\ListingVehciles;
use App\Models\Listing\ListingHeavyEquipment;
use App\Models\Listing\ListingDryVan;
use App\Models\Listing\AllUserListing;

class RemoveVehicleController extends Controller
{
    public function RemoveVehicle(Request $request)
    {
        try {
            $Listed_ID = $request->input('List_ID');
            $Vehicle_ID = $request->input('Vehicle_ID');

            $Listing = AllUserListing::findOrFail($Listed_ID);

            $vehicle = match ($Listing->Listing_Type) {
                1 => ListingVehciles::where('id', $Vehicle_ID)->where('order_id', $Listed_ID)->firstOrFail(),
                2 => ListingHeavyEquipment::where('id', $Vehicle_ID)->where('order_id', $Listed_ID)->firstOrFail(),
                3 => ListingDryVan::where('id', $Vehicle_ID)->where('order_id', $Listed_ID)->firstOrFail(),
                default => throw new \Exception('Invalid Listing Type'),
            };

            $vehicle->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vehicle has been deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
