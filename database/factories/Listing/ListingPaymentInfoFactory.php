<?php

namespace Database\Factories\Listing;

<<<<<<< HEAD
use App\Models\Listing\ListingPaymentInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ListingPaymentInfo>
=======
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing\ListingPaymentInfo>
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
 */
class ListingPaymentInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $payment = rand(200, 10000);
        $Carrier_Pay = $payment/2;
        $Cod_Amount = ($Carrier_Pay <= 1000)? $Carrier_Pay : $Carrier_Pay/2;
        $Bal = $Carrier_Pay - $Cod_Amount;
        return [
            'Order_Booking_Price' => intval($payment),
            'Price_Pay_Carrier' => intval($Carrier_Pay),
            'Payment_Method_Mode' => fake()->randomElement(['COD', 'Quick Pay']),
            'COD_Amount' => $Cod_Amount,
            'Balance_Amount' => $Bal,
            'COD_Method_Mode' => fake()->randomElement(['Check', 'Cash / Certified Funds']),
            'COD_Location_Amount' => fake()->randomElement(['Pickup', 'Delivery']),
            'Bal_Method_Mode' => ($Bal != 0)? fake()->randomElement(['Cash', 'Company Check', 'Certified Funds', 'Comchek', 'TCH']) : '',
            'BAL_Payment_Time' => ($Bal != 0)? fake()->randomElement(['Immediately', '2 Business Days']) : '',
            'BAL_Payment_Terms' => ($Bal != 0)? fake()->randomElement(['Pickup', 'Delivery', 'Recieving a Sign of Bill of Lading']) : '',
            'Payment_Desc' => fake()->text,
        ];
    }
}
