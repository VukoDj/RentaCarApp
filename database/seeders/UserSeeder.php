<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $faker = \Faker\Factory::create();
        $countries = Country::query()->pluck('id');
        $users = [
            "1" => [
                "first_name" => $faker->firstName(),
                "last_name" => $faker->lastName(),
                "role_id" => 1,
                "email" => "user1@email.com",
                "password" => Hash::make('12345678'),
            ],
            "2" => [
                "first_name" => $faker->firstName(),
                "last_name" => $faker->lastName(),
                "role_id" => 1,
                "email" => "user2@email.com",
                "password" => Hash::make('12345678'),
            ],
            "3" => [
                "first_name" =>  $faker->firstName(),
                "last_name" => $faker->lastName(),
                "role_id" => 1,
                "email" => "user3@email.com",
                "password" => Hash::make('12345678'),
            ],
            "4" => [
                "first_name" =>  $faker->firstName(),
                "last_name" => $faker->lastName(),
                "role_id" => 2,
                "email" => "customer1@email.com",
                "country_id" => $faker->randomElement($countries),
                "passport_number" => $faker->unique()->randomNumber(9),
                "phone_number" => $faker->phoneNumber(),
                "password" => Hash::make('12345678'),
            ],
            "5" => [
                "first_name" =>  $faker->firstName(),
                "last_name" => $faker->lastName(),
                "role_id" => 2,
                "email" => "customer2@email.com",
                "country_id" => $faker->randomElement($countries),
                "passport_number" => $faker->unique()->randomNumber(9),
                "phone_number" => $faker->phoneNumber(),
                "password" => Hash::make('12345678'),
            ],
            "6" => [
                "first_name" =>  $faker->firstName(),
                "last_name" => $faker->lastName(),
                "role_id" => 2,
                "email" => "customer3@email.com",
                "country_id" => $faker->randomElement($countries),
                "passport_number" => $faker->unique()->randomNumber(9),
                "phone_number" => $faker->phoneNumber(),
                "password" => Hash::make('12345678'),
            ],
            "7" => [
                "first_name" =>  $faker->firstName(),
                "last_name" => $faker->lastName(),
                "role_id" => 2,
                "email" => "customer4@email.com",
                "country_id" => $faker->randomElement($countries),
                "passport_number" => $faker->unique()->randomNumber(9),
                "phone_number" => $faker->phoneNumber(),
                "password" => Hash::make('12345678'),
            ]
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
