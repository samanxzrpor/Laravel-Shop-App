<?php

namespace App\Services\PaymentService;

use App\Services\PaymentService\Interfaces\OnlinePaymentInterface;

class OnlinePaymentStrategy
{
    private OnlinePaymentInterface $paymentService;

    public function __construct(OnlinePaymentInterface $onlinePayment)
    {
        $this->onlinePayment = $onlinePayment;
    }

    public function pay()
    {
        return $this->onlinePayment->pay();
    }
}
