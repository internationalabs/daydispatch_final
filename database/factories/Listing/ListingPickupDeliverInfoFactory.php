<?php

namespace Database\Factories\Listing;

<<<<<<< HEAD
use App\Models\Listing\ListingPickupDeliverInfo;
=======
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
<<<<<<< HEAD
 * @extends Factory<ListingPickupDeliverInfo>
=======
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing\ListingPickupDeliverInfo>
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
 */
class ListingPickupDeliverInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $Pickup = Carbon::now()->addDays(rand(1,2))->format('F d, Y');
        $Delivery = Carbon::now()->addDays(rand(3,10))->format('F d, Y');
        return [
            'Pickup_Date' => $Pickup,
            'Pickup_Date_mode' => fake()->randomElement(['Before', 'After', 'On', 'ASAP']),
            'Delivery_Date' => $Delivery,
            'Delivery_Date_mode' => fake()->randomElement(['Before', 'After', 'On', 'ASAP']),
        ];
    }
}
