<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserLoginRequest $request)
    {
        list($successful, $user, $access_token, $refresh_token) = $this->userService->login($request->validated());
        if (!$successful) {
            return response([
                'message' => 'Invalid credentials!'
            ], 401);
        } else {
            $response = [
                'message' => 'Login successful!',
                'data' => [
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'role_id' => $user->role_id,
                    'access_token' => $access_token,
                    'refresh_token' => $refresh_token
                ]
            ];
            return response($response, 200);
        }
    }


    public
    function logout(Request $request)
    {
        $this->userService->logout();
        $response = [
            'message' => 'Logout successful!',
        ];
        return response($response, 200);
    }

    public function accountDetails(Request $request)
    {
        return Auth::user();
    }

    public function refreshToken(RefreshTokenRequest $request){
        try {
            $access_token = $this->userService->refreshToken($request->validated());
            $response = [
                'message' => 'Access token has been successfully refreshed!',
                'data' => [
                    'access_token' => $access_token
                ]
            ];
            return response($response, 201);
        }catch (Throwable $e){
            return response(['message' => 'Invalid token!'], 400);
        }
    }
}
