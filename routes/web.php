<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvokableHomeController;
use Illuminate\Support\Facades\Route;


//Section 1 Task

//Routing 1
Route::get('', [HomeController::class , 'index']);

//Routing 1 (Using invokable controller)
Route::get('invokable', InvokableHomeController::class);


//Routing 2
Route::get('double/{number}', [HomeController::class , 'double'])->whereNumber('number');
Route::get('name/{name}', [HomeController::class , 'name'])->whereAlpha('name');

//Middleware 1 & 2
Route::get('logMe', [HomeController::class , 'logMe'])->middleware('logRequest');
