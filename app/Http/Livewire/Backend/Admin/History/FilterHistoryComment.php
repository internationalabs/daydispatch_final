<?php

namespace App\Http\Livewire\Backend\Admin\History;

use App\Models\Listing\AllCarriers;
use App\Models\Listing\LogisticBroker;
use App\Models\Listing\LogisticCarrier;
use App\Models\Listing\LogisticShipper;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\CarrierHistoryComment;
use App\Models\LogisticBrokerHistoryComment;
use App\Models\LogisticCarrierHistoryComment;
use App\Models\LogisticShipperHistoryComment;
use App\Models\Auth\AuthorizedAgent;
use Carbon\Carbon;
use App\Models\History\CarrierCallHistory;
use App\Models\History\LogisticBrokerCallHistory;
use App\Models\History\LogisticCarrierCallHistory;
use App\Models\History\LogisticShipperCallHistory;

class FilterHistoryComment extends Component
{
    public function render()
    {
        return view('livewire.backend.admin.history.filterComments')->layout('layouts.authorized-admin');
    }

    public function filter(Request $request)
    {
        $data = [];

        if ($request->type == "Carrier") {
            $data = CarrierHistoryComment::with(['user', 'history']);
        } elseif ($request->type == "Logistic Broker") {
            $data = LogisticBrokerHistoryComment::with(['user', 'history']);
        } elseif ($request->type == "Logistic Carrier") {
            $data = LogisticCarrierHistoryComment::with(['user', 'history']);
        } elseif ($request->type == "Logistic Shipper") {
            $data = LogisticShipperHistoryComment::with(['user', 'history']);
        }

        if ($request->has('status') && $request->status != null) {

            $status = $request->status;
            $data->where('status', $status);
        }

        if ($request->has('start')) {

            $start = $request->start;
            $end = $request->end;

            // Validate input values
            if ($start && $end) {
                $data->where('created_at', '>=', Carbon::parse($start)->startOfDay())
                    ->where('created_at', '<=', Carbon::parse($end)->endOfDay());
            }
        }
        if ($request->has('search') && $request->search !== null) {
            $data->where('comment', 'LIKE', '%' . $request->search . '%');
        }

        return $data->get();
    }

    public function getCarrierHistory(Request $request)
    {
        $data = CarrierCallHistory::with('user')->where('id', $request->historyId)->first();
         return $data;
    }

    public function getLogBrokerHistory(Request $request)
    {
        $data = LogisticBrokerCallHistory::with('user')->where('id', $request->historyId)->first();
         return $data;
    }

    public function getLogCarrierHistory(Request $request)
    {
        $data = LogisticCarrierCallHistory::with('user')->where('id', $request->historyId)->first();
         return $data;
    }

    public function getLogShipperHistory(Request $request)
    {
        $data = LogisticShipperCallHistory::with('user')->where('id', $request->historyId)->first();
         return $data;
    }
}