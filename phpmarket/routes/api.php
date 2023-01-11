<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreAdminController;
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
    Route::apiResource('/store/admin', StoreAdminController::class);
    Route::apiResource('/store', \App\Http\Controllers\StoreController::class);
    Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'index']);
    Route::put('/product/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::patch('/product/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::post('/product', [\App\Http\Controllers\ProductController::class, 'store']);
    Route::delete('/product', [\App\Http\Controllers\ProductController::class, 'delete']);
    Route::apiResource('/order', \App\Http\Controllers\OrderController::class);
    Route::apiResource('/order-product', \App\Http\Controllers\OrderProductController::class);
});
