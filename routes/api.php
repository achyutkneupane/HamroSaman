<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Guest routes
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::post('/register', [AuthController::class, 'signup'])->name('auth.register');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset');


Route::middleware('auth:sanctum')->group(function () {

});
// Route::get('/tokens/create', function () {
//     // dd(User::find(1));
//     $token = User::find(1)->createToken('authToken');
 
//     return $token->plainTextToken;
// });
