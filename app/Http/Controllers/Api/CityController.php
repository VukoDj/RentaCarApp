<?php


namespace App\Http\Controllers\Api;


use App\Http\Resources\City;

class CityController
{

    public function index(){
        return City::collection(\App\Models\City::all());
    }
}
