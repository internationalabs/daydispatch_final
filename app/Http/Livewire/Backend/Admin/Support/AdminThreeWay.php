<?php

namespace App\Http\Livewire\Backend\Admin\Support;

use App\Services\OrderSupport;
use Livewire\Component;

class AdminThreeWay extends Component
{
    protected OrderSupport $orderSupport;

    public function mount(OrderSupport $orderSupport): void
    {
        $this->orderSupport = $orderSupport;
    }

    public function render()
    {
        $Tickets = $this->orderSupport->getOrderTickets();

        return view('livewire.backend.admin.support.admin-three-way', compact('Tickets'))->layout('layouts.authorized-admin');
    }
}
