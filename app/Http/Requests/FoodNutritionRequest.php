<?php

namespace App\Http\Requests;

use App\Services\FoodService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class FoodNutritionRequest extends FormRequest
{
    private FoodService $foodService;

    public function __construct(FoodService $foodService)
    {
        parent::__construct();
        $this->foodService = $foodService;
    }

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
            ],
            'quantity' => [
                'required',
                'numeric',
                'min:1'
            ],
            'unit' => [
                'required',
                'string',
                'min:1',
                'max:50'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'food_id.required' => 'انتخاب ماده غذایی الزامی است',
            'food_id.integer' => 'شناسه ماده غذایی باید عدد باشد',
            'food_id.min' => 'شناسه ماده غذایی نامعتبر است',
            
            'quantity.required' => 'مقدار الزامی است',
            'quantity.numeric' => 'مقدار باید عدد باشد',
            'quantity.min' => 'مقدار باید حداقل 1 باشد',
            
            'unit.required' => 'واحد اندازه‌گیری الزامی است',
            'unit.string' => 'واحد اندازه‌گیری باید متن باشد',
            'unit.min' => 'واحد اندازه‌گیری باید حداقل 1 کاراکتر باشد',
            'unit.max' => 'واحد اندازه‌گیری نباید بیشتر از 50 کاراکتر باشد'
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $this->validateFoodExists($validator);
            $this->validateUnitAllowed($validator);
            $this->validateQuantityLimits($validator);
        });
    }

    /**
     * بررسی وجود غذا
     */
    private function validateFoodExists(Validator $validator): void
    {
        $foodId = $this->input('food_id');
        
        if ($foodId && !$this->foodService->foodExists($foodId)) {
            $validator->errors()->add('food_id', 'ماده غذایی انتخاب شده معتبر نیست');
        }
    }

    /**
     * بررسی مجاز بودن واحد
     */
    private function validateUnitAllowed(Validator $validator): void
    {
        $foodId = $this->input('food_id');
        $unit = $this->input('unit');
        
        if ($foodId && $unit && !$this->foodService->isUnitAllowed($foodId, $unit)) {
            $allowedUnits = $this->foodService->getFoodUnits($foodId);
            $unitsText = implode('، ', $allowedUnits);
            
            $validator->errors()->add('unit', "واحد '{$unit}' برای این ماده غذایی مجاز نیست. واحدهای مجاز: {$unitsText}");
        }
    }

    /**
     * بررسی محدودیت‌های مقدار
     */
    private function validateQuantityLimits(Validator $validator): void
    {
        $foodId = $this->input('food_id');
        $unit = $this->input('unit');
        $quantity = $this->input('quantity');
        
        if ($foodId && $unit && $quantity) {
            $validation = $this->foodService->validateQuantity($foodId, $unit, $quantity);
            
            if (!$validation['valid']) {
                $validator->errors()->add('quantity', $validation['error']);
            }
        }
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'food_id' => 'ماده غذایی',
            'quantity' => 'مقدار',
            'unit' => 'واحد اندازه‌گیری'
        ];
    }
}
