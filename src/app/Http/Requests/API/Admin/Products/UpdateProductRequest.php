<?php

namespace App\Http\Requests\API\Admin\Products;

use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest implements RequestInterface
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
            'title' => ['required' , 'min:10' , 'max:80'],
            'price' => ['required' , 'integer'],
            'discount_price' => ['nullable' , 'integer'],
            'count' => ['required' , 'integer'],
            'short_desc' => ['required' , 'min:50' , 'max:524'],
            'description' => ['required' , 'min:100'],
            'cat_id' => ['required' , 'exists:App\Models\Category,id'],
            'brand_id' => ['required' , 'exists:App\Models\Brand,id'],
            'thumbnail_file' => ['required' , 'image'],
            'gallery_file' => ['required' , 'array']
        ];
    }
}
