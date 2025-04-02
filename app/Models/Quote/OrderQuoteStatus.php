<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\AuthorizedUsers;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quote\OrderOriginLocation;
use App\Models\Listing\ListingAttachments;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderQuoteStatus extends Model
{
    use HasFactory;
    protected $table = 'order_quote_status';

    protected $fillable = [
        'user_id',
        'order_id',
        'history_status',
        'expected_date',
        'history_description',
    ];

    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
