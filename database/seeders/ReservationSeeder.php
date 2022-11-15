<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $faker = \Faker\Factory::create();
        $customer_ids = User::query()->where("role_id", 2)->pluck('id');
        $vehicle_ids = Vehicle::query()->pluck('id');
        $vehicle = $faker->randomElement($vehicle_ids);
        $v = Vehicle::query()->where("id", $vehicle)->first()->daily_rate;
        $price = 10 * $v;
        $city_ids = City::query()->pluck('id');
        $reservations = [
            "1" => [
                "customer_id" => $faker->randomElement($customer_ids),
                "vehicle_id" => $vehicle,
                "date_from" => "2022-05-05",
                "date_to" => "2022-05-15",
                "pickup_location" => $faker->randomElement($city_ids),
                "drop_off_location" => $faker->randomElement($city_ids),
                "price" => $price
            ],
            "2" => [
                "customer_id" => $faker->randomElement($customer_ids),
                "vehicle_id" => $vehicle,
                "date_from" => "2022-07-01",
                "date_to" => "2022-07-10",
                "pickup_location" => $faker->randomElement($city_ids),
                "drop_off_location" => $faker->randomElement($city_ids),
                "price" => $price
            ],
            "3" => [
                "customer_id" => $faker->randomElement($customer_ids),
                "vehicle_id" => $vehicle,
                "date_from" => "2022-06-28",
                "date_to" => "2022-07-08",
                "pickup_location" => $faker->randomElement($city_ids),
                "drop_off_location" => $faker->randomElement($city_ids),
                "price" => $price
            ],
            "4" => [
                "customer_id" => $faker->randomElement($customer_ids),
                "vehicle_id" => $vehicle,
                "date_from" => "2022-08-20",
                "date_to" => "2022-08-30",
                "pickup_location" => $faker->randomElement($city_ids),
                "drop_off_location" => $faker->randomElement($city_ids),
                "price" => $price
            ],
            "5" => [
                "customer_id" => $faker->randomElement($customer_ids),
                "vehicle_id" => $vehicle,
                "date_from" => "2022-10-03",
                "date_to" => "2022-10-13",
                "pickup_location" => $faker->randomElement($city_ids),
                "drop_off_location" => $faker->randomElement($city_ids),
                "price" => $price
            ],
            "6" => [
                "customer_id" => $faker->randomElement($customer_ids),
                "vehicle_id" => $vehicle,
                "date_from" => "2022-11-02",
                "date_to" => "2022-11-12",
                "pickup_location" => $faker->randomElement($city_ids),
                "drop_off_location" => $faker->randomElement($city_ids),
                "price" => $price
            ],
            "7" => [
                "customer_id" => $faker->randomElement($customer_ids),
                "vehicle_id" => $vehicle,
                "date_from" => "2022-10-08",
                "date_to" => "2022-10-18",
                "pickup_location" => $faker->randomElement($city_ids),
                "drop_off_location" => $faker->randomElement($city_ids),
                "price" => $price
            ]
        ];

        foreach ($reservations as $reservation){
            Reservation::create($reservation);
        }
    }
}
