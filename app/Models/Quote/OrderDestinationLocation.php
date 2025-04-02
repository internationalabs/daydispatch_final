<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderDestinationLocation extends Model
{
    protected $table = 'order_destination_locations';

    protected $fillable = [
        'Destination_Location',
        'Dest_User_Name',
        'Dest_User_Email',
        'Dest_Local_Phone',
        'Dest_Location',
        'Dest_Auction_Method',
        'Dest_Auction_Phone',
        'Dest_Stock_Number',
        'order_id',
        'user_id',
        'Dest_Business_Location',
        'Dest_Business_Phone',
    ];

    // Additional relationships, methods, etc., can go here
}
