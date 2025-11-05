<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiCustomerController;
use App\Http\Controllers\Api\ApiRentalController;
use App\Http\Controllers\Api\ApiSaleController;
use App\Http\Controllers\Api\ApiRepairController;

Route::prefix('cars')->group(function () {
    Route::get('/', [ApiCarController::class, 'index']);
    Route::post('/', [ApiCarController::class, 'store']);
    Route::get('/{id}', [ApiCarController::class, 'show']);
    Route::put('/{id}', [ApiCarController::class, 'update']);
    Route::delete('/{id}', [ApiCarController::class, 'destroy']);
});


Route::prefix('customers')->group(function () {
    Route::get('/', [ApiCustomerController::class, 'index']);
    Route::post('/', [ApiCustomerController::class, 'store']);
    Route::get('/{id}', [ApiCustomerController::class, 'show']);
    Route::put('/{id}', [ApiCustomerController::class, 'update']);
    Route::delete('/{id}', [ApiCustomerController::class, 'destroy']);
});

Route::prefix('rentals')->group(function () {
    Route::get('/', [ApiRentalController::class, 'index']);
    Route::post('/', [ApiRentalController::class, 'store']);
    Route::get('/{id}', [ApiRentalController::class, 'show']);
    Route::put('/{id}', [ApiRentalController::class, 'update']);
    Route::delete('/{id}', [ApiRentalController::class, 'destroy']);
});

Route::prefix('sales')->group(function () {
    Route::get('/', [ApiSaleController::class, 'index']);
    Route::post('/', [ApiSaleController::class, 'store']);
    Route::get('/{id}', [ApiSaleController::class, 'show']);
    Route::put('/{id}', [ApiSaleController::class, 'update']);
    Route::delete('/{id}', [ApiSaleController::class, 'destroy']);
});

Route::prefix('repairs')->group(function () {
    Route::get('/', [ApiRepairController::class, 'index']);
    Route::post('/', [ApiRepairController::class, 'store']);
    Route::get('/{id}', [ApiRepairController::class, 'show']);
    Route::put('/{id}', [ApiRepairController::class, 'update']);
    Route::delete('/{id}', [ApiRepairController::class, 'destroy']);
});
