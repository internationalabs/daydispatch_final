<?php

namespace App\Http\Livewire\Backend\MyDispatching;

use App\Services\ListingServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyCancelled extends Component
{
    protected ListingServices $listingServices;

    public function mount(ListingServices $listingServices)
    {
        $this->listingServices = $listingServices;
    }

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Lisiting = $this->listingServices->getCancelledOrders();
        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = $Lisiting->where('user_id', $auth_user->id);
        } else {
            $Lisiting = $Lisiting->where('CMP_id', $auth_user->id);
        }
        return view('livewire.backend.my-dispatching.my-cancelled', compact('Lisiting'))->layout('layouts.authorized');
    }
}
