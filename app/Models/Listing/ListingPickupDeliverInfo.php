<?php

namespace App\Models\Listing;

use App\Models\History\OrderUpdateHistoryActions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JsonException;

class ListingPickupDeliverInfo extends Model
{
    use HasFactory;

    protected $table = "listing_pickup_deliver_infos";

    /**
     * Get the all_listing that owns the ListingPickupDeliverInfo
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, 'order_id');
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
            get: fn($value) => (!empty($value)) ? date('M d, Y', strtotime($value)) : '',
            set: fn($value) => $value,
        );
    }

    public static function boot()
    {
        parent::boot();
        static::updating(/**
         * @throws JsonException
         */ static function ($item) {
            $originalAttributes = $item->getOriginal();
            $old_metaData = json_encode([
                'Pickup Date' => ($originalAttributes['Pickup_Date'] !== $item->Pickup_Date) ? $originalAttributes['Pickup_Date'] : null,
                'Pickup Date mode' => ($originalAttributes['Pickup_Date_mode'] !== $item->Pickup_Date_mode) ? $originalAttributes['Pickup_Date_mode'] : null,
                'Delivery Date' => ($originalAttributes['Delivery_Date'] !== $item->Delivery_Date) ? $originalAttributes['Delivery_Date'] : null,
                'Delivery Date mode' => ($originalAttributes['Delivery_Date_mode'] !== $item->Delivery_Date_mode) ? $originalAttributes['Delivery_Date_mode'] : null
            ], JSON_THROW_ON_ERROR);
            $new_metaData = json_encode([
                'Pickup Date' => ($originalAttributes['Pickup_Date'] !== $item->Pickup_Date) ? $item->Pickup_Date : null,
                'Pickup Date mode' => ($originalAttributes['Pickup_Date_mode'] !== $item->Pickup_Date_mode) ? $item->Pickup_Date_mode : null,
                'Delivery Date' => ($originalAttributes['Delivery_Date'] !== $item->Delivery_Date) ? $item->Delivery_Date : null,
                'Delivery Date mode' => ($originalAttributes['Delivery_Date_mode'] !== $item->Delivery_Date_mode) ? $item->Delivery_Date_mode : null
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
