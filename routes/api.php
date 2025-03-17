<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BuyController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::post('/buys', [BuyController::class, 'store']);
Route::get('/buys/{id}', [BuyController::class, 'show']);
