<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Services\AIService;

class ItemController extends Controller
{
    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request, AIService $aiService)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rough_description' => 'required|string',
        ]);

        // We use the AI service here
        $aiData = $aiService->analyzeItemData($validated['rough_description']);

        $item = new Item();
        $item->user_id = auth()->id() ?? 1;
        $item->name = $validated['name'];
        // Use AI result if available, otherwise fallback to rough text
        $item->description = $aiData['description'] ?? $validated['rough_description'];
        $item->condition = $aiData['condition'] ?? 'Good';
        $item->category = 'General';
        $item->save();

        return redirect()->back()->with('success', 'Item listed successfully.');
    }
}