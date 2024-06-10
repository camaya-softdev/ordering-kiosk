<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;


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
            )
            ->with('customer')
            ->leftJoin('location_numbers', 'location_numbers.id', '=', 'transactions.location_number_id')
            ->leftJoin('locations', 'locations.id', '=', 'location_numbers.location_id')
            ->whereDate('transactions.created_at', Carbon::today())
            ->orderBy('transactions.created_at', 'desc');

            // Apply conditional outlet filter based on orders
            if ($username !== 'it_department') {
                $query->whereHas('orders', function ($query) use ($outlet_id) {
                    $query->where('outlet_id', $outlet_id);
                });
            }
            $query->with(['orders.product' => function ($query) {
                $query->withTrashed();
            }]);

            $orderReport = $query->get();

            // return  $orderReport;

            return view('Pages.restaurant.restaurant', [
                'latestOrderId' => $latestOrderId,
                'loginData' => $loginData,
                'orders' => $orderReport
            ]);
        } else {
            return redirect()->route('login');
        }
    }
    public function kitchen_view()
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
            )
            ->with('customer')
            ->leftJoin('location_numbers', 'location_numbers.id', '=', 'transactions.location_number_id')
            ->leftJoin('locations', 'locations.id', '=', 'location_numbers.location_id')
            ->whereDate('transactions.created_at', Carbon::today())
            ->orderBy('transactions.created_at', 'desc');

            // Apply conditional outlet filter based on orders
            if ($username !== 'it_department') {
                $query->whereHas('orders', function ($query) use ($outlet_id) {
                    $query->where('outlet_id', $outlet_id);
                });
            }
            $query->with(['orders.product' => function ($query) {
                $query->withTrashed();
            }]);

            $orderReport = $query->get();

            // return $orderReport;

            return view('Pages.restaurant.kitchen_view', [
                'latestOrderId' => $latestOrderId,
                'loginData' => $loginData,
                'orders' => $orderReport
            ]);
        } else {
            return redirect()->route('login');
        }
    }
}


