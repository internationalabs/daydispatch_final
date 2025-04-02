<?php

namespace App\Http\Livewire\Backend\Admin\Carriers;

use App\Models\Listing\AllCarriers;
use App\Models\Listing\LogisticBroker;
use App\Models\Listing\LogisticCarrier;
use App\Models\Listing\LogisticShipper;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\History\LogisticBrokerCallHistory;
use App\Models\Listing\CarrierCallCount;
use App\Models\Listing\LogisticBrokerCallCount;
use App\Models\Listing\LogisticCarrierCallCount;
use App\Models\Listing\LogisticShipperCallCount;
use App\Models\Auth\AuthorizedAgent;
use Carbon\Carbon;

class FilterAgentCalls extends Component
{
    public function render()
    {
        $agent = AuthorizedAgent::get();
        return view('livewire.backend.admin.listing.filterAgentCalls', compact('agent'))->layout('layouts.authorized-admin');
    }
    
    public function filter(Request $request)
    {
        
        $data = [];

        if ($request->type == "Carrier") {
            $data = AllCarriers::with(['lastStatus', 'agent', 'callCount'])->has('callCount');
        } elseif ($request->type == "Logistic Broker") {
            $data = LogisticBroker::with(['lastStatus', 'agent', 'callCount'])->has('callCount');
        } elseif ($request->type == "Logistic Carrier") {
            $data = LogisticCarrier::with(['lastStatus', 'agent', 'callCount'])->has('callCount');
        } elseif ($request->type == "Logistic Shipper") {
            $data = LogisticShipper::with(['lastStatus', 'agent', 'callCount'])->has('callCount');
        }

        if ($request->has('status')) {

            // $status = $request->status;

            // $allHaveLastStatus = true;

            // $data->each(function ($item) use (&$allHaveLastStatus) {
            //     if (!$item->relationLoaded('lastStatus')) {
            //         $allHaveLastStatus = false;
            //         // If you want to stop the iteration when the first item without lastStatus is found,
            //         // you can uncomment the line below.
            //         // return false;
            //     }
            // });

            // if ($allHaveLastStatus) {
            //     $data->whereHas('lastStatus', function ($query) use ($status) {
            //         $query->where('connectStatus', $status);
            //     });
            // }
        }
        if ($request->has('start')) {
            
            $start = $request->start;
            $end = $request->end;
            
            // Validate input values
            if ($start && $end) {
                $data->whereHas('callCount', function ($query) use ($start, $end) {
                    $query->where('created_at', '>=', Carbon::parse($start)->startOfDay())
                        ->where('created_at', '<=', Carbon::parse($end)->endOfDay());
                });
            }
        }
        if ($request->has('agent') && $request->agent !== null) {
            $data->where('user_id', $request->agent);
        }
        if ($request->has('search') && $request->search !== null) {
            $data->where('company_name', 'LIKE', '%' . $request->search . '%');
        }

        return $data->get();
        
    }
}
