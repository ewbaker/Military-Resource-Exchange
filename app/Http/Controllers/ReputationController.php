<?php

namespace App\Http\Controllers;

use App\Services\ReputationService;
use Illuminate\Http\Request;

class ReputationController extends Controller
{
    protected $reputationService;

    public function __construct(ReputationService $reputationService)
    {
        $this->reputationService = $reputationService;
    }

    public function updateScore($userId)
    {
        try {
            $this->reputationService->calculateNewScore($userId);
            
            return response()->json([
                'message' => 'Reputation score updated successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update score: ' . $e->getMessage()
            ], 500);
        }
    }
}