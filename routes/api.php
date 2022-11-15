<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login",[AuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/account', function(Request $request) {
        return auth()->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/users', UserController::class);
    Route::resource('/vehicles', VehicleController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/cities', [CityController::class, 'index']);
    Route::get('/customers', [UserController::class, 'getAllCustomers']);
});
