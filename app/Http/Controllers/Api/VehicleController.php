<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController
{

    public function index(Request $request)
    {
        if (!Auth::user()->isModerator())
            return response(['message' => 'Unauthorized!'], 403);
        if ($request->search) {
            $term = $request->search;
            return \App\Http\Resources\Vehicle::collection(Vehicle::query()
                ->whereRaw('LOWER(`plate_number`) LIKE ? ' ,['%'.trim(strtolower($term)).'%'])
                ->get());
        } else {
            return Vehicle::all();
        }
    }

    public
    function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::query()->create($request->validated());
        return new \App\Http\Resources\Vehicle($vehicle);
    }

    public
    function show(Vehicle $vehicle)
    {
        return new \App\Http\Resources\Vehicle($vehicle);
    }

    public
    function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());
        return new \App\Http\Resources\Vehicle($vehicle);
    }

    public
    function destroy(Vehicle $vehicle)
    {
        if (!Auth::user()->isModerator())
            return response(['message' => 'Unauthorized!'], 403);
        $vehicle->delete();
        return response([], 204);
    }
}
