<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderDryVanServices extends Model
{
    protected $table = 'order_dry_van_services';

    protected $fillable = [
        'Pickup_Service',
        'Delivery_Service',
        'order_id',
        'user_id',
    ];

    // Additional relationships, methods, etc., can go here
}
