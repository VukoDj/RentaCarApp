<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $roles = [
            "1" => [
                "name" => "Moderator"
            ],
            "2" => [
                "name" => "User"

            ]
        ];


        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
