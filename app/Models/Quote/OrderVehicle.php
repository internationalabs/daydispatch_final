<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderVehicle extends Model
{
    protected $table = 'order_vehicles';

    protected $fillable = [
        'Reg_By',
        'Vin_Number',
        'Vehcile_Year',
        'Vehcile_Make',
        'Vehcile_Model',
        'Vehcile_Color',
        'Vehcile_Type',
        'Vehcile_Condition',
        'Trailer_Type',
        'order_id',
        'user_id',
    ];

    // Additional relationships, methods, etc., can go here
}
