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

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['auth.basic','api']);

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['api']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
