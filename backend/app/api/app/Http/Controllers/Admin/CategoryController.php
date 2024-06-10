<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        
        $categories = Category::when($request->has('outlet_id'), function($query) use ($request) {
            return $query->where('outlet_id', $request->outlet_id);
        })
        ->whereHas('products')
        ->get();

        if($request->include_new_added){
            $isThereNewProducts = Product::where('created_at', '>=', now()->subDays(7))
                                ->when($request->has('outlet_id'), function($query) use ($request) {
                                    return $query->whereHas('category', function($query) use ($request) {
                                        $query->where('outlet_id', $request->outlet_id);
                                    });
                                })
                                ->exists();

            if($isThereNewProducts){
                $newCategory = new Category;
                $newCategory->name = "Newly Added";
                $newCategory->status = 1;
                $categories = $categories->concat([$newCategory]);
            }
        }

        return CategoryResource::collection($categories);
    }

    public function CategoryProducts($category_id)
    {
        $category = Category::findOrFail($category_id);
        $products = $category->products;

        return ProductResource::collection($products);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'outlet_id' => 'required|exists:outlets,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $category = $this->categoryService->createCategory($request->only('name', 'outlet_id'));

        return response()->json(['category' => new CategoryResource($category), 'message' => 'Category created successfully'], 201);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'outlet_id' => 'exists:outlets,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $category = $this->categoryService->updateCategory($category, $request->only(['name', 'outlet_id']));

        return response()->json(['category' => new CategoryResource($category), 'message' => 'Category updated successfully'], 200);
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
