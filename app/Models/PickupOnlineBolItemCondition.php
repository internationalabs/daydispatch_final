<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupOnlineBolItemCondition extends Model
{
    use HasFactory;

    protected $fillable = ['onlinebol_id', 'item_name', 'condition'];
}
