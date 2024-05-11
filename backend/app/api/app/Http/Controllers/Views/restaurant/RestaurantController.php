<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        // Retrieve login data from the session
        $loginData = session('loginData');

        // Check if login data exists
        if ($loginData) {
            // Pass the login data to the view
            return view('Pages.restaurant.restaurant', ['loginData' => $loginData]);
        } else {
            // Handle the case where login data is not available
            // Redirect the user to the login page or handle it as needed
            return redirect()->route('login');
        }
    }
}
