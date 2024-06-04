<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\LoginController;
use App\Http\Controllers\Views\OutletController;
use App\Http\Controllers\Views\UserController;
use App\Http\Controllers\Views\LocationController;
use App\Http\Controllers\Views\LocationNumberController;

use App\Http\Controllers\Views\restaurant\RestaurantController;
use App\Http\Controllers\Views\restaurant\MenuController;
use App\Http\Controllers\Views\restaurant\CategoryController;

use App\Http\Controllers\Views\restaurant\ProductController;
use App\Http\Controllers\Views\ActivitylogController;
use App\Http\Controllers\Views\GcashDetailsController;
use App\Http\Controllers\Views\restaurant\OrderController;

use App\Http\Controllers\Views\PaymentMethodController;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/account', [OutletController::class, 'index'])->name('outlet');
Route::get('/location', [LocationController::class, 'index'])->name('location');

Route::post('/outlet', [OutletController::class, 'store'])->name('outlet.store');
Route::put('/outlets/{outlet}', [OutletController::class,'update'])->name('outlet.update');
Route::delete('/outlets/{outlet}', 'App\Http\Controllers\Views\OutletController@destroy')->name('outlet.destroy');


Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');

Route::post('/location', [LocationController::class, 'store'])->name('location.store');
Route::put('/location/{location}', [LocationController::class, 'update'])->name('location.update');
Route::delete('/location/{id}/delete', [LocationController::class, 'destroy'])->name('location.destroy');

Route::post('/location-number', [LocationNumberController::class, 'store'])->name('locationNumber.store');
Route::put('/location-number/{id}/update', [LocationNumberController::class, 'update'])->name('locationNumber.update');
Route::delete('/location-number/{id}/delete', [LocationNumberController::class, 'destroy'])->name('locationNumber.destroy');




Route::get('/restaurants-view', [RestaurantController::class, 'index'])->name('resto.view');

Route::get('/kitchen-view', [RestaurantController::class, 'kitchen_view'])->name('kitchen.view');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/create-category', [CategoryController::class, 'store'])->name('category.store');
Route::put('/update-category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/delete-category', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');


Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('log');
Route::post('/export-logs', [ActivityLogController::class, 'exportLogs'])->name('exportLogs');

Route::get('/order-report', [OrderController::class, 'index'])->name('order-report');
Route::post('/export-report', [OrderController::class, 'exportReport'])->name('export-report');

Route::post('/update-order', [OrderController::class, 'update'])->name('order.update');

Route::post('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');


Route::post('/payment-method', [PaymentMethodController::class, 'store'])->name('payment.store');
Route::put('/payment-method/{paymentMethod}', [PaymentMethodController::class, 'update'])->name('payment.update');
Route::delete('/payment-method/{paymentMethod}', [PaymentMethodController::class, 'destroy'])->name('payment.destroy');

Route::post('/gcash-details', [GcashDetailsController::class, 'store'])->name('gcash.store');
Route::put('/gcash-details/{gcashDetails}', [GcashDetailsController::class, 'update'])->name('gcash.update');
Route::delete('/gcash-details/{gcashDetails}', [GcashDetailsController::class, 'destroy'])->name('gcash.destroy');

























