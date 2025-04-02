<?php

namespace App\Http\Livewire\Backend\Extras;

use App\Models\Extras\TruckSpace;
use App\Models\Extras\HeavyTruckSpace;
use App\Models\Extras\TruckSpaceDry;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Http\Request;


class AllTruckSpace extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $auth_user = Auth::guard('Authorized')->user();
        $Listing = AllUserListing::with([
            "pickup_delivery_info",
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            "dry_vans_services",
            "routes"
        ])->where('user_id', $user_id)
            ->whereNotIn('Listing_Status', ['Completed', 'Cancelled', 'Expired', 'Deleted'])
            ->get();

        $Truck_Space = TruckSpace::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->get();

        $Heavy_Truck_Space = HeavyTruckSpace::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->where('user_id', $user_id)
            ->get();


        $Truck_Space_Dry = TruckSpaceDry::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->where('user_id', $user_id)
            ->get();    

        $All_Listing = AllUserListing::active()->with([
            "pickup_delivery_info",
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            "dry_vans_services",
            "routes"
        ])->whereNotIn('Listing_Status', ['Completed', 'Cancelled', 'Expired', 'Deleted'])
            ->get();

        // dd($All_Listing->toArray());

        return view('livewire.backend.extras.all-truck-space', compact('Listing', 'Truck_Space', 'All_Listing', 'auth_user', 'Heavy_Truck_Space', 'Truck_Space_Dry'))->layout('layouts.authorized');
    }

    public function addTruckSpace(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user_id = Auth::guard('Authorized')->user()->id;
            $TruckSpace = new TruckSpace();
            $TruckSpace->Truck_Country = "United State America (USA)";
            $TruckSpace->Truck_Space = $request->Truck_Space;
            $TruckSpace->Truck_Trailer_Type = $request->Truck_Trailer_Type;
            $TruckSpace->Truck_Condition = $request->Truck_Condition;
            $TruckSpace->Truck_Departs = $request->Truck_Departs;
            $TruckSpace->Truck_Location = $request->Truck_Location;
            $TruckSpace->Truck_Heading = $request->Truck_Heading;
            $TruckSpace->Truck_Destination = $request->Truck_Destination;
            $TruckSpace->user_id = $user_id;

            $TruckSpace->save();

            DB::commit();

            return redirect()->route('View.TruckSpace')->with('Success!', "Your Truck is Added Successfully!");
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('Error!', "Your Truck isn't Added! Database Error: " . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('Error!', "Your Truck isn't Added! Error: " . $e->getMessage());
        }
    }

    public function addHeavyTruckSpace(Request $request): RedirectResponse
    {
        // dd($request->all());
        try {
            DB::beginTransaction();

            $user_id = Auth::guard('Authorized')->user()->id;
            $HeavyTruckSpace = new HeavyTruckSpace();
            $HeavyTruckSpace->Truck_Country = "United State America (USA)";
            $HeavyTruckSpace->Equipment_condition = $request->Equipment_Condition;
            $HeavyTruckSpace->trailer_type = $request->Trailer_Type;
            $HeavyTruckSpace->trailer_specification = $request->option;
            $HeavyTruckSpace->shipment_preferences = $request->Shipment_Preferences;

            $HeavyTruckSpace->Heavy_Truck_Space = $request->Heavy_Truck_Space;
            $HeavyTruckSpace->Heavy_Truck_Departs = $request->Heavy_Truck_Departs;
            $HeavyTruckSpace->Heavy_Truck_Location = $request->Heavy_Truck_Location;
            $HeavyTruckSpace->Heavy_Truck_Heading = $request->Heavy_Truck_Heading;
            $HeavyTruckSpace->Heavy_Truck_Destination = $request->Heavy_Truck_Destination;
            

            $HeavyTruckSpace->user_id = $user_id;

            $HeavyTruckSpace->save();

            DB::commit();

            return redirect()->route('View.TruckSpace')->with('Success!', "Your Heavy Truck is Added Successfully!");
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('Error!', "Your Truck isn't Added! Database Error: " . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('Error!', "Your Truck isn't Added! Error: " . $e->getMessage());
        }
    }
    
    public function addTruckSpaceDry(Request $request): RedirectResponse
    {
        // dd($request->all());
        try {
            DB::beginTransaction();

            $user_id = Auth::guard('Authorized')->user()->id;
            $TruckSpaceDry = new TruckSpaceDry();
            $TruckSpaceDry->Truck_Country_Dry = "United State America (USA)";
            $TruckSpaceDry->Equipment_Condition_Dry = $request->Equipment_Condition_Dry;
            $TruckSpaceDry->Trailer_Type_Dry = $request->Trailer_Type_Dry;
            $TruckSpaceDry->Truck_Departs_Dry = $request->Truck_Departs_Dry;
            $TruckSpaceDry->Trailer_Specification_Dry = $request->Trailer_Specification_Dry;
            $TruckSpaceDry->Shipment_Preferences_Dry = $request->Shipment_Preferences_Dry;
            $TruckSpaceDry->Truck_Location_Dry = $request->Truck_Location_Dry;
            $TruckSpaceDry->Truck_Heading_Dry = $request->Truck_Heading_Dry;
            $TruckSpaceDry->Truck_Destination_Dry = $request->Truck_Destination_Dry;
            $TruckSpaceDry->is_hazmat_Check = $request->is_hazmat_Check;
            $TruckSpaceDry->user_id = $user_id;

            $TruckSpaceDry->save();

            DB::commit();

            return redirect()->route('View.TruckSpace')->with('Success!', "Your Freight Load is Added Successfully!");
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('Error!', "Your Truck isn't Added! Database Error: " . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('Error!', "Your Truck isn't Added! Error: " . $e->getMessage());
        }
    }
}
