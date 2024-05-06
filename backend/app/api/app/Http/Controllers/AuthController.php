<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $userData = $request->only(['first_name', 'last_name', 'username', 'password','assign_to_outlet','status']);
        $user = $this->authService->register($userData);

        return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $loginData = $this->authService->login($credentials);

        return $this->authService->login($credentials);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
