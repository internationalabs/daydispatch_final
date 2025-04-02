<?php

namespace Database\Factories\Listing;

<<<<<<< HEAD
use App\Models\Listing\ListingDestinationLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ListingDestinationLocation>
=======
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing\ListingDestinationLocation>
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
 */
class ListingDestinationLocationFactory extends Factory
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
                'Destination_Dest_Location' => 'Dest_Location',
                'Dest_User_Name' => fake()->unique()->name,
                'Dest_User_Email' => fake()->unique()->safeEmail,
                'Dest_Local_Phone' => fake()->phoneNumber,
                'Dest_Location' => fake()->randomElement(['Residence', 'Business']),
            ],
            1 => [
                'Destination_Dest_Location' => 'Dealership',
                'Dest_User_Name' => fake()->unique()->name,
                'Dest_User_Email' => fake()->unique()->safeEmail,
                'Dest_Local_Phone' => fake()->phoneNumber,
                'Dest_Auction_Method' => fake()->name,
                'Dest_Auction_Phone' => fake()->phoneNumber,
                'Dest_Stock_Number' => fake()->randomDigit(),
            ],
            2 => [
                'Destination_Dest_Location' => 'Auction',
                'Dest_User_Name' => fake()->unique()->name,
                'Dest_User_Email' => fake()->unique()->safeEmail,
                'Dest_Local_Phone' => fake()->phoneNumber,
                'Dest_Auction_Method' => fake()->randomElement(['COPART Auction', 'Manheim Auction', 'IAAI Auction']),
                'Dest_Auction_Phone' => fake()->phoneNumber,
                'Dest_Stock_Number' => fake()->randomDigit(),
            ],
            3 => [
                'Destination_Dest_Location' => 'Port',
                'Dest_User_Name' => fake()->unique()->name,
                'Dest_User_Email' => fake()->unique()->safeEmail,
                'Dest_Local_Phone' => fake()->phoneNumber,
                'Dest_Auction_Method' => fake()->randomElement(['Sea Port', 'Air Port']),
                'Dest_Auction_Phone' => fake()->phoneNumber,
                'Dest_Stock_Number' => fake()->randomDigit(),
            ],
            default => [
                'Destination_Dest_Location' => 'Other',
                'Dest_User_Name' => fake()->unique()->name,
                'Dest_User_Email' => fake()->unique()->safeEmail,
                'Dest_Local_Phone' => fake()->phoneNumber,
            ],
        };
    }
}
