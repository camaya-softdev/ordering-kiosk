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
        ->with(['orders.product'])
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
        ->groupBy('transactions.id')
        ->get();


        // Generate the export file using a custom export class (ReportsExport)
        return Excel::download(new ReportExport($orderReport), 'reports.xlsx');
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
    //         'stock' => 'required|integer',
    //         'create_status' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Handle image upload
    //     $imagePath = $request->file('image')->store('public/images');
    //     $imageUrl = Storage::url($imagePath);

    //     $outlet = $this->productService->createProduct([
    //         'name' => $request->input('name'),
    //         'price' => $request->input('price'),
    //         'stock' => $request->input('stock'),
    //         'category_id' => $request->input('category_id'),
    //         'status' => $request->input('create_status'),
    //         'outlet_classification' => $request->input('outlet_classification'),
    //         'image' => $imageUrl,
    //     ]);

    //     return redirect()->route('menu')->with('success', 'Product created successfully');



    // }

    // public function update(Request $request, Product $product)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'nullable|string|max:255',
    //     ]);


    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //      // Handle image upload if provided
    //      if ($request->hasFile('updateImage')) {
    //         $imagePath = $request->file('updateImage')->store('public/images');
    //         $imageUrl = Storage::url($imagePath);
    //     } else {
    //         $imageUrl = $product->image; // Keep the existing image if no new image provided
    //     }



    //     $this->productService->updateProduct($product, [
    //         'name' => $request->input('update_product_name'),
    //         'price' => $request->input('update_product_price'),
    //         'stock' => $request->input('update_product_stock'),
    //         'category_id' => $request->input('update_category_id'),
    //         'status' => $request->input('create_status'),
    //         'updated_at' => now()->setTimezone('Asia/Manila'),
    //         'image' => $imageUrl,
    //     ]);

    //     return redirect()->route('menu')->with('success', 'Product updated successfully');
    // }

    // public function destroy(Product $product)
    // {
    //     // Call AuthService to delete the user
    //     $this->productService->deleteProduct($product);

    //     // Redirect with success message or handle as needed
    //     return redirect()->route('menu')->with('success', 'Category deleted successfully');
    // }


}
