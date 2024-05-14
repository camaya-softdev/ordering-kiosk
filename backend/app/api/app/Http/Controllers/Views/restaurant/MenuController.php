<?php

namespace App\Http\Controllers\Views\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class MenuController extends Controller
{
    public function index()
    {
        $loginData = session('loginData');
        if ($loginData)
        {
            $outlet_id = $loginData['outlet_id'];
            $categories = Category::where('outlet_id', $outlet_id)->get();
            $products = Product::all();

            return view('Pages.restaurant.menu', ['loginData' => $loginData, 'categories' => $categories, 'products' => $products]);
        }
        else
        {
            return redirect()->route('login');
        }
    }
}
