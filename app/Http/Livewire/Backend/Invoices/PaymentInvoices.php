<?php

namespace App\Http\Livewire\Backend\Invoices;

use App\Models\Listing\AllUserListing;
use App\Models\Payments\DispatchOrderFee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentInvoices extends Component
{
    public function render()
    {
        $Auth_User = Auth::guard('Authorized')->user();
        if ($Auth_User->usr_type === 'Carrier') {
            $Dispatches_Invoices = DispatchOrderFee::with([
                "authorized_user" => function ($q) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                },
                'all_listing' => [
                    "authorized_user" => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                    },
                ]
            ])->where('user_id', $Auth_User->id)->where('status', 1)->get();
        } else {
            $Dispatches_Invoices = AllUserListing::with([
                "authorized_user" => function ($q) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                },
                'dispatch_fee' => [
                    "authorized_user" => function ($q) {
                        $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                    },
                ]
            ])->where('user_id', $Auth_User->id)->whereRelation('dispatch_fee', 'status', '=', 1)->get();
        }
//        dd($Dispatches_Invoices->toArray());
        return view('livewire.backend.invoices.payment-invoices', compact('Dispatches_Invoices'))->layout('layouts.authorized');
    }
}
