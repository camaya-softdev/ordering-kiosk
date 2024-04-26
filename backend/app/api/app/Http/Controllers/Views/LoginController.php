<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $loginData = $this->authService->login($credentials);

        if ($loginData instanceof \Illuminate\Http\JsonResponse)
        {
            return redirect()->route('login')->with('error', $loginData->original['message']);
        }

        session(['loginData' => $loginData]);
        return redirect()->route('outlet');

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->session()->flush();
        // Redirect back to the login form after logout
        return redirect()->route('login')->with('success', 'Successfully logged out');
    }

}
