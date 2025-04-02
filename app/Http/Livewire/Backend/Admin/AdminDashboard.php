<?php

namespace App\Http\Livewire\Backend\Admin;

use App\Helpers\DayDispatchHelper;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $orderCount = DayDispatchHelper::getAdminCounts();

        return view('livewire.backend.admin.admin-dashboard', compact('orderCount'))->layout('layouts.authorized-admin');
    }
}
