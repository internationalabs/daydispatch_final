<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineBolItemCondition extends Model
{
    use HasFactory;
    // protected $guarder[];
    protected $fillable = ['onlinebol_id', 'item_name', 'condition'];
    
}
