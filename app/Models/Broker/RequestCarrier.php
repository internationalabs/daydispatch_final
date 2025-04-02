<?php

namespace App\Models\Broker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestCarrier extends Model
{
    use HasFactory;

    protected $table = "request_carriers";

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    /**
     * Get the all_listing that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
    }

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function requested_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'CMP_id');
    }
}
