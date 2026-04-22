<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // Handle Borrowing
    public function store(Request $request, $itemId)
    {
        $user = Auth::user();

        // 1. Check if user already has 5 items
        $activeLoans = Loan::where('user_id', $user->id)
                           ->where('status', 'borrowed')
                           ->count();

        if ($activeLoans >= 5) {
            return back()->with('error', 'You have reached the limit of 5 items.');
        }

        // 2. Create the loan
        Loan::create([
            'user_id' => $user->id,
            'item_id' => $itemId,
            'status' => 'borrowed',
            'due_date' => now()->addDays(7), // Default 1 week
        ]);

        return back()->with('success', 'Item borrowed successfully!');
    }

    // Handle Returning
    public function update($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'returned']);

        return back()->with('success', 'Item returned successfully.');
    }
}