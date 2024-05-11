<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;




class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'required|integer',
            'create_status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload
        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $outlet = $this->productService->createProduct([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('create_status'),
            'outlet_classification' => $request->input('outlet_classification'),
            'image' => $imageUrl,
        ]);

        return redirect()->route('menu')->with('success', 'Product created successfully');



    }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'nullable|string|max:255',
    //     ]);


    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $this->categoryService->updateCategory($id, [
    //         'name' => $request->input('update_category_name'),
    //         'updated_at' => now()->setTimezone('Asia/Manila'),
    //     ]);

    //     return redirect()->route('menu')->with('success', 'Category updated successfully');
    // }

    // public function destroy($id)
    // {
    //     // Call AuthService to delete the user
    //     $this->categoryService->deleteCategory($id);

    //     // Redirect with success message or handle as needed
    //     return redirect()->route('menu')->with('success', 'Category deleted successfully');
    // }


}
