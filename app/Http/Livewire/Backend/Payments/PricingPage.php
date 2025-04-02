<?php

namespace App\Http\Livewire\Backend\Payments;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Payments\PaymentSystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PricingPage extends Component
{
    public function render()
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $User_Info = AuthorizedUsers::where('id', $user_id)->firstOrFail();
        if ($User_Info->usr_type === 'Carrier') {
            $Payment_Info = PaymentSystem::where('Payment_Type', 'Carrier Registration Fee')->first();
        } else {
            $Payment_Info = PaymentSystem::where('Payment_Type', 'Broker Registration Fee')->first();
        }
        return view('livewire.backend.payments.pricing-page', compact('Payment_Info', 'User_Info'))->layout('layouts.payment');
    }

    public function BackFromRegFee(): RedirectResponse
    {
        Auth::guard('Authorized')->logout();
        return redirect()->route('User.Dashboard')->with('Success!', 'User LogOut Successfully!');
    }
}
