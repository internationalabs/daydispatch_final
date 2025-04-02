<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadboardRole extends Model
{
    use HasFactory;
    protected $table = 'loadboard_roles';
    protected $fillable = [
        'type',
        'name',
        'status',
        'account_info',
        'profile_edit',
        'payment_access',
        'load_posting',
        'assign_loads',
        'carrier_communication',
        'shipper_communication',
        'rate_carrier',
        'update_status',
        'search_load',
        'bid_loads',
        'broker_communication',
        'rate_broker',
    ];
}
