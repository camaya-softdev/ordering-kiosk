<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;


class RestaurantController extends Controller
{
    public function index()
    {
        $loginData = session('loginData');
        $outlet_id = $loginData['user']['assign_to_outlet'];

        // Check if login data exists
        if ($loginData) {

            $orderReport = Transaction::select(
                'transactions.*',
                'locations.name as location',
                'location_numbers.name as number'
                )
            ->leftJoin('location_numbers', 'location_numbers.id', '=', 'transactions.location_number_id')
            ->leftJoin('locations', 'locations.id', '=', 'location_numbers.location_id')
            ->where('outlet_id','=',$outlet_id )
            ->with('customer')
            ->with(['orders.product' => function ($query) {
                $query->withTrashed(); // Include soft-deleted products
            }])
            ->orderBy('transactions.created_at','desc')
            ->get();

            // return  $orderReport;

            // Pass the login data to the view
            return view('Pages.restaurant.restaurant', ['loginData' => $loginData, 'orders' => $orderReport]);
        } else {
            // Handle the case where login data is not available
            // Redirect the user to the login page or handle it as needed
            return redirect()->route('login');
        }
    }
}
