<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Product;
use App\Exports\ReportExport;
use Illuminate\Support\Facades\Validator;
// use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;




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

        if ($loginData) {
            $username = $loginData['user']['username'];
            $outlet_id = $loginData['user']['assign_to_outlet'];

            $orderReport = Transaction::select(
                'transactions.*',
                'locations.name as location',
                'location_numbers.name as number'
                )
            ->leftJoin('location_numbers', 'location_numbers.id', '=', 'transactions.location_number_id')
            ->leftJoin('locations', 'locations.id', '=', 'location_numbers.location_id')
            ->leftJoin('orders','orders.transaction_id','transactions.id')
            ->when($username !== 'fnb_admin', function ($query) use ($outlet_id) {
                $query->where('orders.outlet_id', '=', $outlet_id);
            })
            ->with(['orders.product' => function ($query) {
                $query->withTrashed(); // Include soft-deleted products
            }])
            ->get();

             //    return $orderReport;

            return view('Pages.restaurant.report', ['report'=> $orderReport,'loginData' => $loginData]);
        } else {

            return redirect()->route('login');
        }

    }

    public function exportReport(Request $request)
    {
        $loginData = session('loginData');
        $outlet_id = $loginData['user']['assign_to_outlet'];
        $selectedDate = $request->input('selectedDate');
        $username = $loginData['user']['username'];


        // Fetch specific data from transactions
        $orderReport = Order::select(
            'transactions.reference_number',
            'transactions.id as transaction_number',
            'orders.quantity',
            'outlets.name as outlet_name',
            'products.name as product_name',
            'customers.name as customer_name',
            'customers.mobile_number',
            'transactions.payment_method',
            DB::raw('(orders.quantity * products.price) as total'),
            'transactions.status'
        )
        ->leftJoin('transactions', 'transactions.id', '=', 'orders.transaction_id')
        ->leftJoin('customers', 'customers.id', '=', 'transactions.customer_id')
        ->leftJoin('products', 'products.id', '=', 'orders.product_id')
        ->leftJoin('outlets','outlets.id','=','orders.outlet_id')
        ->when($username !== 'fnb_admin', function ($query) use ($outlet_id) {
            $query->where('orders.outlet_id', '=', $outlet_id);
        })
        ->whereDate('transactions.created_at', '=', $selectedDate)
        ->with(['product' => function ($query) {
            $query->withTrashed(); // Include soft-deleted products
        }])
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

            if ($newStatus == "cancelled") {
                // Retrieve the order details related to the given transaction
                $productIncrease = Order::select('product_id', 'quantity')
                    ->where('transaction_id', $orderId)
                    ->get();

                foreach ($productIncrease as $product) {
                    $productToUpdate = Product::find($product->product_id);
                    if ($productToUpdate) {
                        $productToUpdate->stock += $product->quantity;
                        $productToUpdate->save();
                    }
                }
            }

            return redirect()->route('resto.view')->with('success', 'Status Updated successfully');
        } else {
            return "Error";
        }
    }




}
