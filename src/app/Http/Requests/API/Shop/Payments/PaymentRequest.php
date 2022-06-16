<?php

namespace App\Http\Requests\API\Shop\Payments;

use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest implements RequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() :array
    {
        return [
            'payment_service' => ['required' , 'in:IDPAY,ZARINPAL'],
            'amount' => ['required'] ,
            'name' => ['nullable' , 'min:3'] ,
            'phone' => ['nullable' , 'min:11'],
            'email' => ['nullable' , 'email'],
            'order_id' => ['required' , 'exists:App\Models\Order,id']
        ];
    }
}
