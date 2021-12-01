<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'products'], function() {
    Route::get('list', [ProductController::class, 'list']);
    Route::post('create', [ProductController::class, 'create']);
    Route::get('item/{id?}', [ProductController::class, 'item']);
    Route::put('item/{id?}', [ProductController::class, 'updateItem']);
    Route::delete('item/{id?}', [ProductController::class, 'delete']);
});
