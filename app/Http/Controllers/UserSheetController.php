<?php

namespace App\Http\Controllers;

use App\Models\Listing\AllCarriers;
use App\Models\Settings\Permission;
use Illuminate\Http\Request;
use App\Models\UserSheet;
use Yajra\DataTables\Facades\DataTables;
class UserSheetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = AllCarriers::query();

            // Apply Filters
            if (!empty($request->type)) {
                $query->where('type_1', $request->type);
            }

            if (!empty($request->name)) {
                $query->where('company_name', 'LIKE', '%' . $request->name . '%');
            }

            if (!empty($request->phone)) {
                $query->where('main_number', 'LIKE', '%' . $request->phone . '%');
            }

            if (!empty($request->state)) {
                $query->where('state', 'LIKE', '%' . $request->state . '%');
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('type_1', function ($carrier) {
                    $types = [1 => 'Carrier', 2 => 'Shipper', 3 => 'Broker'];
                    return $types[$carrier->type_1] ?? 'Unknown';
                })
                ->addColumn('actions', function ($carrier) {
                    $carrierDetails = [
                        'id' => $carrier->id,
                        'type' => $carrier->type_1,
                        'company_name' => $carrier->company_name,
                        'state' => $carrier->state,
                        'address' => $carrier->address,
                        'main_number' => $carrier->main_number,
                        'local_number' => $carrier->local_number,
                        'truck' => $carrier->truck,
                        'other_details' => $carrier->other_details,
                        'equipment' => $carrier->equipment,
                        'route_description' => $carrier->route_description
                    ];

                    return '<button class="btn btn-warning btn-sm editUserBtn"
                data-details="' . e(json_encode($carrierDetails)) . '"
                data-bs-toggle="modal">
                Edit
            </button>';
                })



                ->rawColumns(['actions'])
                ->make(true);
        }

        $permission = Permission::all();
        $slot = '';
        $states = AllCarriers::select('state')->groupBy('state')->get();
        return view('livewire.backend.admin.user_sheets.index', compact('permission','slot','states'));
    }
    public function store(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'type' => 'required|integer|in:1,2,3', // Must be 1, 2, or 3
            'company_name' => 'required|string|max:80',
            'state' => 'required|string|max:5',
            'address' => 'required|string|max:200',
            'main_number' => 'required|string|max:60',
            'local_number' => 'nullable|string|max:60',
            'truck' => 'nullable|string|max:100',
            'other_details' => 'nullable|string|max:100',
            'equipment' => 'nullable|string|max:300',
            'route_description' => 'nullable|string|max:300',
            'description' => 'nullable|string|max:300',
        ]);

        // Determine the type name
        $typeName = match ($request->type) {
            1 => 'Carrier',
            2 => 'Shipper',
            3 => 'Broker',
            default => 'Unknown'
        };

        // Create new Carrier Company record
        AllCarriers::updateOrCreate(
            ['id' => $request->id], // Condition to check existing record (if `id` is provided)
            [
                'user_id' => 0, // Store authenticated user's ID (Update this as needed)
                'type_1' => $request->type, // 1 = Carrier, 2 = Shipper, 3 = Broker
                'company_name' => $request->company_name,
                'state' => $request->state,
                'address' => $request->address,
                'main_number' => $request->main_number,
                'local_number' => $request->local_number,
                'truck' => $request->truck,
                'other_details' => $request->other_details,
                'equipment' => $request->equipment,
                'route_description' => $request->route_description,
                'description' => $request->description,
            ]
        );


        // Redirect back with success message
        return response()->json(['status'=>1]);
    }


    public function edit($id)
    {
        $role = UserSheet::findOrFail($id);
        return view('livewire.backend.admin.user_sheets.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone_one' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Find the UserSheet record by its ID
        $userSheet = UserSheet::findOrFail($id);

        // Update the UserSheet with the validated data
        $userSheet->update($request->all());

        // Redirect to the user sheet page with a success message
        return redirect()->route('userSheet')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        UserSheet::findOrFail($id)->delete();
        return redirect()->route('userSheet')->with('success', 'Role deleted successfully.');
    }

    public function active($id)
    {
        $role = UserSheet::findOrFail($id);
        $role->update(['status' => 1]);

        return redirect()->route('userSheet')->with('success', 'Role activated.');
    }

    public function notActive($id)
    {
        $role = UserSheet::findOrFail($id);
        $role->update(['status' => 0]);

        return redirect()->route('userSheet')->with('success', 'Role deactivated.');
    }
}
