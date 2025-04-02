<?php

namespace App\Models\Carrier;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestBroker extends Model
{
    use HasFactory;
    protected $table = "request_brokers";
    protected $fillable = ['is_cancel', 'order_id', 'user_id', 'CMP_id', 'type'];

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

    public function scopeActive($query)
    {
        return $query->where('is_cancel', 0);
    }

    public function offerPrice(): Attribute
    {
        return new Attribute(
            get: fn($value) => number_format((int) $value),
            set: fn($value) => $value,
        );
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }

    public function pickupDate(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }

    public function deliveryDate(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('M d, Y', strtotime($value)),
            set: fn($value) => $value,
        );
    }
}
