<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create(array_merge($data, [Hash::make($data['password'])]));
        $token = $this->createAccessToken($user);
        return [$user, $token];
    }

    public function updateUserDetails($data, $user){
        $user->update($data);
        return $user;
    }

    public function login($request)
    {
        $user = User::where('email', $request['email'])->first();
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return [false, null, null, null];
        }
        else{
            $access_token = $this->createAccessToken($user);
            $refresh_token = $this->createRefreshToken($user);
            $user->update(['remember_token' => $refresh_token]);
            return [true, $user, $access_token, $refresh_token];
        }
    }

    public function refreshToken($request){
        $user = User::query()->where('remember_token', $request['refresh_token'])->first();
        $user->currentAccessToken();
        $user->tokens()->delete();
        return $this->createAccessToken($user);
    }

    public function createAccessToken($user)
    {
        return $user->createToken('access_token')->plainTextToken;
    }

    public function createRefreshToken($user)
    {
        return $user->createToken('remember_token')->plainTextToken;
    }

    public function updateDeviceToken($data)
    {
        auth()->user()->update(['device_token'=>$data['device_token']]);
    }

    public function confirmUser($user)
    {
        $user->update(['email_verified_at' => now()->toDateTime()]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        auth()->user()->update(['remember_token' => null ]);
    }

    public function changePassword($new_password)
    {
        User::where('id', Auth::id())
            ->update(['password' => Hash::make($new_password)]);
    }
}
