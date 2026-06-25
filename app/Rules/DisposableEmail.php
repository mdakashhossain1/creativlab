<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\ValidationRule;

class DisposableEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $apiKey = config('services.apilayer.email_key');

        if (empty($apiKey)) {
            return;
        }

        $cacheKey = 'disposable_email_' . md5(strtolower(trim($value)));

        $result = Cache::remember($cacheKey, 3600, function () use ($value, $apiKey) {
            try {
                $response = Http::withHeaders(['apikey' => $apiKey])
                    ->timeout(5)
                    ->get('https://api.apilayer.com/email_verification/check', ['email' => $value]);

                if ($response->successful()) {
                    return $response->json();
                }
            } catch (\Throwable $e) {
                // fail open — don't block users if API is unreachable
            }
            return null;
        });

        if (is_array($result) && ($result['disposable'] ?? false) === true) {
            $fail(trans('Disposable or temporary email addresses are not allowed. Please use a valid email address.'));
        }
    }
}
