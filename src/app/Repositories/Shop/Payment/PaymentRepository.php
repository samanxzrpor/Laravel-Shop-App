<?php

namespace App\Repositories\Shop\Payment;

use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function store(mixed $response)
    {
        Payment::create([
            'getaway' => 'IDPAY' ,
            'track_id' => $response->track_id,
            'result_id' => $response->id,
            'order_id' => $response->order_id,
            'payment_data' => json_encode($response->payment)
        ]);
    }
}
