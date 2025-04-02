<?php

namespace App\Http\Livewire\Backend\Admin\Carriers;

use Response;
use App\Models\Auth\AuthorizedAdmin;
use App\Models\Listing\AllCarriers;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\History\CarrierCallHistory;
use Carbon\Carbon;

class AllCarriersCompany extends Component
{
    public function render(Request $request)
    {
        $Search_Value = "";
        $Search_Criteria = "";

        $query = AllCarriers::orderBy('id', 'desc');

        if ($request->has('Search_Criteria') && $request->Search_Value != null) {
            $Search_Value = $request->input('Search_Value');
            $Search_Criteria = $request->input('Search_Criteria');

            if ($Search_Criteria === 'company_name') {
                $query->where('company_name', 'like', '%' . $Search_Value . '%');
            } elseif ($Search_Criteria === 'address') {
                $query->where('address', 'like', '%' . $Search_Value . '%');
            } elseif ($Search_Criteria === 'main_number') {
                $query->where('main_number', 'like', '%' . $Search_Value . '%');
            } elseif ($Search_Criteria === 'local_number') {
                $query->where('local_number', 'like', '%' . $Search_Value . '%');
            } elseif ($Search_Criteria === 'truck') {
                $query->where('truck', 'like', '%' . $Search_Value . '%');
            } elseif ($Search_Criteria === 'equipment') {
                $query->where('equipment', 'like', '%' . $Search_Value . '%');
            } elseif ($Search_Criteria === 'route_description') {
                $query->where('route_description', 'like', '%' . $Search_Value . '%');
            }
        }

        if ($request->has('start') && $request->has('end')) {
            $start = $request->input('start');
            $end = $request->input('end');

            // Validate input values
            if ($start && $end) {
                $query->whereBetween('created_at', [Carbon::parse($start)->startOfDay(), Carbon::parse($end)->endOfDay()]);
            }
        }

        $Lisiting = $query->paginate(10);

        return view('livewire.backend.admin.listing.all-carriers', compact('Lisiting', 'Search_Value', 'Search_Criteria'))->layout('layouts.authorized-admin');

    }
    public function passCheck(Request $request)
    {
        $UserEmail = Auth::guard('Admin')->user()->email;
        $user = AuthorizedAdmin::where('email', $UserEmail)->first();

        if ($user) {
            if (Hash::check($request->Password_Check, $user->password)) {

                return response()->json(['Success' => 'Password Matched']);
            } else {
                return response()->json(['Error' => '400 Bad Request \n Wrong Password!']);
            }
        }
        return response()->json(['Error!' => '400 Bad Request \n User does\'nt Exist! \n Invalid Email!']);

    }

    public function history(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        return CarrierCallHistory::with('user')
            ->where('permission', $request->CompanyID)
            ->get();

    }

    public function allCarriersStore(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'address' => 'nullable|string',
            'main_number' => 'nullable|string',
            'local_number' => 'nullable|string',
            'truck' => 'nullable|string',
            'equipment' => 'nullable|string',
            'route_description' => 'nullable|string',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Get the authenticated user
        $user = Auth::guard('Admin')->user();

        // Handle the case where user is not authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            // Create the record
            $newCarrier = AllCarriers::create([
                'user_id' => $user->id,
                'company_name' => $request->input('company_name'),
                'address' => $request->input('address'),
                'main_number' => $request->input('main_number'),
                'local_number' => $request->input('local_number'),
                'truck' => $request->input('truck'),
                'equipment' => $request->input('equipment'),
                'route_description' => $request->input('route_description'),
            ]);

            return back()->with('message', 'Carrier created successfully');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating carrier: ' . $e->getMessage());

            // Return a generic error message
            return response()->json(['error' => 'Failed to create carrier. Please try again.'], 500);
        }
    }
}
