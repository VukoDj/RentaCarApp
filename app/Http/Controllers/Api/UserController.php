<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function index(){
        return User::all();
    }

    public function show(User $user){
        if(!Auth::user()->isModerator())
            return response(['message' => 'Unauthorized!'], 403);
        return $user;
    }

    public function store(StoreUserRequest $request){
        $data = array_merge($request->validated(), ["role_id" => 2, "password" => Hash::make("12345678")]);
        return User::create($data);
    }

    public function update(UpdateUserRequest $request, User $user){
        $user->update($request->validated());
        return $user;
    }

    public function destroy(User $user){
        if(!Auth::user()->isModerator())
            return response(['message' => 'Unauthorized!'], 403);
        $user->delete();
        return response([], 204);
    }

    public function getAllCustomers(Request $request){
        if(!Auth::user()->isModerator())
            return response(['message' => 'Unauthorized!'], 403);
        if($request->search){
            $term = $request->search;
            return \App\Http\Resources\User::collection(User::where("role_id", 2)
                ->whereRaw('LOWER(`email`) LIKE ? ' ,['%'.trim(strtolower($term)).'%'])
                ->orWhereRaw('LOWER(`first_name`) LIKE ? ' ,['%'.trim(strtolower($term)).'%'])
                ->orWhereRaw('LOWER(`last_name`) LIKE ? ' ,['%'.trim(strtolower($term)).'%'])
                ->get());
        }else{
            return \App\Http\Resources\User::collection(User::where("role_id", 2)->get());
        }
    }
}
