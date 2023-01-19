<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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
$limiter = config('fortify.limiters.login');

//Public
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware(['auth:sanctum'])->name('logout');

//Protected
Route::group(['middleware'=>['auth:sanctum']], function() {
    Route::apiResource('/store', \App\Http\Controllers\StoreController::class);
    /*
     * Store Products
     */
    Route::group(['prefix'=>'products', 'as'=>'products'], function() {
        Route::post('/', [\App\Http\Controllers\ProductController::class, 'store']);
        Route::delete('/', [\App\Http\Controllers\ProductController::class, 'delete']);
        Route::group(['prefix' => '{productId}', 'as' => '{productId}'], function() {
            Route::get('/', [\App\Http\Controllers\ProductController::class, 'show']);
            Route::put('/', [\App\Http\Controllers\ProductController::class, 'update']);
            Route::patch('/', [\App\Http\Controllers\ProductController::class, 'update']);
        });
    });
    /*
     * Orders
     */
    Route::apiResource('/orders', \App\Http\Controllers\OrderController::class);
    Route::post('/orders/products', [\App\Http\Controllers\OrderController::class, 'product']);
});
