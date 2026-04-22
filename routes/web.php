<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReputationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::middleware(['lender'])->group(function () {
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    });

    Route::post('/items/{id}/checkout', [ItemController::class, 'checkout'])->name('items.checkout');
    Route::post('/loans/{id}/return', [ItemController::class, 'returnItem'])->name('items.return');
    Route::post('/loans/{id}/renew', [ItemController::class, 'renewItem'])->name('items.renew');

    // Review/Appeal Routes
    Route::get('/submit-review', function () { return view('reviews.create'); })->name('reviews.create');
    Route::post('/submit-review', [ReputationController::class, 'store'])->name('reviews.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/reputation/update/{userId}', [ReputationController::class, 'updateScore'])->name('reputation.update');

require __DIR__.'/auth.php';