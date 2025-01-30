<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'slug' => "sometimes|string|unique:brands,slug,{$this->brand->id}",
            'status' => 'sometimes|in:active,inactive',
        ];
    }
}
