<?php

namespace Database\Factories\Listing;

<<<<<<< HEAD
use App\Models\Listing\ListingAdditionalInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ListingAdditionalInfo>
=======
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
<<<<<<<< HEAD:DayDispatch/database/factories/ListingFactory/ListingAdditionalInfoFactory.php
 * @extends Factory<Model>
========
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing\ListingAdditionalInfo>
>>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa:DayDispatch/database/factories/Listing/ListingAdditionalInfoFactory.php
>>>>>>> d69fffb275560d1e14c64bf407766027090b25aa
 */
class ListingAdditionalInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Additional_Terms' => fake()->text,
            'Special_Instructions' => fake()->text,
            'Notes_Customer' => fake()->text,
            'Vehcile_Desc' => fake()->text
        ];
    }
}
