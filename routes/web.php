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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('welcome');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('home');
Route::get('/dashboard/products', [HomeController::class, 'products'])->middleware('auth')->name('user.products.index');
Route::get('/dashboard/products/{slug}', [HomeController::class, 'showProduct'])->middleware('auth')->name('user.products.show');
Route::get('/dashboard/products/{slug}/delete', [HomeController::class, 'deleteProduct'])->middleware('auth')->name('user.products.delete');
Route::get('/dashboard/product/add', [HomeController::class, 'addProduct'])->middleware('auth')->name('user.products.create');
Route::post('/dashboard/product/add', [HomeController::class, 'addProductSubmit'])->middleware('auth')->name('user.products.create.submit');
Route::post('/product/comment', [CommentController::class, 'create'])->middleware('auth')->name('user.products.comment.add');
// all products
Route::get('/products', [ProductController::class, 'index'])->middleware('auth')->name('products.index');
Route::post('/products', [ProductController::class, 'index'])->middleware('auth')->name('products.search');
// show product
Route::get('/products/{slug}', [ProductController::class, 'show'])->middleware('auth')->name('products.show');
// delete product
Route::get('/products/{slug}/delete', [ProductController::class, 'delete'])->middleware('auth')->name('products.delete');

// buy product
Route::post('/products/buy', [ProductController::class, 'placeOrder'])->middleware('auth')->name('products.buy');

// cancel bid
Route::post('/products/cancel', [ProductController::class, 'cancelBid'])->middleware('auth')->name('products.cancel');

// admin links
Route::group(['prefix' => 'admin','as'=>'admin.'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('home');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->middleware('auth')->name('products.index');
    Route::get('/categories', [AdminController::class, 'categories'])->middleware('auth')->name('categories.index');
});

Route::get('/messages', [ChatBoxController::class, 'index'])->middleware('auth')->name('user.messages.index');
Route::post('/messages', [ChatBoxController::class, 'create'])->middleware('auth')->name('user.products.chatbox.create');
Route::get('/messages/{id}', [ChatBoxController::class, 'show'])->middleware('auth')->name('user.messages.show');
Route::post('/message', [ChatController::class, 'create'])->middleware('auth')->name('user.messages.create');


// Profile
Route::get('/profile', [HomeController::class, 'profile'])->middleware('auth')->name('profile.index');
Route::get('/profile/edit', [HomeController::class, 'editProfile'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [HomeController::class, 'updateProfile'])->middleware('auth')->name('profile.update');
