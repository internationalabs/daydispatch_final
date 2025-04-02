<?php

namespace App\Http\Livewire\Backend\Admin\History;

use Response;
use App\Models\Auth\AuthorizedAdmin;
use App\Models\Listing\AllCarriers;
use App\Models\LogisticShipperHistoryComment;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\History\LogisticShipperCallHistory;

class LogisticShippersHistory extends Component
{
    public function render(Request $request)
    {
        $Lisiting = LogisticShipperCallHistory::get();
        
        return view('livewire.backend.admin.history.all-logistic-shipper', compact('Lisiting'))->layout('layouts.authorized-admin');
    }
 
    public function storeComment(Request $request)
    {
        $Comment = new LogisticShipperHistoryComment;
        $Comment->history_id = $request->historyId;
        $Comment->user_id = Auth::guard('Admin')->user()->id;
        $Comment->comment = $request->comment;
        $Comment->status = $request->status;
        $Comment->save();

        return back();
    }
 
    public function getComment(Request $request)
    {
        $data = LogisticShipperHistoryComment::with('user')->where('history_id', $request->HistoryID)->get();
        return $data;
    }
}
