<?php

namespace Database\Factories\Listing;

<<<<<<< HEAD
use App\Models\Listing\ListingVehciles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ListingVehciles>
=======
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing\ListingVehciles>
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
 */
class ListingVehcilesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        for ($i = 1; $i <= rand(1,3); $i++){
            return [
                'Reg_By' => 'YMM',
                'Vin_Number' => '',
                'Vehcile_Year' => fake()->randomElement(['2022', '2023', '2015', '2005']),
                'Vehcile_Make' => fake()->randomElement(['Honda', 'Toyota', 'BMW', 'Ford']),
                'Vehcile_Model' => fake()->randomElement(['Cvic', 'Corolla', 'BMW', 'Ford']),
                'Vehcile_Color' => fake()->randomElement(['Black', 'White', 'Blue', 'Silver']),
                'Vehcile_Type' => fake()->randomElement(['Car', 'SUV', 'Pickup', 'Van']),
                'Vehcile_Condition' => fake()->randomElement(['Running', 'Not Running']),
                'Trailer_Type' => fake()->randomElement(['Open', 'Enclosed']),
            ];
        }
    }
}
