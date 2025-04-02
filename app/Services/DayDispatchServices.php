<?php

namespace App\Services;

use App\Models\Agents\AgentRevenue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DayDispatchServices
{
    // Get ZipCode On Filter Form
    public function getZipCodeLocation(Request $request): JsonResponse
    {
        $data = DB::table('zip_codes')
            ->orWhere('zipcode', 'LIKE', '%' . $request->input('query') . '%')
            ->orWhere('city', 'LIKE', '%' . $request->input('query') . '%')
            ->orWhere('state', 'LIKE', '%' . $request->input('query') . '%')
            ->get();
        $ZipCodes = $data->map(function ($row) {
            return $row->city . ', ' . $row->state . ', ' . $row->zipcode;
        });
        return response()->json($ZipCodes);
    }

    // Agent Revenue Calculation
    public function calculateAgentRevenue($Agent_ID): float|int
    {
        $Agent_Revenue = 0;
        $Order_Target = 0;
        $Per_Order_Amount = 10;
        $Revenue = AgentRevenue::where('agent_id', $Agent_ID);

        $currentMonth = $Revenue->currentMonth()->get();
        $lastMonth = $Revenue->lastMonth()->get();
        $secondLastMonth = $Revenue->secondLastMonth()->get();
        $thirdLastMonth = $Revenue->thirdLastMonth()->get();

        //        $currentMonthSum = $Revenue->currentMonthSum()->first();
//        $lastMonthSum = $Revenue->lastMonthSum()->first();
//        $secondLastMonthSum = $Revenue->secondLastMonthSum()->first();
//        $thirdLastMonthSum = $Revenue->thirdLastMonthSum()->first();

        if ((count($lastMonth) >= $Order_Target) && (count($secondLastMonth) >= $Order_Target) && (count($thirdLastMonth) >= $Order_Target)) {
            return ($Per_Order_Amount * count($currentMonth)) + ($Per_Order_Amount * count($lastMonth)) + ($Per_Order_Amount * count($secondLastMonth)) + ($Per_Order_Amount * count($thirdLastMonth));
        }
        return $Per_Order_Amount * count($currentMonth);
    }

    public function getAgentRevenue($Agent_ID)
    {
        return AgentRevenue::where('agent_id', $Agent_ID)
            ->orderBy('id', 'DESC')
            ->with([
                'all_listing' => function ($q) {
                    $q->select('*')->with([
                        'deliver' => [
                            'delivered_user' => function ($q) {
                                $q->select('id', 'Company_Name', 'email', 'Hours_Operations', 'Contact_Phone');
                            },
                        ],
                        'authorized_user' => function ($q) {
                            $q->select('id', 'Company_Name', 'email', 'Hours_Operations', 'Contact_Phone');
                        },
                    ]);
                }
            ]);
    }

    public function getCityState(Request $request): JsonResponse
    {
        // Validate the request input
        $request->validate([
            'query' => 'required|string',
            'type' => 'required|in:City,State',
        ]);

        // Initialize the variable to store results
        $ZipCodes = collect();

        if ($request->type === 'City') {
            // Query data based on the city
            $data = DB::table('zip_codes')
                ->where('city', 'LIKE', '%' . $request->input('query') . '%')
                ->get();

            // Group by city
            $ZipCodes = $data->groupBy('city')->keys();
        } else if ($request->type === 'State') {
            // Query data based on the state
            $data = DB::table('zip_codes')
                ->where('state', 'LIKE', '%' . $request->input('query') . '%')
                ->get();

            // Group by state
            $ZipCodes = $data->groupBy('state')->keys();
        }

        // Return the response as JSON
        return response()->json($ZipCodes);
    }
}
