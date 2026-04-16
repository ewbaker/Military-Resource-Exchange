<?php

namespace App\Services;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Http;

class ReputationService
{
    public function calculateNewScore($userId)
    {
        $user = User::find($userId);
        $reviews = Review::where('user_id', $userId)->get();

        if ($reviews->isEmpty()) {
            $user->update(['reputation_score' => 100]); // Reset to 100 if no reviews
            return;
        }

        $totalAiModifier = 0;

        foreach ($reviews as $review) {
            // Ask Ollama for a sentiment modifier between -10 and +10
            $aiVibe = $this->analyzeSentimentWithOllama($review->review_text);
            
            // Logic: (Rating 1-5 * 10) + AI Modifier
            // Example: 1 star rating (10pts) + AI sees "he broke it" (-10pts) = 0 score for that review
            $totalAiModifier += ($review->rating * 10) + $aiVibe;
        }

        $newScore = $totalAiModifier / $reviews->count();

        // Ensure score stays between 0 and 100
        $finalScore = max(0, min(100, round($newScore)));

        $user->update(['reputation_score' => $finalScore]);
    }

    private function analyzeSentimentWithOllama($text)
    {
        try {
            $response = Http::timeout(15)->post('http://localhost:11434/api/generate', [
                'model' => 'llama3',
                'prompt' => "Analyze the sentiment of this military equipment review: '$text'. 
                             If the person was irresponsible or gear was damaged, return a negative number between -1 and -10. 
                             If they were great, return a positive number between 1 and 10. 
                             Return ONLY the number. No words.",
                'stream' => false,
            ]);

            if ($response->successful()) {
                $result = trim($response->json('response'));
                return (float) $result;
            }
        } catch (\Exception $e) {
            return 0; // If AI is offline, no modifier applied
        }
        return 0;
    }
}