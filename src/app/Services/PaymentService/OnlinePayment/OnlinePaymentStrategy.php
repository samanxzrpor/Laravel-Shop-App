<?php

namespace App\Services\PaymentService\OnlinePayment;

use App\Http\Requests\RequestInterface;
use App\Models\Order;
use App\Services\PaymentService\Interfaces\OnlinePaymentInterface;

class OnlinePaymentStrategy
{

    private OnlinePaymentInterface $paymentService;


    public function __construct(OnlinePaymentInterface $onlinePayment)
    {
        $this->onlinePayment = $onlinePayment;
    }


    public function pay(RequestInterface $request , Order $order)
    {
        return $this->onlinePayment->pay($request , $order);
    }

    public function verify(array $data)
    {
        return $this->onlinePayment->verify($data);
    }
}
