<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        RoleSeeder::run();
        CountrySeeder::run();
        CitySeeder::run();
        UserSeeder::run();
        VehicleSeeder::run();
        ReservationSeeder::run();
    }
}
