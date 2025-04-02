<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderAdditionalInfo extends Model
{
    protected $table = 'order_additional_infos';

    protected $fillable = [
        'Additional_Terms',
        'Special_Instructions',
        'Notes_Customer',
        'Contract',
        'Vehcile_Desc',
        'order_id',
        'user_id',
    ];

    // Additional relationships, methods, etc., can go here
}
