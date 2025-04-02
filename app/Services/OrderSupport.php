<?php

namespace App\Services;

use App\Models\Support\ThreeWayTicket;
use Illuminate\Database\Eloquent\Collection;

class OrderSupport
{
    public function getOrderTickets(): Collection|array
    {
        return ThreeWayTicket::ticket()->orderBy('id', 'DESC')->get();
    }
    public function getTicketDetail($Ticket_ID)
    {
        return ThreeWayTicket::ticket()->where('id', $Ticket_ID)->first();
    }
}
