<?php

namespace App\Http\Livewire\Backend\Contracts;

use App\Models\Profile\MyContract;
use Livewire\Component;
use Illuminate\Http\Request;

class AdminMyContract extends Component
{
    public function render(Request $request)
    {
        $Contract = MyContract::get();

        return view('livewire.backend.admin.MyContracts.index', compact('Contract'));
    }

    public function AddMyContractAdmin()
    {
        return view('livewire.backend.admin.MyContracts.create');
    }

    public function StoreMyContractAdmin(Request $request)
    {
        $Contract = new MyContract;
        $Contract->My_Contract = $request->My_Contract;
        $Contract->save();

        return back();
    }

    public function EditMyContractAdmin()
    {
        return view('livewire.backend.admin.MyContracts.edit');
    }

    public function UpdateMyContractAdmin(Request $request)
    {
        $Contract = MyContract::where('id', $request->Contract_Id)->first();
        $Contract->My_Contract = $request->My_Contract;
        $Contract->save();

        return back();
    }
}
