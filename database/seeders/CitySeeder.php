<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $cities = [
            "1" => [
                "name" => "Podgorica"
            ],
            "2" => [
                "name" => "Budva"

            ],
            "3" => [
                "name" => "Bar"

            ],
            "4" => [
                "name" => "Žabljak"
            ]
        ];


        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
