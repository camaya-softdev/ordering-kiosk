<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = Product::with(['category'])
                    ->when($request->has('outlet_id'), function($query) use ($request) {
                        return $query->whereHas('category', function($query) use ($request) {
                            $query->where('outlet_id', $request->outlet_id);
                        });
                    })
                    ->get();

        $newlyAdded = collect();

        if($request->include_new_added){
            $newlyAdded = unserialize(serialize($products));
            $newlyAdded = $newlyAdded->filter(function ($product) {
                return $product->created_at->gte(now()->subDays(7));
            })->take(8);

            $newlyAdded = $newlyAdded->map(function ($product) {
                $product->category->name = "Newly Added";
                return $product;
            });
        }

        $combined = $products->concat($newlyAdded);

        return ProductResource::collection($combined);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product = $this->productService->createProduct($request->only('name', 'image','price', 'stock', 'category_id','status'));

        return response()->json(['product' => new ProductResource($product), 'message' => 'Product created successfully'], 201);
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'image' => 'string|max:255',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'category_id' => 'exists:categories,id',
            'status' => 'integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product = $this->productService->updateProduct($product, $request->only(['name', 'image','price', 'stock', 'category_id','status']));

        return response()->json(['product' => new ProductResource($product), 'message' => 'Product updated successfully'], 200);
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
