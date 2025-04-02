<?php

namespace App\Http\Livewire\Backend\Admin\Carriers;

use Response;
use App\Models\Auth\AuthorizedAdmin;
use App\Models\Listing\LogisticBroker;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\History\LogisticBrokerCallHistory;
use Carbon\Carbon;

class AllLogisticBroker extends Component
{
    public function render(Request $request)
    {
        $Search_Value = "";
        $Search_Criteria = "";
        $Lisiting = LogisticBroker::orderBy('id', 'desc');

        if ($request->has('Search_Criteria') && $request->Search_Value != null) {
            $Search_Value = $request->Search_Value;
            $Search_Criteria = $request->Search_Criteria;

            if ($request->Search_Criteria == 'company_name') {
                $Lisiting->where('company_name', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'city') {
                $Lisiting->where('city', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'phone') {
                $Lisiting->where('phone', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'Mc_Number') {
                $Lisiting->where('Mc_Number', 'like', '%' . $request->Search_Value . '%');
            } elseif ($request->Search_Criteria == 'Company_USDot') {
                $Lisiting->where('Company_USDot', 'like', '%' . $request->Search_Value . '%');
            }
        }

        // dd($request->toArray());
        if ($request->has('start') && $request->start != 'start' && $request->has('end') && $request->start != 'end') {
            $start = $request->input('start');
            $end = $request->input('end');

            // Validate input values
            if ($start && $end) {
                $Lisiting->whereBetween('created_at', [Carbon::parse($start)->startOfDay(), Carbon::parse($end)->endOfDay()]);
            }
        }

        $Lisiting = $Lisiting->get();

        return view('livewire.backend.admin.listing.logistic-broker', compact('Lisiting', 'Search_Value', 'Search_Criteria'))->layout('layouts.authorized-admin');
    }


    public function history(Request $request)
    {
        $auth_agent = Auth::guard('Agent')->user();
        return LogisticBrokerCallHistory::with('user')
            ->where('permission', $request->CompanyID)
            ->get();

    }

    public function AllLogBrokerStore(Request $request)
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
            $newLogBroker = LogisticBroker::create([
                'user_id' => $user->id,
                'company_name' => $request->input('company_name'),
                'city' => $request->input('city'),
                'phone' => $request->input('phone'),
                'Mc_Number' => $request->input('Mc_Number'),
                'Company_USDot' => $request->input('Company_USDot'),
            ]);

            return back()->with('message', 'Logistic Broker created successfully');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating Logistic Broker: ' . $e->getMessage());

            // Return a generic error message
            return response()->json(['error' => 'Failed to create Logistic Broker. Please try again.'], 500);
        }
    }
}