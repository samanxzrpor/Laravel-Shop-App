<?php

use App\Http\Controllers\API\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->middleware(['role:Super Admin|Admin'])->group(function () {

    Route::get('/' , [CategoryController::class , 'index'])->name('categories.list');
    Route::post('/' , [CategoryController::class , 'store'])->name('categories.store');
    Route::delete('/{category}' , [CategoryController::class , 'destroy'])->name('categories.destroy');
});

