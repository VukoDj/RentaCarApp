<?php


namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController
{
    public function index(Request $request)
    {
        if(Auth::user()->isModerator()) {
            $query = Reservation::query();
            if(isset($request->date_from)){
                $query->where("created_at",">=", $request->date_from);
            }
            if(isset($request->date_to)){
                $query->where("created_at", "<=", $request->date_to);
            }
            $reservations = $query->get();
            return \App\Http\Resources\Reservation::collection($query->get());

        }else{
            return \App\Http\Resources\Reservation::collection(Reservation::query()->where("customer_id", Auth::id())->get());
        }
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::query()->create($request->validated());
        return new \App\Http\Resources\Reservation($reservation);
    }

    public function show(Reservation $reservation )
    {
        return new \App\Http\Resources\Reservation($reservation);
    }

    public function update(UpdateVehicleRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());
        return new \App\Http\Resources\Reservation($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        if(!Auth::user()->isModerator())
            return response(['message' => 'Unauthorized!'], 403);
        $reservation->delete();
        return response([], 204);
    }
}
