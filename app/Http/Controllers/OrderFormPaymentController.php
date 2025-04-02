<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderFormPayment;

class OrderFormPaymentController extends Controller
{
    public function index($value='')
    {
    	return view('orderformpayment.index');
    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'booking_price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'balance_amount' => 'required|numeric',
            'card_first_name' => 'required|string|max:255',
            'card_last_name' => 'required|string|max:255',
            'billing_address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'card_type' => 'required|string|max:50',
            'credit_card_number' => 'required|string|max:19',
            'card_expiry_date' => 'required|string', // MM/YY format
            'card_security_code' => 'required|string', // CVC
        ]);
        // dd('success');

        // Create a new OrderFormPayment record
        OrderFormPayment::create([
            'booking_price' => $request->booking_price,
            'deposit' => $request->deposit,
            'balance_amount' => $request->balance_amount,
            'card_first_name' => $request->card_first_name,
            'card_last_name' => $request->card_last_name,
            'billing_address' => $request->billing_address,
            'zip_code' => $request->zip_code,
            'card_type' => $request->card_type,
            'credit_card_number' => $request->credit_card_number,
            'card_expiry_date' => $request->card_expiry_date,
            'card_security_code' => $request->card_security_code,
        ]);

        // Redirect or return response
        return redirect()->back()->with('success', 'Payment details have been saved successfully.');
    }
}
