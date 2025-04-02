<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrderTracker extends Model
{
    use HasFactory;
    protected $table = "custom_order_trackers";
}
