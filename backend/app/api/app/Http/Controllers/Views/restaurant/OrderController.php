<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Exports\ReportExport;
use Illuminate\Support\Facades\Validator;
// use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;




class OrderController extends Controller
{
    protected $productService;

    // public function __construct(ProductService $productService)
    // {
    //     $this->productService = $productService;
    // }

    public function index()
    {
        $loginData = session('loginData');
        $outlet_id = $loginData['user']['assign_to_outlet'];

        $orderReport = Transaction::select(
            'transactions.*',
            'locations.name as location',
            'location_numbers.name as number'
            )
        ->leftJoin('location_numbers', 'location_numbers.id', '=', 'transactions.location_number_id')
        ->leftJoin('locations', 'locations.id', '=', 'location_numbers.location_id')
        ->where('outlet_id','=',$outlet_id )
        ->with(['orders.product' => function ($query) {
            $query->withTrashed(); // Include soft-deleted products
        }])
        ->get();

    //    return $orderReport;

        return view('Pages.restaurant.report', ['report'=> $orderReport,'loginData' => $loginData]);

    }

    public function exportReport(Request $request)
    {
        $loginData = session('loginData');
        $outlet_id = $loginData['user']['assign_to_outlet'];
        $selectedDate = $request->input('selectedDate');

        // Fetch specific data from transactions
        $orderReport = Transaction::select(
            'transactions.reference_number',
            'transactions.id',
            'transactions.payment_method',
            'transactions.status',
            DB::raw('GROUP_CONCAT(orders.quantity, "x ", products.name SEPARATOR "\n") as order_details'), // Concatenate order details
            DB::raw('SUM(orders.quantity * products.price) AS total') // Calculate total
        )
        ->leftJoin('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->leftJoin('products', 'products.id', '=', 'orders.product_id')
        ->where('transactions.outlet_id', '=', $outlet_id)
        ->where('transactions.created_at', 'LIKE', '%' . $selectedDate . '%')
        ->with(['orders.product' => function ($query) {
            $query->withTrashed(); // Include soft-deleted products
        }])
        ->groupBy('transactions.id')
        ->get();

    // return $orderReport;

    // Generate the export file using a custom export class (ReportsExport)
    return Excel::download(new ReportExport($orderReport), 'reports.xlsx');
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
