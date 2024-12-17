<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Section 4 Task Start
Route::get('products' , ProductsController::class);

Route::post('login', LoginController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Section 4 Task End
