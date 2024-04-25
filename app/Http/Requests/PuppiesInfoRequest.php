<?php

namespace App\Http\Requests;

use App\Models\Puppyinformation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Number;
class PuppiesInfoRequest extends FormRequest
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
            'breed_type' => ['required','numeric'],
            'group_type'=>['required','digits_between:1,20'],
            'barking_level'=>['required'],'digits_between:1,20',
            'activity_level'=>['required','digits_between:1,20'],
            'coat_type'=>['required','digits_between:1,20'],
            'characteristics'=>['required','digits_between:1,20'],
            'shedding'=>['required','digits_between:1,20'],
            'size'=>['required','digits_between:1,20'],
            'trainability'=>['required','digits_between:1,20'],
            'drooling_level'=>['required','digits_between:1,5'],
            'life_expetancy'=>['required','digits_between:1,50'],
            'affectionate_with_family'=>['required','digits_between:1,5'],
            'good_with_child'=>['required','digits_between:1,5'],
            'good_with_other_dogs'=>['required','digits_between:1,5'],
            'openness_to_strangers'=>['required','digits_between:1,5'],
            'watchdog_protective_nature'=>['required','digits_between:1,5'],
            'adaptability_level'=>['required','digits_between:1,5'],
            'playfulness_level'=>['required','digits_between:1,5']
        ];
    }
}
