<?php

namespace App\Services\PaymentService\OnlinePayment\IDPayService;

use App\Services\PaymentService\Interfaces\OnlinePaymentInterface;
use function dd;


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

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: 94b532cd-b63f-442f-80a8-41e08c10d7e9',
            'X-SANDBOX: 1'
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        dd($response);
    }
}
