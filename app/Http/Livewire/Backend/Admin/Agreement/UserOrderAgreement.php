<?php

namespace App\Http\Livewire\Backend\Admin\Agreement;

use App\Models\Listing\ListingAgreement;
use Illuminate\Http\Request;
use Livewire\Component;

class UserOrderAgreement extends Component
{
    public function render(Request $request)
    {
        $Lisiting = ListingAgreement::with([
            'all_listing' => [
                'paymentinfo',
                'additional_info',
                'pickup_delivery_info',
                'vehicles',
                'routes',
                'listing_origin_location',
                'listing_destination_locations',
                'attachments',
                'miscellenous',
                'bol' => [
                    'bol_attachments'
                ],
                'history',
                'cancel',
                'update_history',
                'driver'
            ],
            'authorized_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            },
            'agreement_user' => function ($q) {
                $q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
                    'insurance',
                    'certificates'
                ]);
            }
        ])->where('order_id', $request->List_ID)->firstOrFail();

        $Agreement = $Lisiting->all_listing->Listing_Status === 'Waiting For Approval';
        return view('livewire.backend.admin.agreement.user-order-agreement', compact('Lisiting', 'Agreement'))->layout('layouts.admin-summary');
    }
}
