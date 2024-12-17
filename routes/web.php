<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvokableHomeController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


//Section 1 Task Start

//Routing 1
Route::get('', [HomeController::class , 'index']);

//Routing 1 (Using invokable controller)
Route::get('invokable', InvokableHomeController::class);


//Routing 2
Route::get('double/{number}', [HomeController::class , 'double'])->whereNumber('number');
Route::get('name/{name}', [HomeController::class , 'name'])->whereAlpha('name');

//Middleware 1 & 2
Route::get('logMe', [HomeController::class , 'logMe'])->middleware('logRequest');

//Section 1 Task End

//Section 2 Task Start

Route::group(['prefix' => 'products' , 'as' => 'products.' , 'controller' => ProductsController::class], function(){
    Route::get('' , 'index')->name('index');
    Route::get('filter' , 'filter')->name('filter');
});


//Section 2 Task End


//Section 3 Task Start

require __DIR__.'/auth.php';

/* Completion of Section 3 Task Routes is at routes/me.php */

//Section 3 Task End
