<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentInfo extends Model
{
    protected $table = 'order_payment_infos';

    protected $fillable = [
        'Order_Booking_Price',
        'Deposite_Amount',
        'Payment_Method_Mode',
        'Price_Pay_Carrier',
        'COD_Amount',
        'Balance_Amount',
        'COD_Method_Mode',
        'Bal_Method_Mode',
        'COD_Location_Amount',
        'BAL_Payment_Time',
        'BAL_Payment_Terms',
        'Payment_Desc',
        'order_id',
        'user_id',
    ];

    // Additional relationships, methods, etc., can go here
}
