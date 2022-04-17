<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
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
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');
Route::get('/dashboard/products', [HomeController::class, 'products'])->name('user.products.index');
Route::get('/dashboard/product/add', [HomeController::class, 'addProduct'])->name('user.products.create');
Route::post('/dashboard/product/add', [HomeController::class, 'addProductSubmit'])->name('user.products.create.submit');
Route::post('/dashboard/product/comment', [CommentController::class, 'create'])->name('user.products.comment.add');
// all products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'search'])->name('products.search');
// show product
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// buy product
Route::post('/products/buy', [ProductController::class, 'placeOrder'])->name('products.buy');

// cancel bid
Route::post('/products/cancel', [ProductController::class, 'cancelBid'])->name('products.cancel');

// admin links
Route::group(['prefix' => 'admin','as'=>'admin.'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('home');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
});
