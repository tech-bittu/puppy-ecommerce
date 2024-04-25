<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PuppyOveviewRequest extends FormRequest
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
            'short_desc'=>'required',
            'cover_image'=>'image|mimes:jpeg,png,gif|max:2048'
            // 'status'=>'required',
            // 'page_title'=>'required',
            // 'robots'=>'required',
            // 'googlebot'=>'required',
        ];
    }
}
