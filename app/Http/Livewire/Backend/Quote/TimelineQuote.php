<?php

namespace App\Http\Livewire\Backend\Quote;

use Livewire\Component;
use App\Models\Quote\Order;
use App\Models\Quote\OrderQuoteStatus;
use Carbon\Carbon;

class TimelineQuote extends Component
{
    public function render()
    {
        $history = OrderQuoteStatus::has('order')->with('authorized_user', 'order')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($order) {
                return Carbon::parse($order->created_at)->format('F, Y'); // Group by month and year
            });

        return view('livewire.backend.quote.timeline-quote', compact('history'))
            ->layout('layouts.authorizedQuote');
    }
}
