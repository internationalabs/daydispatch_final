<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidebarOption;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote\Order;

class SidebarOptionController extends Controller
{
    
    public function create()
    {
    	$slot = '';
        $user_id = Auth::guard( 'Authorized' )->user()->id;
        $sidebarOptions = SidebarOption::where('user_id', $user_id)->get();

        return view('sidebar_options.create', compact('slot', 'sidebarOptions')); // Return the form view
    }

    public function store(Request $request)
    {
    	$user_id = Auth::guard( 'Authorized' )->user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $routeName = $request->name;
        $routeName = strtolower(str_replace(' ', '-',$routeName));

        // Check if the user already has 6 options
        $optionCount = SidebarOption::where('user_id', $user_id)->count();
        if ($optionCount >= 10) {
            return redirect()->back()->with('error', 'You cannot add more than 10 options.');
        }

        $existingOption = SidebarOption::where('user_id', $user_id)->where('name', $request->name)->first();
        if ($existingOption) {
            return redirect()->back()->with('error', 'Option with this name already exists.');
        }

        // dd($routeName);
        SidebarOption::create([
        	'user_id' => $user_id,
            'name' => $request->name,
            'route_name' => $routeName,
        ]);

        return redirect()->back()->with('success', 'Option added successfully.');
    }

    public function edit($id)
    {
        $slot = '';
        $user_id = Auth::guard( 'Authorized' )->user()->id;
        $sidebarOptions = SidebarOption::where('user_id', $user_id)->findOrFail($id);
        return view('sidebar_options.edit', compact('slot', 'sidebarOptions'));
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::guard( 'Authorized' )->user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $routeName = $request->name;
        $routeName = strtolower(str_replace(' ', '-',$routeName));

        $existingOption = SidebarOption::where('user_id', $user_id)->where('route_name', $routeName)->where('id', '<>', $id)->first();

        if ($existingOption) {
            return redirect()->back()->with('error', 'Option with this name already exists.');
        }                                    

        SidebarOption::findOrFail($id)->update([
            'name' => $request->name,
            'route_name' => $routeName,
        ]);

        return redirect()->route('sidebar-options.create')->with('success', 'Option Updated successfully.');
    }

    public function delete($id)
    {
        $getname = SidebarOption::findOrFail($id)->name;
        $check_status = Order::where('Listing_Status', $getname)->get();

        if ($check_status->count() > 0) {
            return redirect()->back()->with('error', 'First, your quote exists on this status. Move it to another folder, and the count must be zero before you can delete this option.');
        } else {
            SidebarOption::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Your option was successfully deleted.');
        }
    }
}