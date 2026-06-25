<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhone implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $apiKey = config('services.numverify.key');

        if (empty($apiKey)) {
            return;
        }

        $cacheKey = 'phone_valid_' . md5(trim($value));

        $result = Cache::remember($cacheKey, 3600, function () use ($value, $apiKey) {
            try {
                $response = Http::timeout(5)
                    ->get('http://apilayer.net/api/validate', [
                        'access_key' => $apiKey,
                        'number'     => $value,
                    ]);

                if ($response->successful()) {
                    return $response->json();
                }
            } catch (\Throwable $e) {
                // fail open — don't block users if API is unreachable
            }
            return null;
        });

        if (is_array($result) && isset($result['valid']) && $result['valid'] === false) {
            $fail(trans('Please enter a valid phone number.'));
        }
    }
}
