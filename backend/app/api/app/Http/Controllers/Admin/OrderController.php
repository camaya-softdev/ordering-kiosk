<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;


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
            ->where('trasactions.outlet_id','=',$outlet_id )
            ->where('transactions.id','=',$latestOrderId)
            ->with('customer')
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
