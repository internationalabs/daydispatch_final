<?php

namespace App\Http\Livewire\Backend\Contracts;

use App\Models\Payments\DispatchOrderFee;
use App\Models\Payments\PaymentSystem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Listing\AllUserListing;

class OrderAgreement extends Component
{
    public function render(Request $request)
    {
        $Lisiting = AllUserListing::with([
            'paymentinfo',
            'additional_info',
            'pickup_delivery_info',
            "vehicles",
            "heavy_equipments",
            "dry_vans",
            'routes',
            'listing_origin_location',
            'listing_destination_locations',
            'attachments',
            'dry_vans_services',
            'miscellenous',
            'driver',
            'authorized_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'waitings' => [
                'waiting_users' => function ($q) {
                    $q->select('*')->with([
                        'insurance',
                        'certificates'
                    ]);
                }
            ]
        ])->where('id', $request->List_ID)->firstOrFail();

        $Agreement = $Lisiting->Listing_Status === 'Waiting For Approval';
        $user_id = Auth::guard('Authorized')->user()->id;
        $DispatchOrderFee = DispatchOrderFee::where('order_id', $request->List_ID)->where('status', 1)->where('user_id', $user_id)->first();
        $Payment_Info = PaymentSystem::get();
        // dd('oks', $Lisiting->toArray());
        return view('livewire.backend.contracts.order-agreement',
            compact('Lisiting', 'Agreement', 'DispatchOrderFee', 'Payment_Info')
        )->layout('layouts.summary');

    }
}
