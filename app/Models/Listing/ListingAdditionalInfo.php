<?php

namespace App\Models\Listing;

use App\Models\History\OrderUpdateHistoryActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ListingAdditionalInfo extends Model
{
    use HasFactory;
    protected $table = "listing_additional_infos";

    /**
     * Get the all_listing that owns the ListingAddtionalInfo
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
                'Additional Terms' => ($originalAttributes['Additional_Terms'] !== $item->Additional_Terms) ? $originalAttributes['Additional_Terms'] : null,
                'Special Instructions' => ($originalAttributes['Special_Instructions'] !== $item->Special_Instructions) ? $originalAttributes['Special_Instructions'] : null,
                'Notes Customer' => ($originalAttributes['Notes_Customer'] !== $item->Notes_Customer) ? $originalAttributes['Notes_Customer'] : null,
                'Contract' => ($originalAttributes['Contract'] !== $item->Contract) ? $originalAttributes['Contract'] : null,
                'Vehicle Desc' => ($originalAttributes['Vehcile_Desc'] !== $item->Vehcile_Desc) ? $originalAttributes['Vehcile_Desc'] : null
            ], JSON_THROW_ON_ERROR);
            $new_metaData = json_encode([
                'Additional Terms' => ($originalAttributes['Additional_Terms'] !== $item->Additional_Terms) ? $item->Additional_Terms : null,
                'Special Instructions' => ($originalAttributes['Special_Instructions'] !== $item->Special_Instructions) ? $item->Special_Instructions : null,
                'Notes Customer' => ($originalAttributes['Notes_Customer'] !== $item->Notes_Customer) ? $item->Notes_Customer : null,
                'Contract' => ($originalAttributes['Contract'] !== $item->Contract) ? $item->Contract : null,
                'Vehicle Desc' => ($originalAttributes['Vehcile_Desc'] !== $item->Vehcile_Desc) ? $item->Vehcile_Desc : null
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
