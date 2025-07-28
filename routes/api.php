<?php
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/products/my_products', [ProductApiController::class, 'myProducts']);
//    Route::apiResource('products', ProductApiController::class);
//    Route::apiResource('categories', CategoryApiController::class);
//});


Route::get('/api/categories', [CategoryApiController::class, 'index']);

