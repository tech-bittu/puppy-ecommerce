<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|regex:/^[A-Za-z ]+$/i|unique:products',
            'slug'=>'required|regex:/^[A-Za-z- ]+$/i|unique:products',
            'price'=>'required',
            'compare_price'=>'numeric',
            'is_feature'=>'required',
            'sku'=>'required',
            'category_id'=>'required|numeric',
            'subcategory_id'=>'numeric',
            'brand_id'=>'numeric',
        ];
    }
}
