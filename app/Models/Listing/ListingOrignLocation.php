<?php

namespace App\Models\Listing;

use App\Models\History\OrderUpdateHistoryActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingOrignLocation extends Model
{
    use HasFactory;
    protected $table = "listing_orign_locations";
    protected $fillable = ['Orign_Location', 'User_Name', 'User_Email', 'Local_Phone', 'Location', 'Auction_Method', 'Auction_Phone', 'Stock_Number', 'order_id', 'user_id'];

    /**
     * Get the all_listing that owns the ListingOrignLocation
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
        static::updating(static function ($item) {
            $originalAttributes = $item->getOriginal();
            $old_metaData = json_encode([
                'Origin Location' => ($originalAttributes['Orign_Location'] !== $item->Orign_Location) ? $originalAttributes['Orign_Location'] : null,
                'User Name' => ($originalAttributes['User_Name'] !== $item->User_Name) ? $originalAttributes['User_Name'] : null,
                'User Email' => ($originalAttributes['User_Email'] !== $item->User_Email) ? $originalAttributes['User_Email'] : null,
                'Location' => ($originalAttributes['Location'] !== $item->Location) ? $originalAttributes['Location'] : null,
                'Auction Method' => ($originalAttributes['Auction_Method'] !== $item->Auction_Method) ? $originalAttributes['Auction_Method'] : null,
                'Auction Phone' => ($originalAttributes['Auction_Phone'] !== $item->Auction_Phone) ? $originalAttributes['Auction_Phone'] : null,
                'Stock Number' => ($originalAttributes['Stock_Number'] !== $item->Stock_Number) ? $originalAttributes['Stock_Number'] : null
            ], JSON_THROW_ON_ERROR);
            $new_metaData = json_encode([
                'Origin Location' => ($originalAttributes['Orign_Location'] !== $item->Orign_Location) ? $item->Orign_Location : null,
                'User Name' => ($originalAttributes['User_Name'] !== $item->User_Name) ? $item->User_Name : null,
                'User Email' => ($originalAttributes['User_Email'] !== $item->User_Email) ? $item->User_Email : null,
                'Location' => ($originalAttributes['Location'] !== $item->Location) ? $item->Location : null,
                'Auction Method' => ($originalAttributes['Auction_Method'] !== $item->Auction_Method) ? $item->Auction_Method : null,
                'Auction Phone' => ($originalAttributes['Auction_Phone'] !== $item->Auction_Phone) ? $item->Auction_Phone : null,
                'Stock Number' => ($originalAttributes['Stock_Number'] !== $item->Stock_Number) ? $item->Stock_Number : null
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
