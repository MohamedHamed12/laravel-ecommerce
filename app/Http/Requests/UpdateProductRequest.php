<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'slug' => "sometimes|string|unique:products,slug,{$this->product->id}",
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'cat_id' => 'sometimes|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'price' => 'sometimes|numeric|min:0',
            'brand_id' => 'nullable|exists:brands,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'status' => 'sometimes|in:active,inactive',
            'photo' => 'nullable|string',
            'size' => 'nullable|string',
            'stock' => 'sometimes|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'condition' => 'nullable|in:new,used',
        ];
    }
}
