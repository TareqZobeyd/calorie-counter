<?php

namespace App\Services;

use App\Models\Food;
use Illuminate\Support\Collection;

class FoodService
{
    /**
     * دریافت تمام غذاها
     */
    public function getAllFoods(): Collection
    {
        return Food::orderBy('name')->get();
    }

    /**
     * دریافت غذا بر اساس ID
     */
    public function getFoodById(int $id): ?Food
    {
        return Food::find($id);
    }

    /**
     * دریافت واحدهای مجاز برای یک غذا
     */
    public function getFoodUnits(int $foodId): array
    {
        $food = $this->getFoodById($foodId);
        
        if (!$food) {
            return [];
        }

        return $food->allowed_units ?? [];
    }

    /**
     * دریافت محدودیت‌های واحد برای یک غذا
     */
    public function getFoodUnitLimits(int $foodId): array
    {
        $food = $this->getFoodById($foodId);
        
        if (!$food) {
            return [];
        }

        return $food->unit_limits ?? [];
    }

    /**
     * بررسی اینکه آیا واحد برای غذا مجاز است
     */
    public function isUnitAllowed(int $foodId, string $unit): bool
    {
        $allowedUnits = $this->getFoodUnits($foodId);
        return in_array($unit, $allowedUnits);
    }

    /**
     * بررسی محدودیت‌های مقدار
     */
    public function validateQuantity(int $foodId, string $unit, float $quantity): array
    {
        $unitLimits = $this->getFoodUnitLimits($foodId);
        
        if (!isset($unitLimits[$unit])) {
            return [
                'valid' => false,
                'error' => 'واحد انتخاب شده برای این ماده غذایی مجاز نیست'
            ];
        }

        $limits = $unitLimits[$unit];
        $min = $limits['min'] ?? 0;
        $max = $limits['max'] ?? 1000;

        if ($quantity < $min || $quantity > $max) {
            return [
                'valid' => false,
                'error' => "مقدار باید بین {$min} تا {$max} باشد"
            ];
        }

        return [
            'valid' => true,
            'message' => 'مقدار معتبر است'
        ];
    }

    /**
     * دریافت اطلاعات کامل غذا برای validation
     */
    public function getFoodValidationInfo(int $foodId): array
    {
        $food = $this->getFoodById($foodId);
        
        if (!$food) {
            return [
                'exists' => false,
                'error' => 'ماده غذایی پیدا نشد'
            ];
        }

        return [
            'exists' => true,
            'food' => $food,
            'allowed_units' => $food->allowed_units,
            'unit_limits' => $food->unit_limits
        ];
    }

    /**
     * جستجوی غذا بر اساس نام
     */
    public function searchFoods(string $query): Collection
    {
        return Food::where('name', 'like', "%{$query}%")
                   ->orderBy('name')
                   ->get();
    }

    /**
     * دریافت غذاهای محبوب (اختیاری - برای آینده)
     */
    public function getPopularFoods(int $limit = 10): Collection
    {
        // در آینده می‌توان بر اساس آمار استفاده مرتب کرد
        return Food::inRandomOrder()->limit($limit)->get();
    }

    /**
     * بررسی وجود غذا
     */
    public function foodExists(int $foodId): bool
    {
        return Food::where('id', $foodId)->exists();
    }

    /**
     * دریافت نام غذا
     */
    public function getFoodName(int $foodId): ?string
    {
        $food = $this->getFoodById($foodId);
        return $food ? $food->name : null;
    }
}
