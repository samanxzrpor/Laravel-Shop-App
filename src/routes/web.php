<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test' , function (){
//    $product = \App\Models\Product::factory()->create();
//    \Illuminate\Support\Facades\Event::dispatch(new \App\Events\ReduceProductToLimit($product));

//    \App\Models\Product::factory()->create();

    (new \App\Services\PaymentService\OnlinePayment\OnlinePaymentStrategy(new \App\Services\PaymentService\OnlinePayment\IDPayService\IDPayPaymentService()))->pay();
});
