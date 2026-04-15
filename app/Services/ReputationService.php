<?php

namespace App\Services;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Http;

class ReputationService
{
    public function calculateNewScore($userId)
    {
        $reviews = Review::where('user_id', $userId)->get();

        if ($reviews->isEmpty()) {
            return;
        }

        // Calculate weighted average of ratings (1-5)
        $avgRating = $reviews->avg('rating');

        // Analyze sentiment for each review to get a modifier
        $totalModifier = 0;
        foreach ($reviews as $review) {
            $totalModifier += $this->analyzeSentimentWithOllama($review->review_text);
        }
        
        $avgModifier = $totalModifier / $reviews->count();

        // Final score logic (Average Rating + Sentiment Modifier)
        $newScore = $avgRating + $avgModifier;

        // Update the user
        User::where('id', $userId)->update(['reputation_score' => $newScore]);
    }

    public function analyzeSentimentWithOllama($reviewText)
    {
        $response = Http::post('http://localhost:11434/api/generate', [
            'model' => 'llama3', // Ensure this model is pulled in Ollama
            'prompt' => "Analyze the sentiment of this review and return ONLY a number between -1 and 1. Review: " . $reviewText,
            'stream' => false,
        ]);

        if ($response->successful()) {
            $result = $response->json('response');
            return (float) filter_var($result, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }

        return 0; // Default modifier on failure
    }
}