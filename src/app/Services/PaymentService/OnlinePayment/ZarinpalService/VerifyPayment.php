<?php
namespace App\Services\PaymentService\OnlinePayment\ZarinpalService;

require_once("Zarinpal.php");

class VerifyPayment
{
    public function verify($payment)
    {
        $MerchantID 	= "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount 		= 100;
        $ZarinGate 		= false;
        $SandBox 		= false;

        $zp 	= new Zarinpal();
        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

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
