<?php

namespace App\Services\PaymentService\OnlinePayment\ZarinpalService;

use App\Http\Requests\RequestInterface;
use App\Models\Order;
use App\Services\PaymentService\Interfaces\OnlinePaymentInterface;


class ZarinpalPaymentService implements OnlinePaymentInterface
{

    public function pay(RequestInterface $request , Order $order)
    {
        $zp 	= new Zarinpal();
        $result = $zp->request(
            config('payments.api_keys.zarinpal') ,
            $request->input('amount'),
            "تراکنش زرین پال",
            $request->input('email'),
            $request->input('mobile'),
            route('payment.zarinpal_callback'),
            true,
            false);


        if (isset($result["Status"]) && $result["Status"] === 100)
            $zp->redirect($result["StartPay"]);

        return [
            'message' => $result["Message"],
            'code' => $result["Status"]
        ];
    }


    public function verify()
    {
        $zp 	= new Zarinpal();
        $result = $zp->verify(config(), $Amount, true, false);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            // Success
            echo "تراکنش با موفقیت انجام شد";
            echo "<br />مبلغ : ". $result["Amount"];
            echo "<br />کد پیگیری : ". $result["RefID"];
            echo "<br />Authority : ". $result["Authority"];
        } else {
            // error
            echo "پرداخت ناموفق";
            echo "<br />کد خطا : ". $result["Status"];
            echo "<br />تفسیر و علت خطا : ". $result["Message"];
        }
    }
}
