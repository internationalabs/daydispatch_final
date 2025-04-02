<?php

namespace App\Http\Livewire\Backend\MyDispatching;

use App\Services\ListingServices;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WaitingForMyApproval extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices): void
    {
        $this->listingServices = $listingServices;
    }

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Lisiting = $this->listingServices->getWaitingOrders();
        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
        } else {
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        }
        // dd($Lisiting);
        return view('livewire.backend.my-dispatching.waiting-for-my-approval', compact('Lisiting'))->layout('layouts.authorized');
    }
}
