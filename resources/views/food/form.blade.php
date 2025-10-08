@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">کالری شمار</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('food.nutrition') }}" id="food-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="food_id" class="form-label">انتخاب ماده غذایی:</label>
                                    <select name="food_id" id="food_id" class="form-control @error('food_id') is-invalid @enderror" required>
                                        <option value="">انتخاب کنید</option>
                                        @foreach($foods as $food)
                                            <option value="{{ $food->id }}"
                                                    {{ old('food_id', $oldInput['food_id'] ?? '') == $food->id ? 'selected' : '' }}>
                                                {{ $food->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('food_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="unit" class="form-label">واحد:</label>
                                    <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" required>
                                        <option value="">ابتدا ماده غذایی را انتخاب کنید</option>
                                    </select>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="quantity" class="form-label">مقدار:</label>
                                    <input type="number"
                                           name="quantity"
                                           id="quantity"
                                           class="form-control @error('quantity') is-invalid @enderror"
                                           value="{{ old('quantity', $oldInput['quantity'] ?? '') }}"
                                           step="1"
                                           min="1"
                                           placeholder="مقدار را وارد کنید"
                                           required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                                دریافت اطلاعات تغذیه‌ای
                            </button>
                            <div class="loading mt-2">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">در حال پردازش...</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- نمایش نتایج موفق --}}
            @if(isset($showResults) && $showResults)
                <div class="results-section">
                    <h5 class="mb-3">نتایج اطلاعات تغذیه‌ای</h5>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <strong>ماده غذایی:</strong> {{ $foodName }}
                        </div>
                        <div class="col-md-4">
                            <strong>مقدار:</strong> {{ $quantity }}
                        </div>
                        <div class="col-md-4">
                            <strong>واحد:</strong> {{ $unit }}
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="nutrition-item">
                                <h6>کالری</h6>
                                <p class="nutrition-value">{{ $nutritionData['calories'] ?? 'نامشخص' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="nutrition-item">
                                <h6>پروتئین</h6>
                                <p class="nutrition-value">{{ $nutritionData['protein'] ?? 'نامشخص' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="nutrition-item">
                                <h6>چربی</h6>
                                <p class="nutrition-value">{{ $nutritionData['fat'] ?? 'نامشخص' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="nutrition-item">
                                <h6>قند</h6>
                                <p class="nutrition-value">{{ $nutritionData['sugar'] ?? 'نامشخص' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- نمایش خطای API --}}
            @if(isset($apiError))
                <div class="error-section">
                    <h6 class="text-danger">خطا:</h6>
                    <p class="text-danger">{{ $apiError }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const foodSelect = document.getElementById('food_id');
    const unitSelect = document.getElementById('unit');
    const quantityInput = document.getElementById('quantity');
    const submitBtn = document.getElementById('submit-btn');
    const loading = document.querySelector('.loading');
    const form = document.getElementById('food-form');

    foodSelect.addEventListener('change', function() {
        const foodId = this.value;

        if (foodId) {
            unitSelect.innerHTML = '<option value="">در حال بارگذاری...</option>';

            fetch(`/food/units?food_id=${foodId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    unitSelect.innerHTML = '<option value="">خطا در دریافت واحدها</option>';
                    return;
                }

                unitSelect.innerHTML = '<option value="">انتخاب واحد</option>';

                data.units.forEach(unit => {
                    const option = document.createElement('option');
                    option.value = unit;
                    option.textContent = unit;
                    unitSelect.appendChild(option);
                });

                @if(isset($oldInput['unit']))
                    const oldUnit = '{{ $oldInput["unit"] }}';
                    if (oldUnit) {
                        unitSelect.value = oldUnit;
                    }
                @endif
            })
            .catch(error => {
                console.error('خطا در دریافت واحدها:', error);
                unitSelect.innerHTML = '<option value="">خطا در دریافت واحدها</option>';
            });
        } else {
            unitSelect.innerHTML = '<option value="">ابتدا ماده غذایی را انتخاب کنید</option>';
        }
    });

    form.addEventListener('submit', function(e) {
        console.log('Form submitted!');
        console.log('CSRF Token:', document.querySelector('input[name="_token"]')?.value);

        const foodId = foodSelect.value;
        const unit = unitSelect.value;
        const quantity = quantityInput.value;

        if (!foodId || !unit || !quantity) {
            e.preventDefault();
            alert('لطفاً تمام فیلدها را پر کنید');
            return false;
        }

        submitBtn.style.display = 'none';
        loading.classList.add('show');

        return true;
    });

    @if(isset($oldInput['food_id']))
        const oldFoodId = '{{ $oldInput["food_id"] }}';
        if (oldFoodId) {
            setTimeout(() => {
                foodSelect.dispatchEvent(new Event('change'));
            }, 100);
        }
    @endif
});
</script>
@endsection
