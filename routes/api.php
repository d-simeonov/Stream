<?php

use App\Http\Controllers\Api\StreamApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->apiResource('streams', StreamApiController::class);
