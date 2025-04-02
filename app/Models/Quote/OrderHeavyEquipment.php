<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderHeavyEquipment extends Model
{
    protected $table = 'order_heavy_equipment';

    protected $fillable = [
        'Equipment_Year',
        'Equipment_Make',
        'Equipment_Model',
        'Equipment_Condition',
        'Trailer_Type',
        'Equip_Length',
        'Equip_Width',
        'Equip_Height',
        'Equip_Weight',
        'Shipment_Preferences',
        'order_id',
        'user_id',
        'Trailer_Specification',
    ];

    // Additional relationships, methods, etc., can go here
}
