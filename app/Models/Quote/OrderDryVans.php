<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderDryVans extends Model
{
    protected $table = 'order_dry_vans';

    protected $fillable = [
        'Freight_Class',
        'Freight_Weight',
        'is_hazmat_Check',
        'Shipment_Preferences',
        'order_id',
        'user_id',
        'Trailer_Specification_Dry',
        'Trailer_Type_Dry',
    ];

    // Additional relationships, methods, etc., can go here
}
