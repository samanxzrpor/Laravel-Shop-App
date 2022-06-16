<?php

namespace App\Services\PaymentService\Interfaces;

use App\Http\Requests\RequestInterface;
use App\Models\Order;

interface OnlinePaymentInterface
{
    public function pay(RequestInterface $request , Order $order);
}
