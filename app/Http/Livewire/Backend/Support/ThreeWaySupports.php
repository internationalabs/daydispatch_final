<?php

namespace App\Http\Livewire\Backend\Support;

use App\Models\Support\ThreeWayTicket;
use App\Services\OrderSupport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ThreeWaySupports extends Component
{
    protected OrderSupport $orderSupport;
    public $auth_user;

    public function mount(OrderSupport $orderSupport): void
    {
        $this->orderSupport = $orderSupport;
        $this->auth_user = Auth::guard('Authorized')->user();
    }

    public function render()
    {
        $Tickets = $this->orderSupport->getOrderTickets();
        if ($this->auth_user->usr_type === 'Carrier') {
            $Tickets = $Tickets->where('CMP_id', $this->auth_user->id);
        } else {
            $Tickets = $Tickets->where('user_id', $this->auth_user->id);
        }
        return view('livewire.backend.support.three-way-supports', compact('Tickets'))->layout('layouts.authorized');
    }

    public function CreateOrderTicket(Request $request): RedirectResponse
    {
        $ThreeWayTicket = new ThreeWayTicket();
        $ThreeWayTicket->Order_Subject = $request->Order_Subject;
        $ThreeWayTicket->Order_Reason = $request->Order_Reason;
        $ThreeWayTicket->Order_Desc = $request->Order_Desc;
        $ThreeWayTicket->user_id = $request->get_User_ID;
        $ThreeWayTicket->order_id = $request->get_Listed_ID;
        $ThreeWayTicket->CMP_id = $request->get_CMP_ID;
        $ThreeWayTicket->created_by = Auth::guard('Authorized')->user()->id;

        if ($ThreeWayTicket->save()) {
            return redirect()->route('My.Tickets')->with('Success!', "Your Ticket has been Generated!");
        }
        return back()->with('Error!', "Ticket Not Generated!");
    }
}
