<?php

use App\Http\Controllers\API\Admin\CouponController;
use Illuminate\Support\Facades\Route;


Route::prefix('coupons')->middleware(['role:Super Admin|Admin'])->group(function (){

    Route::get('' , [CouponController::class , 'index'])->name('coupons.index');

    Route::post('' , [CouponController::class , 'store'])->name('coupons.store');
});

