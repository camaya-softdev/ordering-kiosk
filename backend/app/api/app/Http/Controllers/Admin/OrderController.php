<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function latestOrderId(Request $request)
    {
        $latestOrderId = Transaction::latest()->value('id');
        $outlet_id = $request->input('outlet_id');

            $orderReport = Transaction::select(
                'transactions.*',
                'locations.name as location',
                'location_numbers.name as number'
                )
            ->leftJoin('location_numbers', 'location_numbers.id', '=', 'transactions.location_number_id')
            ->leftJoin('locations', 'locations.id', '=', 'location_numbers.location_id')
            ->leftJoin('orders','orders.transaction_id','transactions.id')
            ->whereDate('transactions.created_at', Carbon::today())
            ->when($outlet_id != 0, function ($query) use ($outlet_id) {
                return $query->where('orders.outlet_id', '=', $outlet_id);
            })
            ->where('transactions.id','=',$latestOrderId)
            ->with('customer','orders.outlet')
            ->with(['orders.product' => function ($query) {
                $query->withTrashed(); // Include soft-deleted products
            }])
            ->orderBy('transactions.created_at','desc')
            ->get();



        return response()->json(['latestOrderId' => $orderReport]);
    }

    public function update(Request $request)
    {
        $orderId = $request->input('orderId');
        $newStatus = $request->input('status');
        $order = Transaction::find($orderId);

        if ($order) {
            // Update the status of the order
            $order->status = $newStatus;
            $order->save();

            return redirect()->route('resto.view')->with('success', 'Status Updated successfully');
        } else {
            return "Error";
        }
    }
}
