<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Modify if needed for authorization
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'brand_id' => 'nullable|exists:brands,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|string',
            'size' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'condition' => 'nullable|in:new,used',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Product title is required.',
            'slug.unique' => 'Product slug must be unique.',
            'cat_id.exists' => 'Invalid category selected.',
            'price.required' => 'Price is required.',
            'status.in' => 'Status must be active or inactive.',
        ];
    }
}
