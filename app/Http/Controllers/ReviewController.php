<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review from the frontend
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        Review::create([
            'id_users' => Auth::id(),
            'nama' => $request->nama,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('home', ['#testimonial'])
            ->with('success', 'Terima kasih atas review Anda!');
    }
}
