<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class LoginReuqest extends FormRequest implements RequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'email' => ['required','email'],
            'password' => ['required','min:8']
        ];
    }
}
