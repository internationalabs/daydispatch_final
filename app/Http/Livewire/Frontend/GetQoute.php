<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Frontend\CustomOrderTracker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;

class GetQoute extends Component
{
    public function render()
    {
        return view('livewire.frontend.get-qoute')->layout('layouts.master');
    }

    public function postCustomOrderTracking(Request $request): string
    {
        $CustomOrderTracker = new CustomOrderTracker();
        $CustomOrderTracker->Order_ID = $request->Order_ID;
        $CustomOrderTracker->Order_Desc = $request->Order_Desc;

        if ($CustomOrderTracker->save()) {
            return "Your Order Request Submitted Successfully!";
        }
        return "Your Order Request Not Submitted";
    }
}
