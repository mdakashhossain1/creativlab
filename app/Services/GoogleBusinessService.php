<?php

namespace App\Services;

use App\Models\GoogleBusinessToken;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\GlobalSetting\App\Models\GlobalSetting;

class GoogleBusinessService
{
    private string $tokenUrl      = 'https://oauth2.googleapis.com/token';
    private string $accountsUrl   = 'https://mybusinessaccountmanagement.googleapis.com/v1/accounts';
    private string $reviewsBase   = 'https://mybusiness.googleapis.com/v4';

    public function getToken(): ?GoogleBusinessToken
    {
        return GoogleBusinessToken::latest()->first();
    }

    public function isConnected(): bool
    {
        return $this->getToken() !== null;
    }

    /**
     * Return a valid access token, refreshing if expired.
     */
    public function accessToken(): ?string
    {
        $token = $this->getToken();
        if (!$token) return null;

        if ($token->isExpired() && $token->refresh_token) {
            $token = $this->refreshToken($token);
        }

        return $token?->access_token;
    }

    private function refreshToken(GoogleBusinessToken $token): ?GoogleBusinessToken
    {
        $response = Http::asForm()->post($this->tokenUrl, [
            'client_id'     => GlobalSetting::where('key', 'google_business_client_id')->value('value'),
            'client_secret' => GlobalSetting::where('key', 'google_business_client_secret')->value('value'),
            'refresh_token' => $token->refresh_token,
            'grant_type'    => 'refresh_token',
        ]);

        if (!$response->successful()) {
            Log::error('Google token refresh failed', ['body' => $response->body()]);
            return $token;
        }

        $data = $response->json();
        $token->update([
            'access_token'    => $data['access_token'],
            'token_expires_at' => Carbon::now()->addSeconds($data['expires_in'] - 30),
        ]);

        return $token->fresh();
    }

    /**
     * Fetch all Google Business Profile accounts.
     */
    public function getAccounts(): array
    {
        $response = Http::withToken($this->accessToken())->get($this->accountsUrl);

        if (!$response->successful()) {
            Log::error('Google accounts fetch failed', ['body' => $response->body()]);
            return [];
        }

        return $response->json('accounts', []);
    }

    /**
     * Fetch locations for a given account.
     */
    public function getLocations(string $accountName): array
    {
        $url = "https://mybusinessbusinessinformation.googleapis.com/v1/{$accountName}/locations";

        $response = Http::withToken($this->accessToken())
            ->get($url, ['readMask' => 'name,title,storefrontAddress,websiteUri,regularHours']);

        if (!$response->successful()) {
            Log::error('Google locations fetch failed', ['body' => $response->body()]);
            return [];
        }

        return $response->json('locations', []);
    }

    /**
     * Fetch reviews for a given account/location.
     * $parent = "accounts/{accountId}/locations/{locationId}"
     */
    public function getReviews(string $parent, int $pageSize = 50): array
    {
        $response = Http::withToken($this->accessToken())
            ->get("{$this->reviewsBase}/{$parent}/reviews", [
                'pageSize' => $pageSize,
            ]);

        if (!$response->successful()) {
            Log::error('Google reviews fetch failed', ['body' => $response->body()]);
            return [];
        }

        return $response->json('reviews', []);
    }

    /**
     * Reply to a review.
     * $reviewName = "accounts/{id}/locations/{id}/reviews/{id}"
     */
    public function replyToReview(string $reviewName, string $replyText): bool
    {
        $response = Http::withToken($this->accessToken())
            ->put("{$this->reviewsBase}/{$reviewName}/reply", [
                'comment' => $replyText,
            ]);

        return $response->successful();
    }
}
