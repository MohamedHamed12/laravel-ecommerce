<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'user_id' => 'nullable|exists:users,id',
            'order_id' => 'nullable|exists:orders,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:new,progress,delivered,cancel',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
        ];
    }
}
