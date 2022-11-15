<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password')->default(Hash::make('12345678'));
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->foreignId("country_id")->nullable()->constrained("countries");
            $table->string("passport_number")->nullable()->unique();
            $table->string("phone_number")->nullable();
            $table->string("note")->nullable();
            $table->foreignId("role_id")->constrained("roles", "id");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
