<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Services\CategoryService;



class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(Request $request)
    {
        $loginData = session('loginData');

        if ($loginData['outlet_id'] != null)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255'
            ]);

            $category = $this->categoryService->createCategory([
                'name' => $request->input('name'),
                'outlet_id' => $loginData['outlet_id'],
                'status' => 1

            ]);

            return redirect()->route('menu')->with('success', 'Category created successfully');

        }
        else
        {
            return redirect()->back()->withErrors('No Outlet Found');
        }





    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->categoryService->updateCategory($id, [
            'name' => $request->input('update_category_name'),
            'updated_at' => now()->setTimezone('Asia/Manila'),
        ]);

        return redirect()->route('menu')->with('success', 'Category updated successfully');
    }

    public function destroy(Request $request)
    {
        // Call AuthService to delete the user
        $this->categoryService->deleteCategory($request->input('delete_category'));

        // Redirect with success message or handle as needed
        return redirect()->route('menu')->with('success', 'Category deleted successfully');
    }


}
