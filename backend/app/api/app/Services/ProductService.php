<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function createProduct(array $data)
    {
        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => $data['name'],
                'image' => $data['image'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'category_id' => $data['category_id'],
                'status' => $data['status'],
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Product created: ' . $product->name,
            ]);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProduct(Product $product, array $data)
    {
        DB::beginTransaction();

        try {
            $oldName = $product->name; // Store the old name of the product

            $product->update($data);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Product updated: ' . $oldName . ' to ' . $product->name,
            ]);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProduct(Product $product)
    {
        DB::beginTransaction();

        try {
            $productName = $product->name; // Store the name of the product being deleted

            $product->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Product deleted: ' . $productName,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
