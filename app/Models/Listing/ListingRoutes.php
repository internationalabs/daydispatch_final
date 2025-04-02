<?php

namespace App\Models\Listing;

use App\Models\History\OrderUpdateHistoryActions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingRoutes extends Model
{
    use HasFactory;
    protected $table = "listing_routes";

    /**
     * Get the all_listing that owns the ListingRoutes
     *
     * @return BelongsTo
     */
    public function all_listing()
    {
        return $this->belongsTo(AllUserListing::class, 'order_id', 'id');
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

    public function miles(): Attribute
    {
        return new Attribute(
            get: fn ($value) => number_format((int) $value),
            set: fn ($value) => $value,
        );
    }

    public static function boot()
    {
        parent::boot();
        static::updating(static function($item) {
            $originalAttributes = $item->getOriginal();
            $old_metaData = json_encode([
                'Origin Address' => ($originalAttributes['Origin_Address'] !== $item->Origin_Address) ? $originalAttributes['Origin_Address'] : null,
                'Origin Address II' => ($originalAttributes['Origin_Address_II'] !== $item->Origin_Address_II) ? $originalAttributes['Origin_Address_II'] : null,
                'Origin_ZipCode' => ($originalAttributes['Origin_ZipCode'] !== $item->Origin_ZipCode) ? $originalAttributes['Origin_ZipCode'] : null,
                'Destination Address' => ($originalAttributes['Destination_Address'] !== $item->Destination_Address) ? $originalAttributes['Destination_Address'] : null,
                'Destination Address II' => ($originalAttributes['Destination_Address_II'] !== $item->Pickup_Date) ? $originalAttributes['Destination_Address_II'] : null,
                'Dest ZipCode' => ($originalAttributes['Dest_ZipCode'] !== $item->Dest_ZipCode) ? $originalAttributes['Dest_ZipCode'] : null,
                'Miles' => ($originalAttributes['Miles'] !== $item->Miles) ? $originalAttributes['Miles'] : null
            ], JSON_THROW_ON_ERROR);
            $new_metaData = json_encode([
                'Origin Address' => ($originalAttributes['Origin_Address'] !== $item->Origin_Address) ? $item->Origin_Address : null,
                'Origin Address II' => ($originalAttributes['Origin_Address_II'] !== $item->Origin_Address_II) ? $item->Origin_Address_II : null,
                'Origin_ZipCode' => ($originalAttributes['Origin_ZipCode'] !== $item->Origin_ZipCode) ? $item->Origin_ZipCode : null,
                'Destination Address' => ($originalAttributes['Destination_Address'] !== $item->Destination_Address) ? $item->Destination_Address : null,
                'Destination Address II' => ($originalAttributes['Destination_Address_II'] !== $item->Pickup_Date) ? $item->Pickup_Date : null,
                'Dest ZipCode' => ($originalAttributes['Dest_ZipCode'] !== $item->Dest_ZipCode) ? $item->Dest_ZipCode : null,
                'Miles' => ($originalAttributes['Miles'] !== $item->Miles) ? $item->Miles : null
            ], JSON_THROW_ON_ERROR);
            OrderUpdateHistoryActions::create([
                'Order_Actions' => 'Update',
                'order_id' => $item->order_id,
                'user_id' => $item->user_id,
                'Old_Meta_Data' => $old_metaData,
                'New_Meta_Data' => $new_metaData
            ]);
        });
    }
}
