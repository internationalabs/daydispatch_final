<?php

namespace App\Http\Livewire\Backend\Admin\Carriers;

use Response;
use App\Models\Auth\AuthorizedAdmin;
use App\Models\Listing\LogisticCarrier;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\History\LogisticCarrierCallHistory;
use Carbon\Carbon;

class AllLogisticCarrier extends Component
{
    public function render(Request $request)
    {
        $Search_Value = "";
        $Search_Criteria = "";
        $query = LogisticCarrier::orderBy('id', 'desc');

        if ($request->has('Search_Criteria') && $request->Search_Value != null) {
            $Search_Value = $request->Search_Value;
            $Search_Criteria = $request->Search_Criteria;

            if ($request->Search_Criteria == 'company_name') {
                $query->where('company_name', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'city') {
                $query->where('city', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'phone') {
                $query->where('phone', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'Mc_Number') {
                $query->where('Mc_Number', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'Company_USDot') {
                $query->where('Company_USDot', 'like', '%' . $request->Search_Value . '%');
            }
        }

        // Add the additional filter for 'start' and 'end' if they exist in the request
        if ($request->has('start') && $request->has('end')) {
            $start = $request->input('start');
            $end = $request->input('end');
        
            // Validate input values and parse them with Carbon
            if ($start && $end) {
                try {
                    $start = Carbon::parse($start)->startOfDay();
                    $end = Carbon::parse($end)->endOfDay();
                    
                    // Apply the additional filter based on 'start' and 'end'
                    $query->whereBetween('created_at', [$start, $end]);
                } catch (\Exception $e) {
                    // Handle parsing error
                    // Log or throw an exception if necessary
                    // For now, let's simply ignore the filter
                }
            }
        }

        // dd($request->toArray());

        // Execute the query
        $Lisiting = $query->paginate(10);

        return view('livewire.backend.admin.listing.logistic-carrier', compact('Lisiting', 'Search_Value', 'Search_Criteria'))->layout('layouts.authorized-admin');
    }

    public function history(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        return LogisticCarrierCallHistory::with('user')
            ->where('permission', $request->CompanyID)
            ->get();

    }

    public function AllLogCarrierStore(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'city' => 'nullable|string',
            'phone' => 'nullable|string',
            'Mc_Number' => 'nullable|string',
            'Company_USDot' => 'nullable|string',
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
            $newLogCarrier = LogisticCarrier::create([
                'user_id' => $user->id,
                'company_name' => $request->input('company_name'),
                'city' => $request->input('city'),
                'phone' => $request->input('phone'),
                'Mc_Number' => $request->input('Mc_Number'),
                'Company_USDot' => $request->input('Company_USDot'),
            ]);

            return back()->with('message', 'Logistic Carrier created successfully');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating Logistic Carrier: ' . $e->getMessage());

            // Return a generic error message
            return response()->json(['error' => 'Failed to create Logistic Carrier. Please try again.'], 500);
        }
    }
}