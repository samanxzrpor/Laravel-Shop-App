<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Shop\Payments\PaymentRequest;
use App\Http\Requests\RequestInterface;
use App\Models\Order;
use App\Services\PaymentService\OnlinePayment\IDPayService\IDPayPaymentService;
use App\Services\PaymentService\OnlinePayment\OnlinePaymentStrategy;
use App\Services\PaymentService\OnlinePayment\ZarinpalService\ZarinpalPaymentService;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{

    public function pay(PaymentRequest $request , Order $order)
    {
        $request->validated();

        $this->IDPayPayment($request , $order);

        $this->ZarinpalPayment($request , $order);
    }


    public function IDPayVerify()
    {
        $recivedData = [
            'status' => request()->get('status'),
            'track_id' => request()->get('track_id'),
            'id' => request()->get('id'),
            'order_id' => request()->get('order_id'),
        ];

        $response = (new OnlinePaymentStrategy(new IDPayPaymentService()))->verify($recivedData);
    }

    public function ZarinpalVerfy()
    {

    }

    private function IDPayPayment(RequestInterface $request , Order $order)
    {
        if ($request->input('payment_service') === 'IDPAY')
            $response = (new OnlinePaymentStrategy(new IDPayPaymentService()))->pay($request , $order);

    }


    private function ZarinpalPayment(RequestInterface $request , Order $order)
    {
        if ($request->input('payment_service') === 'ZARINPAL')
            return (new OnlinePaymentStrategy(new ZarinpalPaymentService()))->pay($request , $order);
    }
}
