<?php

namespace Database\Factories\Listing;

use App\Models\Listing\AllUserListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AllUserListing>
 */
class AllUserListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return array(
            'Listing_Status' => 'Listed'
        );
    }
}
