<?php

namespace App\Http\Livewire\Backend\Admin\Invoices;

use App\Models\Listing\AllUserListing;
use App\Models\Payments\SubscriptionFee;
use App\Models\Payments\UserRegFee;
use Livewire\Component;
use App\Models\NumberOfLogin;
use Illuminate\Support\Facades\DB;



class AllInvoices extends Component
{
    public function render()
    {
        $Dispatches_Invoices = AllUserListing::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
            'dispatch_fee' => [
                "authorized_user" => function ($q) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
                },
            ]
        ])->whereRelation('dispatch_fee', 'status', '=', 1)->get();

        $Reg_Invoices = UserRegFee::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->where( 'status', 1)->get();

        $Sub_Invoices = SubscriptionFee::with([
            "authorized_user" => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone');
            },
        ])->where( 'status', 1)->get();

        $Broker_Invoices = AllUserListing::with([
            'dispatch_fee',
            'completed' => [
                "authorized_user" => function ($q) {
                    $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'usr_type');
                },
            ]
        ])
            ->where('Listing_Status', 'Completed')
            ->whereRelation('completed.authorized_user', 'usr_type', '=', 'Broker')
            ->get();

        $seats = NumberOfLogin::with('authorized_user_name')->get();

        return view('livewire.backend.admin.invoices.all-invoices', compact('Dispatches_Invoices', 'Reg_Invoices', 'Sub_Invoices', 'Broker_Invoices', 'seats'))->layout('layouts.authorized-admin');
    }
}
