<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Models\User;




class UserController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'assign_to_outlet' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Call AuthService to register the user
        $userData = $request->only('first_name', 'last_name', 'username', 'password', 'assign_to_outlet', 'status');
        $userResource = $this->authService->register($userData);


        // Redirect with success message or handle as needed
        return redirect()->route('outlet')->with('success', 'User created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'update_first_name' => 'nullable|string|max:255',
            'update_last_name' => 'nullable|string|max:255',
            'update_username' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Call AuthService to update the user
        $userData = $request->all();
        $userResource = $this->authService->update($id, $userData);

        // Redirect with success message or handle as needed
        return redirect()->route('outlet')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        // Call AuthService to delete the user
        $this->authService->delete($id);

        // Redirect with success message or handle as needed
        return redirect()->route('outlet')->with('success', 'User deleted successfully');
    }
}
