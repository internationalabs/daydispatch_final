<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingDryVan extends Model
{
    use HasFactory;
    protected $table = "listing_dry_vans";
    protected $fillable = ['Freight_Class', 'Freight_Weight', 'is_hazmat_Check', 'Shipment_Preferences', 'order_id', 'user_id', 'Trailer_Type_Dry'];

    /**
     * Get the all_listing that owns the ListingRoutes
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
