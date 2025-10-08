<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetFoodUnitsRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'food_id' => [
                'required',
                'integer',
                'min:1'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'food_id.required' => 'شناسه غذا الزامی است',
            'food_id.integer' => 'شناسه غذا باید عدد باشد',
            'food_id.min' => 'شناسه غذا باید حداقل 1 باشد'
        ];
    }
}
