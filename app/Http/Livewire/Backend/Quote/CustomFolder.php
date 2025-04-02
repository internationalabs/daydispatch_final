<?php

namespace App\Http\Livewire\Backend\Quote;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\SidebarOption;
use App\Models\Quote\Order;
use Illuminate\Http\Request;

class CustomFolder extends Component
{

    // public $folder;

    // public function mount($folder)
    // {
    //     $this->folder = $folder;
    // }

    // public function render()
    // {
    //     $auth_user = Auth::guard('Authorized')->user();
    //     $user_id = $auth_user->id;
    //     $Search_vehicleType = null;
    //     $OptionName = SidebarOption::where('user_id', $user_id)->get();

    //     $Lisiting = Order::where('Listing_Status', $this->folder)->where('user_id', $user_id)->get();

    //     return view('livewire.backend.quote.custom_order', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'OptionName'))->layout('layouts.authorized');
    // }


    public $folder;

    public function mount($folder)
    {
        $this->folder = $folder;

        $auth_user = Auth::guard('Authorized')->user();
        $user_id = $auth_user->id;

        $Lisiting = Order::where('Listing_Status', $this->folder)->where('user_id', $user_id)->get();

        // Check if the listing is empty
        if ($Lisiting->isEmpty()) {
            return redirect()->route('New.Order');
        }

        // Additional check for Listing_Status = 'New Quote'
        if ($this->folder === 'New Quote') {
            return redirect()->route('New.Order');
        }
    }

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $user_id = $auth_user->id;
        $Search_vehicleType = null;
        $OptionName = SidebarOption::where('user_id', $user_id)->get();

        $Lisiting = Order::where('Listing_Status', $this->folder)->where('user_id', $user_id)->paginate($request->input('per_page', 10));
        // dd($Lisiting->toArray());

        return view('livewire.backend.quote.custom_order', compact('Lisiting', 'auth_user', 'Search_vehicleType', 'OptionName'))->layout('layouts.authorizedQuote');
    }
}
