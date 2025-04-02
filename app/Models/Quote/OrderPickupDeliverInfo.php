<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderPickupDeliverInfo extends Model
{
    protected $table = 'order_pickup_deliver_infos';

    protected $fillable = [
        'Pickup_Date',
        'Pickup_Date_mode',
        'Delivery_Date',
        'Delivery_Date_mode',
        'order_id',
        'user_id',
        'Pickup_Start_Time',
        'Pickup_End_Time',
        'Delivery_Start_Time',
        'Delivery_End_Time',
    ];

    // Additional relationships, methods, etc., can go here
}
