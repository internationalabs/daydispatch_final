<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledOrdersQuote extends Model
{
    use HasFactory;

    protected $table = "order_cancelled_quote";

    protected $fillable = [
        'user_id',
        'order_id',
        'description',
    ];
}
