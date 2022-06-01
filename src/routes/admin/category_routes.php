<?php

use App\Http\Controllers\API\Admin\Categories\CategoryController;
use Illuminate\Support\Facades\Route;

Route::namespace('categories')->middleware(['role:Super Admin|Admin'])->group(function () {

    Route::get('/' , [CategoryController::class , 'index'])->name('categories.list');
    Route::post('/' , [CategoryController::class , 'store'])->name('categories.store');
    Route::delete('category/{category}' , [CategoryController::class , 'destroy'])->name('categories.destroy');
});

