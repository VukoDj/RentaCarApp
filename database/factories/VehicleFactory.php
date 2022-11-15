<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $city_codes = ["PG", "BD", "BR", "ŽB"];
        $vehicle_types = ["Peugeot", "BMW", "Audi", "Ford", "Hyundai"];
        return [
            "plate_number" => $faker->randomElement($city_codes).strtoupper($faker->randomLetter()).strtoupper($faker->randomLetter()).$faker->randomNumber(3),
            "production_year" => $faker->numberBetween(2013, 2022),
            "type" => $faker->randomElement($vehicle_types),
            "number_of_seats" => $faker->numberBetween(4,7),
            "daily_rate" => $faker->numberBetween(15,30)
        ];
    }
}
