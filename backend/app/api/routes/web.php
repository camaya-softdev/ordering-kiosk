<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\LoginController;
use App\Http\Controllers\Views\OutletController;
use App\Http\Controllers\Views\UserController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/admin', [OutletController::class, 'index'])->name('outlet');
Route::post('/outlet', [OutletController::class, 'store'])->name('outlet.store');
Route::put('/outlets/{outlet}', 'App\Http\Controllers\Views\OutletController@update')->name('outlet.update');
Route::delete('/outlets/{outlet}', 'App\Http\Controllers\Views\OutletController@destroy')->name('outlet.destroy');


Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');


