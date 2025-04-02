<?php

namespace App\Models\Listing;

use App\Models\History\OrderUpdateHistoryActions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingPaymentInfo extends Model
{
    use HasFactory;
    protected $table = "listing_payment_infos";

    protected $fillable = ['Price_Pay_Carrier'];

    /**
     * Get the all_listing that owns the ListingPaymentInfo
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

    public function orderBookingPrice(): Attribute
    {
        return new Attribute(
            get: fn ($value) => number_format((int) $value),
            set: fn ($value) => $value,
        );
    }

    public function codAmount(): Attribute
    {
        return new Attribute(
            get: fn ($value) => number_format((int) $value),
            set: fn ($value) => $value,
        );
    }

    public function pricepaycarrier(): Attribute
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
                'Order Booking Price' => ($originalAttributes['Order_Booking_Price'] !== $item->Order_Booking_Price) ? $originalAttributes['Order_Booking_Price'] : null,
                'Deposit Amount' => ($originalAttributes['Deposite_Amount'] !== $item->Deposite_Amount) ? $originalAttributes['Deposite_Amount'] : null,
                'Payment Method Mode' => ($originalAttributes['Payment_Method_Mode'] !== $item->Payment_Method_Mode) ? $originalAttributes['Payment_Method_Mode'] : null,
                'Price Pay Carrier' => ($originalAttributes['Price_Pay_Carrier'] !== $item->Price_Pay_Carrier) ? $originalAttributes['Price_Pay_Carrier'] : null,
                'COD_Amount' => ($originalAttributes['COD_Amount'] !== $item->COD_Amount) ? $originalAttributes['COD_Amount'] : null,
                'Balance Amount' => ($originalAttributes['Balance_Amount'] !== $item->Balance_Amount) ? $originalAttributes['Balance_Amount'] : null,
                'COD Method Mode' => ($originalAttributes['COD_Method_Mode'] !== $item->COD_Method_Mode) ? $originalAttributes['COD_Method_Mode'] : null,
                'Bal_Method_Mode' => ($originalAttributes['Bal_Method_Mode'] !== $item->Bal_Method_Mode) ? $originalAttributes['Bal_Method_Mode'] : null,
                'COD Location Amount' => ($originalAttributes['COD_Location_Amount'] !== $item->COD_Location_Amount) ? $originalAttributes['COD_Location_Amount'] : null,
                'BAL Payment Time' => ($originalAttributes['BAL_Payment_Time'] !== $item->BAL_Payment_Time) ? $originalAttributes['BAL_Payment_Time'] : null,
                'BAL Payment Terms' => ($originalAttributes['BAL_Payment_Terms'] !== $item->BAL_Payment_Terms) ? $originalAttributes['BAL_Payment_Terms'] : null,
                'Payment Desc' => ($originalAttributes['Payment_Desc'] !== $item->Payment_Desc) ? $originalAttributes['Payment_Desc'] : null
            ], JSON_THROW_ON_ERROR);
            $new_metaData = json_encode([
                'Order Booking Price' => ($originalAttributes['Order_Booking_Price'] !== $item->Order_Booking_Price) ? $item->Order_Booking_Price : null,
                'Deposit Amount' => ($originalAttributes['Deposite_Amount'] !== $item->Deposite_Amount) ? $item->Deposite_Amount : null,
                'Payment Method Mode' => ($originalAttributes['Payment_Method_Mode'] !== $item->Payment_Method_Mode) ? $item->Payment_Method_Mode : null,
                'Price Pay Carrier' => ($originalAttributes['Price_Pay_Carrier'] !== $item->Price_Pay_Carrier) ? $item->Price_Pay_Carrier : null,
                'COD_Amount' => ($originalAttributes['COD_Amount'] !== $item->COD_Amount) ? $item->COD_Amount : null,
                'Balance Amount' => ($originalAttributes['Balance_Amount'] !== $item->Balance_Amount) ? $item->Balance_Amount : null,
                'COD Method Mode' => ($originalAttributes['COD_Method_Mode'] !== $item->COD_Method_Mode) ? $item->COD_Method_Mode : null,
                'Bal_Method_Mode' => ($originalAttributes['Bal_Method_Mode'] !== $item->Bal_Method_Mode) ? $item->Bal_Method_Mode : null,
                'COD Location Amount' => ($originalAttributes['COD_Location_Amount'] !== $item->COD_Location_Amount) ? $item->COD_Location_Amount : null,
                'BAL Payment Time' => ($originalAttributes['BAL_Payment_Time'] !== $item->BAL_Payment_Time) ? $item->BAL_Payment_Time : null,
                'BAL Payment Terms' => ($originalAttributes['BAL_Payment_Terms'] !== $item->BAL_Payment_Terms) ? $item->BAL_Payment_Terms : null,
                'Payment Desc' => ($originalAttributes['Payment_Desc'] !== $item->Payment_Desc) ? $item->Payment_Desc : null
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
