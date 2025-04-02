<?php

namespace App\Http\Livewire\Backend\Contracts;

use App\Models\Listing\AllUserListing;
use App\Models\Listing\ListingAgreement;
use Livewire\Component;
use App\Models\Carrier\RequestBroker;
use App\Models\Listing\WaitingForApproval;

class ViewOrderAgreement extends Component
{
    public $List_ID;
    public $Lisiting;
    public $Agreement;
    public $History;

    public function mount($List_ID)
    {
        $this->List_ID = $List_ID;
    }

    public function loadData()
    {
        if (ListingAgreement::where('order_id', $this->List_ID)->exists()) {
            $this->Lisiting = ListingAgreement::with([
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
                    'bol' => ['bol_attachments'],
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
            ])->where('order_id', $this->List_ID)->first();
        } else {
            $this->Lisiting = WaitingForApproval::where('order_id', $this->List_ID)
                ->with('all_listing', 'waiting_users')
                ->has('all_listing')
                ->first();

            // dd($this->Lisiting->toArray());
        }

        $this->History = ListingAgreement::with('all_listing')->whereHas('all_listing', function ($q) {
            $q->where('Listing_Status', '!=', 'Listed');
        })->first();

        $this->Agreement = $this->Lisiting && $this->Lisiting->all_listing && $this->Lisiting->all_listing->Listing_Status === 'Waiting For Approval';
    }

    public function render()
    {
        $this->loadData();

        $view = !isset($this->Lisiting->waiting_users)
            ? 'livewire.backend.contracts.view-order-agreement'
            : 'livewire.backend.contracts.view-detail';

        // $layout = !isset($this->Lisiting->waiting_users)
        //     ? 'layouts.summary'
        //     : 'layouts.authorized';

        return view($view, [
            'Lisiting' => $this->Lisiting,
            'Agreement' => $this->Agreement,
            'History' => $this->History,
        ])->layout('layouts.summary');
    }
}

//namespace App\Http\Livewire\Backend\Contracts;
//
//use App\Models\Listing\ListingAgreement;
//use Livewire\Component;
//use Illuminate\Http\Request;
//
//class ViewOrderAgreement extends Component
//{
//public function render(Request $request)
//{
//$Lisiting = ListingAgreement::with([
//'all_listing' => [
//'paymentinfo',
//'additional_info',
//'pickup_delivery_info',
//'vehicles',
//'routes',
//'listing_origin_location',
//'listing_destination_locations',
//'attachments',
//'miscellenous',
//'bol' => [
//'bol_attachments'
//],
//'history',
//'cancel',
//'update_history',
//'driver'
//],
//'authorized_user' => function ($q) {
//$q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
//'insurance',
//'certificates'
//]);
//},
//'agreement_user' => function ($q) {
//$q->select('id', 'Company_Name', 'Time_Zone', 'Hours_Operations', 'Contact_Phone', 'Address', 'Local_Phone', 'Mc_Number')->with([
//'insurance',
//'certificates'
//]);
//}
//])->where('order_id', $request->List_ID)->first();
//
//$History = ListingAgreement::with('all_listing')->whereHas('all_listing', function ($q) {
//$q->where('Listing_Status', '!=', 'Listed');
//})->first();
//
//// dd($History->toArray());
//$Agreement = $Lisiting->all_listing->Listing_Status === 'Waiting For Approval';
//
//if ($Lisiting) {
//return view('livewire.backend.contracts.view-order-agreement', compact('Lisiting', 'Agreement', 'History'))->layout('layouts.summary');
//} else {
//return view('livewire.backend.contracts.view-detail', compact('Lisiting', 'Agreement', 'History'))->layout('layouts.summary');
//}
//}
//}
