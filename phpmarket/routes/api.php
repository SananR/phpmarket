<?php

use App\Http\Controllers\StoreUserController;
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
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['api']);

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['api']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware(['auth:sanctum','api'])->name('logout');

//Protected
Route::group(['middleware'=>['auth:sanctum', 'api']], function() {
    Route::group(['middleware'=>['usertype:admin']], function() {
        Route::post('/store/admin', [StoreUserController::class,'store'])->middleware('usertype:admin');
        Route::put('/store/admin', [StoreUserController::class, 'update'])->middleware('usertype:admin');
        Route::patch('/store/admin', [StoreUserController::class, 'update'])->middleware('usertype:admin');
        Route::delete('/store/admin', [StoreUserController::class, 'delete'])->middleware('usertype:admin');
    });
    Route::apiResource('/store', \App\Http\Controllers\StoreController::class);
    /*
     * Store Products
     */
    Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'show']);
    Route::put('/product/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::patch('/product/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::post('/product', [\App\Http\Controllers\ProductController::class, 'store']);
    Route::delete('/product', [\App\Http\Controllers\ProductController::class, 'delete']);
    /*
     * Orders
     */
    Route::apiResource('/order', \App\Http\Controllers\OrderController::class);
    Route::post('/order/product', [\App\Http\Controllers\OrderController::class, 'product']);
});
