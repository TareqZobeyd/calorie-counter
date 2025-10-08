<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodNutritionRequest;
use App\Http\Requests\GetFoodUnitsRequest;
use App\Services\NutritionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class FoodController extends Controller
{
    private NutritionService $nutritionService;

    public function __construct(NutritionService $nutritionService)
    {
        $this->nutritionService = $nutritionService;
    }

    /**
     * نمایش فرم
     */
    public function index(): View
    {
        $formData = $this->nutritionService->getFoodFormData();

        if (!$formData['success']) {
            abort(500, $formData['error']);
        }

        return view('food.form', [
            'foods' => $formData['data']['foods']
        ]);
    }

    /**
     * پردازش درخواست اطلاعات تغذیه‌ای
     */
    public function getNutrition(FoodNutritionRequest $request): View
    {

        $result = $this->nutritionService->processNutritionRequest(
            $request->food_id,
            $request->quantity,
            $request->unit
        );

        if ($result['success']) {
            return view('food.form', [
                'foods' => $this->nutritionService->getFoodFormData()['data']['foods'],
                'nutritionData' => $result['data']['nutrition'],
                'foodName' => $result['data']['food_name'],
                'quantity' => $result['data']['quantity'],
                'unit' => $result['data']['unit'],
                'showResults' => true
            ]);
        } else {
            return view('food.form', [
                'foods' => $this->nutritionService->getFoodFormData()['data']['foods'],
                'apiError' => $result['error'],
                'oldInput' => $request->only(['food_id', 'quantity', 'unit'])
            ]);
        }
    }

    /**
     * دریافت واحدهای مجاز برای یک غذا
     */
    public function getUnits(GetFoodUnitsRequest $request): JsonResponse
    {
        $result = $this->nutritionService->getFoodUnits($request->food_id);

        if ($result['success']) {
            return response()->json($result['data']);
        } else {
            return response()->json([
                'error' => $result['error']
            ], 404);
        }
    }
}
