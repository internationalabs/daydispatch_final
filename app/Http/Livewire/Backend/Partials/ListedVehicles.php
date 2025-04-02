<?php

namespace App\Http\Livewire\Backend\Partials;

use App\Models\Listing\ListingVehciles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListedVehicles extends Component
{
    // ========== Add Multiple Vehicles =================
    public $vehilces, $Reg_By, $Vin_Number, $Vehcile_Year, $Vehcile_Make, $Vehcile_Model, $Vehcile_Color, $Vehcile_Type, $Vehcile_Condition, $Trailer_Type, $vehicle_id;
    public int $L_PID;
    public bool $updateMode = false;
    public array $vehicles_inputs = [];
    public int $v = 1;

    public function render()
    {
        $L_PID = $this->L_PID;
        $this->vehilces = ListingVehciles::where('order_id', $L_PID)->get();
        return view('livewire.backend.partials.listed-vehicles', compact('L_PID'));
    }

    public function add($v): void
    {
        $v = $v + 1;
        $this->v = $v;
        $this->vehicles_inputs[] = $v;
    }

    public function remove($v): void
    {
        unset($this->vehicles_inputs[$v]);
    }

    private function resetVehiclesInputFields()
    {
        $this->Reg_By = '';
        $this->Vin_Number = '';
        $this->Vehcile_Year = '';
        $this->Vehcile_Make = '';
        $this->Vehcile_Model = '';
        $this->Vehcile_Color = '';
        $this->Vehcile_Type = '';
        $this->Vehcile_Condition = '';
        $this->Trailer_Type = '';
    }

    public function store(Request $request)
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $validate = $this->validate(
            [
                'Reg_By.0' => 'required',
                'Vehcile_Year.0' => 'required',
                'Vehcile_Make.0' => 'required',
                'Vehcile_Model.0' => 'required',
                'Vehcile_Color.0' => 'required',
                'Vehcile_Type.0' => 'required',
                'Vehcile_Condition.0' => 'required',
                'Trailer_Type.0' => 'required',
                'Reg_By.*' => 'required',
                'Vehcile_Year.*' => 'required',
                'Vehcile_Make.*' => 'required',
                'Vehcile_Model.*' => 'required',
                'Vehcile_Color.*' => 'required',
                'Vehcile_Type.*' => 'required',
                'Vehcile_Condition.*' => 'required',
                'Trailer_Type.*' => 'required'
            ]
        );

        foreach ($this->Reg_By as $key => $value) {
            ListingVehciles::create(
                [
                    'Reg_By' => $this->Reg_By[$key],
                    'Vehcile_Year' => $this->Vehcile_Year[$key],
                    'Vehcile_Make' => $this->Vehcile_Make[$key],
                    'Vehcile_Model' => $this->Vehcile_Model[$key],
                    'Vehcile_Color' => $this->Vehcile_Color[$key],
                    'Vehcile_Type' => $this->Vehcile_Type[$key],
                    'Vehcile_Condition' => $this->Vehcile_Condition[$key],
                    'Trailer_Type' => $this->Trailer_Type[$key],
                    'Vin_Number' => $this->Vin_Number[$key],
                    'order_id' => $request->order_id,
                    'user_id' => $user_id,
                ]
            );
        }

        $this->vehicles_inputs = [];
        $this->resetVehiclesInputFields();
        session()->flash('message', 'Vehicle Has Been Created Successfully.');
    }
}
