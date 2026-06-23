<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoogleReview;
use App\Services\GooglePlacesService;
use Illuminate\Http\Request;

class GoogleReviewsController extends Controller
{
    public function __construct(private GooglePlacesService $places) {}

    public function index()
    {
        $reviews = GoogleReview::orderByDesc('review_time')->get();
        $summary = (count($reviews) === 0) ? $this->places->getRatingSummary() : null;

        return view('admin.google.reviews', compact('reviews', 'summary'));
    }

    public function sync()
    {
        $count = $this->places->syncReviews();

        return redirect()->route('admin.google.reviews.index')
            ->with(['message' => "Synced {$count} review(s) from Google.", 'alert-type' => 'success']);
    }

    public function toggle($id)
    {
        $review = GoogleReview::findOrFail($id);
        $review->update(['is_visible' => !$review->is_visible]);

        return response()->json(['visible' => $review->is_visible]);
    }
}
