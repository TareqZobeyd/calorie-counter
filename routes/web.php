<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

Route::get('/', function () {
    return redirect()->route('food.index');
});

// Routes برای کالری شمار
Route::get('/food', [FoodController::class, 'index'])->name('food.index');
Route::post('/food', [FoodController::class, 'getNutrition'])->name('food.nutrition')
    ->middleware('throttle:10,1'); // 10 درخواست در 1 دقیقه
Route::get('/food/units', [FoodController::class, 'getUnits'])->name('food.units');
