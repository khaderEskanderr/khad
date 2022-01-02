<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::resource('product', ProductController::class);
});

/*
Route::middleware(['auth:api'])->group(function (){
    Route::prefix("Products")->group(function () {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\ProductController::class, 'store']);
        Route::get('/',[\App\Http\Controllers\ProductController::class,'getView']);
        Route::get('/{id}', [\App\Http\Controllers\ProductController::class, 'show']);
        Route::put('/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\ProductController::class, 'destroy']);

    });

});

Route::prefix("Categories")->group(function () {
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\CategoryController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\CategoryController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy']);
});

Route::prefix("Users")->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\UserController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
});
*/
