<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->constrained("users", "id");
            $table->foreignId("vehicle_id")->constrained("vehicles", "id");
            $table->string("date_from");
            $table->string("date_to");
            $table->foreignId("pickup_location")->constrained("cities", "id");
            $table->foreignId("drop_off_location")->constrained("cities", "id");
            $table->string("price");
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
        Schema::dropIfExists('reservations');
    }
}
