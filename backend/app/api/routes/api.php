<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CreateTransactionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\LocationNumberController;
use App\Http\Controllers\Admin\TransactionController;

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

   Route::post('locations', [LocationController::class, 'store']);
   Route::put('locations/{location}', [LocationController::class, 'update']);
   Route::delete('locations/{location}', [LocationController::class, 'destroy']);

   Route::post('location-numbers', [LocationNumberController::class, 'store']);
   Route::put('location-numbers/{locationNumber}', [LocationNumberController::class, 'update']);
   Route::delete('location-numbers/{locationNumber}', [LocationNumberController::class, 'destroy']);


});


  Route::get('logout', [AuthController::class, 'logout']);
  Route::get('user', [AuthController::class, 'user']);

  //Outlets
  Route::group(['middleware' => 'auth:sanctum'], function() {
   Route::get('outlets', [OutletController::class, 'index']);

   Route::get('/outlet_category/{outlet_id}', [OutletController::class, 'OutletCategory']);
   Route::apiResource('categories', CategoryController::class);
   Route::get('/category_products/{category_id}', [CategoryController::class, 'CategoryProducts']);
   Route::apiResource('products', ProductController::class);

   Route::get('locations', [LocationController::class, 'index']);
   Route::get('location-numbers', [LocationNumberController::class, 'index']);
   Route::get('locations/location-numbers', [LocationController::class, 'locationNumbers']);
  });



  Route::post('create-transaction', [CreateTransactionController::class, 'store']);

