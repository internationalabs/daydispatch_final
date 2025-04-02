<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingAttachments extends Model
{
    use HasFactory;
    protected $table = "listing_attachments";

    /**
     * Get the all_listing that owns the ListingAddtionalInfo
     *
     * @return BelongsTo
     */
    public function all_listing()
    {
        return $this->belongsTo(AllUserListing::class, );
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
