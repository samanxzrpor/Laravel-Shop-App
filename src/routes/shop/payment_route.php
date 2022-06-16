<?php


use App\Http\Controllers\API\Shop\PaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('payment')
    ->middleware(['auth:sanctum'])
    ->group(function () {

        Route::post('pay/{order}' , [PaymentController::class , 'pay'])->name('payment.pay');

        Route::get('idpay_callback' , [PaymentController::class , 'IDPayVerify'])->name('payment.idpay_callback');

        Route::get('zarinpal_callback' , [PaymentController::class , 'ZarinpalVerify'])->name('payment.zarinpal_callback');

    });
