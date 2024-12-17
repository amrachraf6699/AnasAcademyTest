<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ProductsController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group([],function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'products' , 'as' => 'myproducts.' , 'controller' => ProductsController::class], function(){
    Route::get('' , 'index')->name('index');
    Route::get('create' , 'create')->name('create');
    Route::post('store' , 'store')->name('store');
    Route::get('edit/{id}' , 'edit')->name('edit');
    Route::put('update/{id}' , 'update')->name('update');
    Route::delete('delete/{id}' , 'destroy')->name('destroy');
});


//Section 3 Task End
