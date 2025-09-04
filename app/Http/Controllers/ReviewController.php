<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Vendor;
// use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'vendor'])->get();
        return Inertia::render('Review/Index', [
            'reviews' => $reviews,
        ]);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to create a review.');
        }

        $userId = Auth::id();
        $existingReviews = Review::where('user_id', $userId)->get();
        if ($existingReviews->isNotEmpty()) {
            return redirect()->route('review.index')->with('error', 'You have already submitted a review.');
        }

        return Inertia::render('Review/Create', [
            'users' => User::select('id', 'name')->where('id', $userId)->get(),
            'vendors' => Vendor::select('id', 'company_name')->get(),
            // 'events' => Event::select('id', 'title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to create a review.');
        }

        $userId = Auth::id();
        $vendorId = $request->input('vendor_id');
        // $eventId = $request->input('event_id');
        if (Review::where('user_id', $userId)->where('vendor_id', $vendorId));
    //         ->where('event_id', $eventId)->exists())
    //         {
    //         return redirect()->back()->withErrors(['error' => 'You have already submitted a review for this vendor and event.']);
    // }

        try {
            Log::info('Store review request received', ['data' => $request->all()]);
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id|in:' . $userId, // Restrict to logged-in user
                'vendor_id' => 'required|exists:vendors,id',
                // 'event_id' => 'required|exists:events,id',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
            ]);

            $review = Review::create($validated);
            Log::info('Review created successfully', ['review_id' => $review->id, 'review' => $review->toArray()]);

            return redirect()->route('review.index')->with('success', 'Review created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create review', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Failed to create review: ' . $e->getMessage()]);
        }
    }
}

