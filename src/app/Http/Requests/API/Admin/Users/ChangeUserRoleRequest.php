<?php

namespace App\Http\Requests\API\Admin\Users;

use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class ChangeUserRoleRequest extends FormRequest implements RequestInterface
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
            'role' => ['required' , 'in:' . implode(',' ,config('permission.roles'))]
        ];
    }
}
