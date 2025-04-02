<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderOriginLocation extends Model
{
    protected $table = 'order_origin_locations';

    protected $fillable = [
        'Orign_Location',
        'User_Name',
        'User_Email',
        'Local_Phone',
        'Location',
        'Auction_Method',
        'Auction_Phone',
        'Stock_Number',
        'order_id',
        'user_id',
        'Business_Location',
        'Business_Phone',
    ];

    // Additional relationships, methods, etc., can go here
}
