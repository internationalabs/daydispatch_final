<?php

namespace Database\Factories\Listing;

use App\Models\Listing\ListingOrignLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ListingOrignLocation>
 */
class ListingOriginLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $loc_type = rand(0,5);

        return match ($loc_type) {
            0 => [
                'Orign_Location' => 'Location',
                'User_Name' => fake()->unique()->name,
                'User_Email' => fake()->unique()->safeEmail,
                'Local_Phone' => fake()->phoneNumber,
                'Location' => fake()->randomElement(['Residence', 'Business']),
            ],
            1 => [
                'Orign_Location' => 'Dealership',
                'User_Name' => fake()->unique()->name,
                'User_Email' => fake()->unique()->safeEmail,
                'Local_Phone' => fake()->phoneNumber,
                'Auction_Method' => fake()->name,
                'Auction_Phone' => fake()->phoneNumber,
                'Stock_Number' => fake()->randomDigit(),
            ],
            2 => [
                'Orign_Location' => 'Auction',
                'User_Name' => fake()->unique()->name,
                'User_Email' => fake()->unique()->safeEmail,
                'Local_Phone' => fake()->phoneNumber,
                'Auction_Method' => fake()->randomElement(['COPART Auction', 'Manheim Auction', 'IAAI Auction']),
                'Auction_Phone' => fake()->phoneNumber,
                'Stock_Number' => fake()->randomDigit(),
            ],
            3 => [
                'Orign_Location' => 'Port',
                'User_Name' => fake()->unique()->name,
                'User_Email' => fake()->unique()->safeEmail,
                'Local_Phone' => fake()->phoneNumber,
                'Auction_Method' => fake()->randomElement(['Sea Port', 'Air Port']),
                'Auction_Phone' => fake()->phoneNumber,
                'Stock_Number' => fake()->randomDigit(),
            ],
            default => [
                'Orign_Location' => 'Other',
                'User_Name' => fake()->unique()->name,
                'User_Email' => fake()->unique()->safeEmail,
                'Local_Phone' => fake()->phoneNumber,
            ],
        };

    }
}
