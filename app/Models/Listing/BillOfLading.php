<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BillOfLading extends Model
{
    use HasFactory;
    protected $table = "bill_of_ladings";

    /**
     * Get the authorized_user that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function authorized_user()
    {
        return $this->belongsTo(AuthorizedUsers::class, 'user_id');
    }

    /**
     * Get the all_listing that owns the Dispatch
     *
     * @return BelongsTo
     */
    public function all_listing()
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
    }

    /**
     * Get all of the bol_attachments for the BillOfLading
     *
     * @return HasMany
     */
    public function bol_attachments()
    {
        return $this->hasMany(BolAttachment::class, 'bol_id', 'id');
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y', strtotime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('M d, Y', strtotime($value)),
            set: fn ($value) => $value,
        );
    }
}
