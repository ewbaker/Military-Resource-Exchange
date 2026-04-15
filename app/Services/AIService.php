<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function analyzeItemData($roughDescription)
    {
        try {
            $response = Http::timeout(10)->post('http://localhost:11434/api/generate', [
                'model' => 'llama3',
                'prompt' => "Analyze this description: '$roughDescription'. Return ONLY valid JSON with keys 'description' and 'condition' (New, Good, Fair, or Poor).",
                'stream' => false,
            ]);

            if ($response->successful()) {
                $data = json_decode($response->json('response'), true);
                return $data ?: ['description' => $roughDescription, 'condition' => 'Good'];
            }
        } catch (\Exception $e) {
            // If Ollama fails, just return the rough data so the app doesn't crash
            return ['description' => $roughDescription, 'condition' => 'Good'];
        }

        return ['description' => $roughDescription, 'condition' => 'Good'];
    }
}