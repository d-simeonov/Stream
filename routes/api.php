<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StreamApiController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');

    Route::middleware('auth:api')->apiResource('streams', StreamApiController::class);
});
