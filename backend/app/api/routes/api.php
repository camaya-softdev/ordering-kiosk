<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => 'auth'], function () {

// });


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function() {
   Route::post('outlets', [OutletController::class, 'store']);
   Route::put('outlets/{outlet}', [OutletController::class, 'update']);
   Route::delete('outlets/{outlet}', [OutletController::class, 'destroy']);
});


  Route::get('logout', [AuthController::class, 'logout']);
  Route::get('user', [AuthController::class, 'user']);

  //Outlets
  Route::get('outlets', [OutletController::class, 'index']);

  Route::get('/outlet_category/{outlet_id}', [OutletController::class, 'OutletCategory']);
  Route::apiResource('categories', CategoryController::class);
  Route::get('/category_products/{category_id}', [CategoryController::class, 'CategoryProducts']);
  Route::apiResource('products', ProductController::class);
