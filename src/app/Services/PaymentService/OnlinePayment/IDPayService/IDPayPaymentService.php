<?php

namespace App\Services\PaymentService\OnlinePayment\IDPayService;

use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Shop\Payment\PaymentRepositoryInterface;
use App\Services\PaymentService\Interfaces\OnlinePaymentInterface;
use App\Http\Requests\RequestInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;


class IDPayPaymentService implements OnlinePaymentInterface
{

    public function pay(RequestInterface $request , Order $order): array|Redirector|RedirectResponse|Application
    {
        $params = $this->setPaymentsParams($request , $order);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('payments.urls.idpay.pay'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: '.config('payments.api_keys.idpay'),
            'X-SANDBOX: 1'
        ));

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        if ($response->error_code)
            return ['error_message' => $response->error_message , 'error_code' => $response->error_code];

        return redirect($response->link);
    }


    public function verify(array $data)
    {
        $params = array(
            'id' => $data['id'],
            'order_id' => $data['order_id'],
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('payments.urls.idpay.verify'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: '.config('payments.api_keys.idpay'),
            'X-SANDBOX: 1',
        ));

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        if ($response->error_code)
            return $response->error_message;

        return $response;
    }


    public function setPaymentsParams(RequestInterface $request , Order $order)
    {
        return [
            'order_id' => $order->id,
            'amount' => $request->get('amount'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'mail' => $request->get('mail'),
            'desc' => '?????????????? ???????????? ??????????',
            'callback' => route('payment.idpay_callback'),
        ];
    }
}
