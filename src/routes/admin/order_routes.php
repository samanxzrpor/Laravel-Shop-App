<?php

use App\Http\Controllers\API\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->middleware(['role:Super Admin|Admin'])->group(function (){

    Route::get('' , [OrderController::class , 'index'])->name('orders.index');
});

