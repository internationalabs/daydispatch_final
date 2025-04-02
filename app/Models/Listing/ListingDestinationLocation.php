<?php

namespace App\Models\Listing;

use App\Models\History\OrderUpdateHistoryActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ListingDestinationLocation extends Model
{
    use HasFactory;
    // protected $table = "listing_destination_locations";
    protected $guarded = [];

    /**
     * Get the all_listing that owns the ListingDestinationLocation
     *
     * @return BelongsTo
     */
    public function all_listing(): BelongsTo
    {
        return $this->belongsTo(AllUserListing::class, );
    }

    public static function boot()
    {
        parent::boot();
        static::updating(static function($item) {
            $originalAttributes = $item->getOriginal();
            $old_metaData = json_encode([
                'Destination Location' => ($originalAttributes['Destination_Location'] !== $item->Destination_Location) ? $originalAttributes['Destination_Location'] : null,
                'Dest User Name' => ($originalAttributes['Dest_User_Name'] !== $item->Dest_User_Name) ? $originalAttributes['Dest_User_Name'] : null,
                'Dest User Email' => ($originalAttributes['Dest_User_Email'] !== $item->Dest_User_Email) ? $originalAttributes['Dest_User_Email'] : null,
                'Dest Local Phone' => ($originalAttributes['Dest_Local_Phone'] !== $item->Dest_Local_Phone) ? $originalAttributes['Dest_Local_Phone'] : null,
                'Dest Location' => ($originalAttributes['Dest_Location'] !== $item->Dest_Location) ? $originalAttributes['Dest_Location'] : null,
                'Dest Auction Method' => ($originalAttributes['Dest_Auction_Method'] !== $item->Dest_Auction_Method) ? $originalAttributes['Dest_Auction_Method'] : null,
                'Dest Auction Phone' => ($originalAttributes['Dest_Auction_Phone'] !== $item->Dest_Auction_Phone) ? $originalAttributes['Dest_Auction_Phone'] : null
            ], JSON_THROW_ON_ERROR);
            $new_metaData = json_encode([
                'Destination Location' => ($originalAttributes['Destination_Location'] !== $item->Destination_Location) ? $item->Destination_Location : null,
                'Dest User Name' => ($originalAttributes['Dest_User_Name'] !== $item->Dest_User_Name) ? $item->Dest_User_Name : null,
                'Dest User Email' => ($originalAttributes['Dest_User_Email'] !== $item->Dest_User_Email) ? $item->Dest_User_Email : null,
                'Dest Local Phone' => ($originalAttributes['Dest_Local_Phone'] !== $item->Dest_Local_Phone) ? $item->Dest_Local_Phone : null,
                'Dest Location' => ($originalAttributes['Dest_Location'] !== $item->Dest_Location) ? $item->Dest_Location : null,
                'Dest Auction Method' => ($originalAttributes['Dest_Auction_Method'] !== $item->Dest_Auction_Method) ? $item->Dest_Auction_Method : null,
                'Dest Auction Phone' => ($originalAttributes['Dest_Auction_Phone'] !== $item->Dest_Auction_Phone) ? $item->Dest_Auction_Phone : null
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
