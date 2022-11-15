<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function pickupLocation(){
        return $this->hasOne(City::class, "id", "pickup_location");
    }

    public function dropOffLocation(){
        return $this->hasOne(City::class, "id", "drop_off_location");
    }

    public function vehicle(){
        return $this->hasOne(Vehicle::class, "id", "vehicle_id");
    }

    public function customer(){
        return $this->hasOne(User::class, "id", "customer_id");
    }
}
