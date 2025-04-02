<?php

namespace App\Http\Livewire\Backend\MyDispatching;

use App\Models\Listing\AllUserListing;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TimeQoute extends Component
{
    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        if ($auth_user->usr_type === 'Carrier') {
            $Lisiting = AllUserListing::inActive()->carrierlisting()->where('user_id', $auth_user->id)->get();
        } else {
            $Lisiting = AllUserListing::inActive()->brokerlisting()->where('user_id', $auth_user->id)->get();
        }
        // dd($Lisiting);

        return view('livewire.backend.my-dispatching.time-qoute', compact('Lisiting', 'auth_user'))->layout('layouts.authorized');
    }
}
