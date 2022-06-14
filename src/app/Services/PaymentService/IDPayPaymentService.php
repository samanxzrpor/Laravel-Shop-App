<?php

namespace App\Services\PaymentService;

use App\Services\PaymentService\Interfaces\OnlinePaymentInterface;
use Illuminate\Support\Facades\Http;


class IDPayPaymentService implements OnlinePaymentInterface
{

    private const IDPAY_URL = 'https://api.idpay.ir/v1.1/payment';

    public function pay()
    {
        $params = array(
            'order_id' => '101',
            'amount' => 10000,
            'name' => 'قاسم رادمان',
            'phone' => '09382198592',
            'mail' => 'my@site.com',
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => 'https://example.com/callback',
        );

        $response = Http::post(self::IDPAY_URL , $params)
            ->headers([
                'Content-Type: application/json',
                'X-API-KEY: 94b532cd-b63f-442f-80a8-41e08c10d7e9',
                'X-SANDBOX: 1'
            ]);

        dd($response);
    }
}
