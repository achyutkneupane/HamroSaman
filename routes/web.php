<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatBoxController;
use App\Http\Controllers\ChatController;
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

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');
Route::get('/dashboard/products', [HomeController::class, 'products'])->name('user.products.index');
Route::get('/dashboard/products/{slug}', [HomeController::class, 'showProduct'])->name('user.products.show');
Route::get('/dashboard/product/add', [HomeController::class, 'addProduct'])->name('user.products.create');
Route::post('/dashboard/product/add', [HomeController::class, 'addProductSubmit'])->name('user.products.create.submit');
Route::post('/dashboard/product/comment', [CommentController::class, 'create'])->name('user.products.comment.add');
// all products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'index'])->name('products.search');
// show product
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
// delete product
Route::get('/products/{slug}/delete', [ProductController::class, 'delete'])->name('products.delete');

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

Route::get('/messages', [ChatBoxController::class, 'index'])->name('user.messages.index');
Route::post('/messages', [ChatBoxController::class, 'create'])->name('user.products.chatbox.create');
Route::get('/messages/{id}', [ChatBoxController::class, 'show'])->name('user.messages.show');
Route::post('/message', [ChatController::class, 'create'])->name('user.messages.create');


// Profile
Route::get('/profile', [HomeController::class, 'profile'])->name('profile.index');
Route::get('/profile/edit', [HomeController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/edit', [HomeController::class, 'updateProfile'])->name('profile.update');
