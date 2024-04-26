<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Models\Log;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function register(array $userData)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'username' => $userData['username'],
                'password' => Hash::make($userData['password']),
                'assign_to_outlet' => $userData['assign_to_outlet'],
                'status' => $userData['status'],
            ]);

            // Log::create([
            //     'user_id' => Auth::id(),
            //     'action' => 'User registered: ' . $user->username,
            // ]);

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function login(array $credentials)
    {
        DB::beginTransaction();

        try {
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'Incorrect Credentials',
                ], 401);
            }

            $user = Auth::user();

            if ($user->status !== 1) {
                Auth::logout();
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not Allowed',
                ], 401);
            }

            // Retrieve the related outlet and assign_to_id
            $outlet = $user->outlet; // Assuming outlet is the relationship name
            $assign_to_outlet = $outlet ? $outlet->name : null;

            Log::create([
                'user_id' => $user->id,
                'action' => 'User logged in: ' . $user->username,
            ]);

            DB::commit();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return [
                'user' => new UserResource($user),
                'assign_to_outlet' => $assign_to_outlet, // Return the assign_to_id
                'access_token' => $token,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
