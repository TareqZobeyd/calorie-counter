<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class NutritionApiService
{
    private Client $httpClient;
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->baseUrl = config('services.openai.base_url');

        $this->httpClient = new Client([
            'timeout' => 30,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * دریافت اطلاعات تغذیه‌ای از OpenAI API
     */
    public function getNutritionInfo(string $foodName, float $quantity, string $unit): array
    {
        try {
            $prompt = $this->buildPrompt($foodName, $quantity, $unit);

            $response = $this->httpClient->post($this->baseUrl, [
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'max_tokens' => 1000,
                    'temperature' => 0.7
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            $content = $data['choices'][0]['message']['content'];

            return $this->parseNutritionResponse($content);

        } catch (GuzzleException $e) {
            Log::error('OpenAI API Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'خطا در ارتباط با API: ' . $e->getMessage()
            ];
        } catch (\Exception $e) {
            Log::error('Nutrition API Service Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'خطا در پردازش اطلاعات: ' . $e->getMessage()
            ];
        }
    }

    /**
     * ساخت prompt برای OpenAI
     */
    private function buildPrompt(string $foodName, float $quantity, string $unit): string
    {
        return "برای {$quantity} {$unit} {$foodName} اطلاعات تغذیه‌ای دقیق ارائه دهید.

لطفاً پاسخ را به صورت JSON با فرمت زیر ارائه دهید:
{
    \"calories\": عدد کالری,
    \"protein\": \"مقدار پروتئین به گرم\",
    \"fat\": \"مقدار چربی به گرم\",
    \"sugar\": \"مقدار قند به گرم\"
}

فقط JSON را برگردانید، بدون توضیحات اضافی.";
    }

    /**
     * پردازش پاسخ API
     */
    private function parseNutritionResponse(string $content): array
    {
        try {
            $jsonMatch = [];
            if (preg_match('/\{.*\}/s', $content, $jsonMatch)) {
                $nutritionData = json_decode($jsonMatch[0], true);

                if (json_last_error() === JSON_ERROR_NONE && $nutritionData) {
                    return [
                        'success' => true,
                        'data' => $this->formatNutritionData($nutritionData)
                    ];
                }
            }

            return [
                'success' => false,
                'error' => 'پاسخ API قابل پردازش نیست'
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'خطا در پردازش پاسخ API'
            ];
        }
    }

    /**
     * فرمت کردن داده‌های تغذیه‌ای
     */
    private function formatNutritionData(array $data): array
    {
        return [
            'calories' => $data['calories'] ?? 'نامشخص',
            'protein' => $data['protein'] ?? 'نامشخص',
            'fat' => $data['fat'] ?? 'نامشخص',
            'sugar' => $data['sugar'] ?? 'نامشخص'
        ];
    }

}
