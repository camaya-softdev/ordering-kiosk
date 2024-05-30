<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;


class RestaurantController extends Controller
{
    public function index()
    {
        $latestOrderId = Transaction::latest()->value('id');
        $loginData = session('loginData');

        if ($loginData) {
            $username = $loginData['user']['username'];
            $outlet_id = $loginData['user']['assign_to_outlet'];

            $query = Transaction::select(
                'transactions.*',
                'locations.name as location',
                'location_numbers.name as number'
            )->with('customer')->with('outlet')
            ->leftJoin('location_numbers', 'location_numbers.id', '=', 'transactions.location_number_id')
            ->leftJoin('locations', 'locations.id', '=', 'location_numbers.location_id')
            ->orderBy('transactions.created_at', 'desc');
            if ($username !== 'it_department') {
                $query->where('transactions.outlet_id', '=', $outlet_id);
            }

            $query->with(['orders.product' => function ($query) {
                $query->withTrashed();
            }]);

            $orderReport = $query->get();

            // return $orderReport;

            return view('Pages.restaurant.restaurant', [
                'latestOrderId' => $latestOrderId,
                'loginData' => $loginData,
                'orders' => $orderReport
            ]);
        } else {
            return redirect()->route('login');
        }
    }
}


