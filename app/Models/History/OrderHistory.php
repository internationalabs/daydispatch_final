<?php

namespace App\Models\History;

use App\Models\Auth\AuthorizedUsers;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderHistory extends Model
{
    use HasFactory;
    protected $table = "order_histories";
    protected $fillable = ['status', 'cancel_by', 'archived_by', 'order_id', 'user_id', 'CMP_id'];

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
     * Get the assigned_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function assigned_user(): BelongsTo
    {
        return $this->belongsTo(AuthorizedUsers::class, 'CMP_id');
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y H:i:s', strtotime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y H:i:s', strtotime($value)),
            set: fn ($value) => $value,
        );
    }
}
