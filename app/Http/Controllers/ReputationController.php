<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Services\ReputationService;
use Illuminate\Http\Request;

class ReputationController extends Controller
{
    protected $reputationService;

    public function __construct(ReputationService $reputationService)
    {
        $this->reputationService = $reputationService;
    }

    // This handles your existing "Sync Node" button
    public function updateScore($userId)
    {
        $this->reputationService->calculateNewScore($userId);
        return back()->with('success', 'Accountability Node Synced: Reliability Rating recalculated via AI.');
    }

    // This handles your new Review/Appeal form
    public function store(Request $request)
    {
        $request->validate([
            'target_email' => 'required|email',
            'rating' => 'required|numeric|min:1|max:10',
            'review_text' => 'required',
        ]);

        $targetUser = User::where('email', $request->target_email)->firstOrFail();

        Review::create([
            'user_id' => $targetUser->id,
            'reviewer_id' => auth()->id(),
            'review_text' => $request->review_text,
            'rating' => $request->rating,
        ]);

        $this->reputationService->calculateNewScore($targetUser->id);
        
        return redirect()->route('dashboard')->with('success', 'Review submitted and AI analysis complete.');
    }
}