<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Services\PaymentService\OnlinePayment\OnlinePaymentStrategy;

class PaymentController extends Controller
{

    public function pay()
    {
        (new OnlinePaymentStrategy(new \App\Services\PaymentService\OnlinePayment\IDPayService\IDPayPaymentService()))->pay();
    }

}
