<?php

namespace App\Services\PaymentService\OnlinePayment\ZarinpalService;

use App\Services\PaymentService\Interfaces\OnlinePaymentInterface;


class ZarinpalPaymentService implements OnlinePaymentInterface
{

    private const IDPAY_URL = 'https://api.idpay.ir/v1.1/payment';

    private const MERCHANT_ID = '';


    public function pay()
    {
        $Amount 		= 100;
        $Email 			= "";
        $Mobile 		= "";
        $CallbackURL 	= "http://127.0.0.1:8080/VerifyPayment.php";
        $ZarinGate 		= false;
        $SandBox 		= false;

        $zp 	= new Zarinpal();
        $result = $zp->request(
            self::MERCHANT_ID ,
            $Amount,
            "تراکنش زرین پال",
            $Email,
            $Mobile,
            $CallbackURL,
            true,
            $ZarinGate);


        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            // Success and redirect to pay
            $zp->redirect($result["StartPay"]);
        } else {
            // error
            echo "خطا در ایجاد تراکنش";
            echo "<br />کد خطا : ". $result["Status"];
            echo "<br />تفسیر و علت خطا : ". $result["Message"];
        }
    }
}
