<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StreamApiController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->apiResource('streams', StreamApiController::class);
