<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // auth kontrolü middleware'de zaten yapılacak
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku|max:255',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ];
    }

}
