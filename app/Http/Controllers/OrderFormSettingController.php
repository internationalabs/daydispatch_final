<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderFormSetting;
use App\Models\Auth\AuthorizedUsers;
use Auth;

class OrderFormSettingController extends Controller
{
    public function index()
    {
    	$user_id = Auth::guard('Authorized')->user()->id;
    	$slot = '';
    	$settings = OrderFormSetting::where('user_id', $user_id)->get();
    	return view('orderformsetting.create', compact('slot', 'settings'));
    }

    public function store(Request $request)
	{
	    $user_id = Auth::guard('Authorized')->user()->id;

	    $request->validate([
	        'company_name' => 'required|string',
	        'terms_condition' => 'required|string',
	        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);

	    // Check if settings already exist for this user
	    $orderFormSetting = OrderFormSetting::where('user_id', $user_id)->first();

	    if (!$orderFormSetting) {
	        // If no existing record, create a new one
	        $orderFormSetting = new OrderFormSetting;
	        $orderFormSetting->user_id = $user_id;
	    }

	    // Update or set new data
	    $orderFormSetting->company_name = $request->company_name;
	    $orderFormSetting->terms_condition = $request->terms_condition;

	    // Handle logo upload
	    if ($request->hasFile('logo')) {
	        // If there is an old logo, delete it
	        if ($orderFormSetting->logo && file_exists(public_path($orderFormSetting->logo))) {
	            unlink(public_path($orderFormSetting->logo));
	        }

	        // Save the new logo
	        $image = $request->file('logo');
	        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
	        $destinationPath = public_path('Uploads/orderformsetting');
	        $image->move($destinationPath, $name_gen);

	        // Save the path in the database
	        $orderFormSetting->logo = 'Uploads/orderformsetting/' . $name_gen;
	    }

	    $orderFormSetting->save();

	    return redirect()->route('order.form.setting')->with('success', 'Settings saved successfully.');
	}
}
