<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReputationController;
use Illuminate\Support\Facades\Route;

// 1. Landing Page
Route::get('/', function () { return view('welcome'); })->name('welcome');

// 2. Public Catalog
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// 3. Authenticated Routes
Route::middleware(['auth'])->group(function () {
    
    // User Dashboard (Possessions)
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // Lender Actions (Protected by RBAC Middleware)
    Route::middleware(['lender'])->group(function () {
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    });

    // Library Transactions
    Route::post('/items/{id}/checkout', [ItemController::class, 'checkout'])->name('items.checkout');
    Route::post('/loans/{id}/return', [ItemController::class, 'returnItem'])->name('items.return');
    Route::post('/loans/{id}/renew', [ItemController::class, 'renewItem'])->name('items.renew');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. AI Reputation Modifier
Route::post('/reputation/update/{userId}', [ReputationController::class, 'updateScore'])->name('reputation.update');

require __DIR__.'/auth.php';