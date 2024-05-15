<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
// use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;




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
