<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->latest()->get();
        $averageRating = Review::avg('rating');
        $totalReviews = Review::count();

        // Count per rating
        $ratingCounts = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingCounts[$i] = Review::where('rating', $i)->count();
        }

        return view('backend.review.index', compact('reviews', 'averageRating', 'totalReviews', 'ratingCounts'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('backend.review.index')->with('success', 'Review berhasil dihapus.');
    }
}
