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
        $this->reputationService->calculateNewScore($userId);
        
        return back()->with('success', 'Accountability Node Synced: Reliability Rating has been recalculated via AI Sentiment Analysis.');
    }
}