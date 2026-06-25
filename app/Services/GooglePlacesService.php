<?php

namespace App\Services;

use App\Models\GoogleReview;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooglePlacesService
{
    private string $baseUrl = 'https://maps.googleapis.com/maps/api/place/details/json';

    private function apiKey(): string
    {
        return env('GOOGLE_PLACES_API_KEY', '');
    }

    private function placeId(): string
    {
        return env('GOOGLE_PLACE_ID', '');
    }

    /**
     * Fetch place details + reviews from Google Places API.
     */
    public function fetchPlaceDetails(): ?array
    {
        if (empty($this->apiKey()) || empty($this->placeId())) {
            return null;
        }

        $response = Http::get($this->baseUrl, [
            'place_id' => $this->placeId(),
            'fields'   => 'name,rating,user_ratings_total,reviews',
            'language' => 'en',
            'key'      => $this->apiKey(),
        ]);

        if (!$response->successful()) {
            Log::error('Google Places API error', ['body' => $response->body()]);
            return null;
        }

        $data = $response->json();

        if (($data['status'] ?? '') !== 'OK') {
            Log::error('Google Places API non-OK status', ['status' => $data['status'] ?? 'unknown', 'message' => $data['error_message'] ?? '']);
            return null;
        }

        return $data['result'] ?? null;
    }

    /**
     * Fetch and upsert all returned reviews into the DB.
     * Returns count of new/updated reviews.
     */
    public function syncReviews(): int
    {
        $place = $this->fetchPlaceDetails();

        if (!$place || empty($place['reviews'])) {
            return 0;
        }

        $synced = 0;

        foreach ($place['reviews'] as $review) {
            $reviewId = md5($review['author_url'] . $review['time']);

            GoogleReview::updateOrCreate(
                ['review_id' => $reviewId],
                [
                    'author_name'              => $review['author_name'] ?? 'Anonymous',
                    'author_url'               => $review['author_url'] ?? null,
                    'profile_photo_url'        => $review['profile_photo_url'] ?? null,
                    'rating'                   => $review['rating'] ?? 0,
                    'text'                     => $review['text'] ?? null,
                    'review_time'              => $review['time'] ?? 0,
                    'relative_time_description' => $review['relative_time_description'] ?? null,
                    'language'                 => $review['language'] ?? 'en',
                ]
            );

            $synced++;
        }

        return $synced;
    }

    /**
     * Get overall rating summary from the API (not stored in reviews table).
     */
    public function getRatingSummary(): array
    {
        $place = $this->fetchPlaceDetails();

        return [
            'rating'              => $place['rating'] ?? null,
            'user_ratings_total'  => $place['user_ratings_total'] ?? null,
            'name'                => $place['name'] ?? null,
        ];
    }
}
