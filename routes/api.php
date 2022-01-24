<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//
Route::post('register', [App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [App\Http\Controllers\RegisterController::class, 'login']);
//
Route::prefix('product')->group(function () {
    Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
    Route::post('/', [App\Http\Controllers\ProductController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\ProductController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\ProductController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
    Route::get('/', [App\Http\Controllers\ProductController::class, 'price']);
    Route::post('/', [App\Http\Controllers\ProductController::class, 'search']);
    Route::prefix("/{product}/comments")->group(function () {
        Route::get('/', [App\Http\Controllers\ViewController::class, 'index']);
        Route::post('/', [App\Http\Controllers\ViewController::class, 'store']);
        Route::put('/{comment}', [App\Http\Controllers\ViewController::class, 'update']);
        Route::delete('/{comment}', [App\Http\Controllers\ViewController::class, 'destroy']);
    });
});

Route::prefix('category')->group(function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
});
Route::post('/store', [App\Http\Controllers\ProductController::class, 'store']);

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store']);
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show']);
        Route::put('/{id}', [App\Http\Controllers\UserController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
    });
});
//
//Route::middleware('auth:api')->group(function () {
//    Route::post('product', ProductController::class);
//});
//Route::middleware('auth:api')->group(function () {
//    Route::resource('category', CategoryController::class);
//});
//
//Route::middleware('auth:api')->group(function () {
//    Route::resource('user', UserController::class);
//});
