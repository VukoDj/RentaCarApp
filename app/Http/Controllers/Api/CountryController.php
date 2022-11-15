<?php


namespace App\Http\Controllers\Api;



use App\Models\Country;
use PHPUnit\Framework\Constraint\Count;

class CountryController
{
    public function index(){
        return \App\Http\Resources\Country::collection(Country::all());
    }
}
