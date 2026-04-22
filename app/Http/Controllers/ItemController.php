<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Services\AIService;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        // We get the owner (user) AND the current active loan's borrower (loans.user)
        $items = Item::with(['user', 'loans' => function($query) {
            $query->where('status', 'borrowed');
        }, 'loans.user'])->get();

        return view('items.index', compact('items'));
    }

    public function create() { return view('items.create'); }

    public function store(Request $request, AIService $aiService) {
        $validated = $request->validate(['name' => 'required', 'rough_description' => 'required']);
        $aiData = $aiService->analyzeItemData($validated['rough_description']);
        $item = new Item();
        $item->user_id = auth()->id();
        $item->name = $validated['name'];
        $item->description = $aiData['description'] ?? $validated['rough_description'];
        $item->condition = $aiData['condition'] ?? 'Good';
        $item->category = 'General';
        $item->save();
        return redirect()->route('items.index')->with('success', 'Item listed successfully.');
    }

    public function checkout($id) {
        $user = auth()->user();
        if (Loan::where('user_id', $user->id)->where('status', 'borrowed')->where('due_date', '<', now())->exists()) {
            return back()->with('error', 'ACCOUNTABILITY ALERT: Return overdue items first.');
        }
        $currentCount = Loan::where('user_id', $user->id)->where('status', 'borrowed')->count();
        if ($currentCount >= $user->getBorrowingLimit()) {
            return back()->with('error', 'LIMIT REACHED: Your rank allows a maximum of ' . $user->getBorrowingLimit() . ' items.');
        }
        $item = Item::findOrFail($id);
        Loan::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'due_date' => now()->addDays(7),
            'status' => 'borrowed',
        ]);
        $item->update(['availability_status' => 'on_loan']);
        return back()->with('success', 'Item checked out.');
    }

    public function returnItem($id) {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'returned']);
        $loan->item->update(['availability_status' => 'available']);
        return back()->with('success', 'Item returned to inventory.');
    }

    public function renewItem($id) {
        $loan = Loan::findOrFail($id);
        $dueDate = Carbon::parse($loan->due_date);

        // Logic fix: Only allow renewal if within 24 hours of due date
        if ($dueDate->isPast() || $dueDate->diffInHours(now()) > 24) {
            return back()->with('error', 'Renewal denied: Must be within 24 hours of the due date.');
        }

        $loan->update(['due_date' => $dueDate->addDays(7)]);
        return back()->with('success', 'Loan extended by 7 days.');
    }
}