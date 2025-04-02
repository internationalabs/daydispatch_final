<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingHeavyEquipment extends Model
{
    use HasFactory;
    protected $table = "listing_heavy_equipment";
    protected $fillable = ['Equipment_Year', 'Equipment_Make', 'Equipment_Model', 'Equipment_Condition', 'Trailer_Type', 'Equip_Length', 'Equip_Width', 'Equip_Height', 'Equip_Weight', 'Shipment_Preferences', 'order_id', 'user_id'];

    /**
     * Get the all_listing that owns the ListingRoutes
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
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
