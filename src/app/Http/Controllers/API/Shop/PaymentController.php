<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Shop\Payments\PaymentRequest;
use App\Http\Requests\RequestInterface;
use App\Models\Order;
use App\Repositories\Shop\Payment\PaymentRepositoryInterface;
use App\Services\PaymentService\OnlinePayment\IDPayService\IDPayPaymentService;
use App\Services\PaymentService\OnlinePayment\OnlinePaymentStrategy;
use App\Services\PaymentService\OnlinePayment\ZarinpalService\ZarinpalPaymentService;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;


class PaymentController extends Controller
{


    private PaymentRepositoryInterface $paymentRepository;


    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }


    public function pay(PaymentRequest $request , Order $order)
    {
        $request->validated();

        $this->IDPayPayment($request , $order);

        $this->ZarinpalPayment($request , $order);
    }


    private function IDPayPayment(RequestInterface $request , Order $order)
    {
        if ($request->input('payment_service') === 'IDPAY')
            $response = (new OnlinePaymentStrategy(new IDPayPaymentService()))->pay($request , $order);

        return Response::json([
            'error_code' => $response->error_code ,
            'message' => $response->error_message
        ] , $response->error_code);
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

        $payment = $this->paymentRepository->store($response);

        return Response::json([
            'payment' => $payment ,
            'message' => 'Payment Store Successfully'
        ] , StatusResponse::HTTP_CREATED);
    }


    private function ZarinpalPayment(RequestInterface $request , Order $order)
    {
        if ($request->input('payment_service') === 'ZARINPAL')
            return (new OnlinePaymentStrategy(new ZarinpalPaymentService()))->pay($request , $order);
    }
}
