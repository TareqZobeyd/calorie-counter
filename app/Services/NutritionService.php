<?php

namespace App\Services;

use App\Models\Food;
use Illuminate\Support\Facades\Log;

class NutritionService
{
    private FoodService $foodService;
    private NutritionApiService $apiService;

    public function __construct(FoodService $foodService, NutritionApiService $apiService)
    {
        $this->foodService = $foodService;
        $this->apiService = $apiService;
    }

    /**
     * پردازش کامل درخواست اطلاعات تغذیه‌ای
     */
    public function processNutritionRequest(int $foodId, float $quantity, string $unit): array
    {
        try {
            $foodValidation = $this->foodService->getFoodValidationInfo($foodId);
            if (!$foodValidation['exists']) {
                return [
                    'success' => false,
                    'error' => $foodValidation['error']
                ];
            }

            if (!$this->foodService->isUnitAllowed($foodId, $unit)) {
                return [
                    'success' => false,
                    'error' => 'واحد انتخاب شده برای این ماده غذایی مجاز نیست'
                ];
            }

            $quantityValidation = $this->foodService->validateQuantity($foodId, $unit, $quantity);
            if (!$quantityValidation['valid']) {
                return [
                    'success' => false,
                    'error' => $quantityValidation['error']
                ];
            }

            $foodName = $this->foodService->getFoodName($foodId);
            if (!$foodName) {
                return [
                    'success' => false,
                    'error' => 'نام ماده غذایی پیدا نشد'
                ];
            }

            $apiResult = $this->apiService->getNutritionInfo($foodName, $quantity, $unit);

            if (!$apiResult['success']) {
                return [
                    'success' => false,
                    'error' => $apiResult['error']
                ];
            }

            return [
                'success' => true,
                'data' => [
                    'food_name' => $foodName,
                    'quantity' => $quantity,
                    'unit' => $unit,
                    'nutrition' => $apiResult['data']
                ]
            ];

        } catch (\Exception $e) {
            Log::error('Nutrition Service Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'خطا در پردازش درخواست: ' . $e->getMessage()
            ];
        }
    }

    /**
     * دریافت اطلاعات غذا برای نمایش در فرم
     */
    public function getFoodFormData(): array
    {
        try {
            $foods = $this->foodService->getAllFoods();

            return [
                'success' => true,
                'data' => [
                    'foods' => $foods
                ]
            ];

        } catch (\Exception $e) {
            Log::error('Food Form Data Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'خطا در دریافت اطلاعات غذاها'
            ];
        }
    }

    /**
     * دریافت واحدهای مجاز برای یک غذا
     */
    public function getFoodUnits(int $foodId): array
    {
        try {
            if (!$this->foodService->foodExists($foodId)) {
                return [
                    'success' => false,
                    'error' => 'ماده غذایی پیدا نشد'
                ];
            }

            $units = $this->foodService->getFoodUnits($foodId);
            $limits = $this->foodService->getFoodUnitLimits($foodId);

            return [
                'success' => true,
                'data' => [
                    'units' => $units,
                    'limits' => $limits
                ]
            ];

        } catch (\Exception $e) {
            Log::error('Food Units Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'خطا در دریافت واحدها'
            ];
        }
    }

    /**
     * اعتبارسنجی کامل درخواست
     */
    public function validateRequest(int $foodId, float $quantity, string $unit): array
    {
        try {
            if (!$this->foodService->foodExists($foodId)) {
                return [
                    'valid' => false,
                    'error' => 'ماده غذایی انتخاب شده معتبر نیست'
                ];
            }

            if (!$this->foodService->isUnitAllowed($foodId, $unit)) {
                return [
                    'valid' => false,
                    'error' => 'واحد انتخاب شده برای این ماده غذایی مجاز نیست'
                ];
            }

            $quantityValidation = $this->foodService->validateQuantity($foodId, $unit, $quantity);
            if (!$quantityValidation['valid']) {
                return [
                    'valid' => false,
                    'error' => $quantityValidation['error']
                ];
            }

            return [
                'valid' => true,
                'message' => 'درخواست معتبر است'
            ];

        } catch (\Exception $e) {
            Log::error('Request Validation Error: ' . $e->getMessage());
            return [
                'valid' => false,
                'error' => 'خطا در اعتبارسنجی درخواست'
            ];
        }
    }

    /**
     * فرمت کردن اطلاعات تغذیه‌ای برای نمایش
     */
    public function formatNutritionForDisplay(array $nutritionData): array
    {
        return [
            'calories' => $nutritionData['calories'] ?? 'نامشخص',
            'protein' => $nutritionData['protein'] ?? 'نامشخص',
            'fat' => $nutritionData['fat'] ?? 'نامشخص',
            'sugar' => $nutritionData['sugar'] ?? 'نامشخص'
        ];
    }

}
