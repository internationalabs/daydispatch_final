<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderRoute extends Model
{
    protected $table = 'order_routes';

    protected $fillable = [
        'Origin_Address',
        'Origin_Address_II',
        'Origin_ZipCode',
        'Destination_Address',
        'Destination_Address_II',
        'Dest_ZipCode',
        'Miles',
        'order_id',
        'user_id',
    ];

    // Additional relationships, methods, etc., can go here
}
