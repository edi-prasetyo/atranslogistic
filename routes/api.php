<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);


// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/profile', 'profile');
    });
    // Orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::put('/orders/update/{uuid}', 'update');
    });
});

// Route::get('/orders/show/{uuid}', [AdminOrderController::class, 'show']);
// Route::post('/orders/update/{uuid}', [AdminOrderController::class, 'update']);
