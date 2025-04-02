<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingVehciles extends Model
{
    use HasFactory;
    protected $table = "listing_vehciles";
    protected $fillable = ['Reg_By', 'Vin_Number', 'Vehcile_Year', 'Vehcile_Make', 'Vehcile_Model', 'Vehcile_Color', 'Vehcile_Type', 'Vehcile_Condition', 'Trailer_Type', 'order_id', 'user_id'];

    /**
     * Get the all_listing that owns the ListingRoutes
     *
     * @return BelongsTo
     */
    public function all_listing()
    {
        return $this->belongsTo(AllUserListing::class, 'order_id', 'id');
    }

    public function vehcileCondition(): Attribute
    {
        return new Attribute(
            // get: fn ($value) => $value === 'Not Running' ? '"(INOP Vehicle)"' : 'Running',
            get: fn($value) => $value === 'Not Running' ? 'Not Running' : 'Running',
            set: fn($value) => $value,
        );
    }

    public function trailerType(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return $value === 'Enclosed' ? 'Enclosed Trailer' : ($value === 'Open' ? 'Open Trailer' : $value);
            },
            set: function ($value) {
                return $value;
            }
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

}
