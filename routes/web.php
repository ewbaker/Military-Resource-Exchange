<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReputationController;

// 1. Home Route
Route::get('/', function () {
    return view('welcome');
});

// 2. Protected Routes (Only for Lenders)
// 'auth' ensures they are logged in. 'lender' ensures they have the right rank.
Route::middleware(['lender'])->group(function () {
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
});

// 3. Reputation route (keeping this simple for now)
Route::post('/reputation/update/{userId}', [ReputationController::class, 'updateScore'])->name('reputation.update');