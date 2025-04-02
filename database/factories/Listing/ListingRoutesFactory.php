<?php

namespace Database\Factories\Listing;

<<<<<<< HEAD
use App\Models\Listing\ListingRoutes;
=======
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Helpers\DayDispatchHelper;
use Illuminate\Support\Str;

/**
<<<<<<< HEAD
 * @extends Factory<ListingRoutes>
=======
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing\ListingRoutes>
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
 */
class ListingRoutesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ZipCode = DB::table('zip_codes')
            ->inRandomOrder()
            ->limit(2)
            ->get();
        $origin_ZipCode = $ZipCode[0]['city'].', '.$ZipCode[0]['state'].', '.$ZipCode[0]['zipcode'];
        $Dest_ZipCode = $ZipCode[1]['city'].', '.$ZipCode[1]['state'].', '.$ZipCode[1]['zipcode'];
        $From = Str::afterLast($origin_ZipCode, ', ');
        $To = Str::afterLast($Dest_ZipCode, ', ');
        $miles = twopoints_on_earth($From, $To);

        return [
            'Origin_Address' => fake()->address,
            'Origin_Address_II' => fake()->streetAddress,
            'Origin_ZipCode' => $origin_ZipCode,
            'Destination_Address' => fake()->address,
            'Destination_Address_II' => fake()->streetAddress,
            'Dest_ZipCode' => $Dest_ZipCode,
            'Miles' => $miles,
        ];
    }
}
