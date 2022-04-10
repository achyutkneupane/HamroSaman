<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('welcome');
// all products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// show product
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// admin links
Route::group(['prefix' => 'admin','as'=>'admin.'], function() {
    Route::get('/', [HomeController::class, 'dashboard'])->name('home');

    // Products
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');
});
