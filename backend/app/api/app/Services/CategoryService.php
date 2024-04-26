<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function createCategory(array $data)
    {
        DB::beginTransaction();

        try {
            $category = Category::create([
                'name' => $data['name'],
                'outlet_id' => $data['outlet_id'],
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Category created: ' . $category->name,
            ]);

            DB::commit();

            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateCategory(Category $category, array $data)
    {
        DB::beginTransaction();

        try {
            $oldName = $category->name; // Store the old name of the category

            $category->update($data);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Category updated: ' . $oldName . ' to ' . $category->name,
            ]);

            DB::commit();

            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteCategory(Category $category)
    {
        DB::beginTransaction();

        try {
            $categoryName = $category->name; // Store the name of the category being deleted

            $category->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Category deleted: ' . $categoryName,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
