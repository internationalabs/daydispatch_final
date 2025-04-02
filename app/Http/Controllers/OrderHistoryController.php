<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote\Order;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $customerPhone = $request->input('Listed_Phone');
        $orders = Order::where('Customer_Phone', $customerPhone)
            ->with('vehicles')
            ->with('routes')
            ->with('paymentinfo')
            ->get();
            // dd('ok');

        return response()->json(['orders' => $orders]);
    }
}
