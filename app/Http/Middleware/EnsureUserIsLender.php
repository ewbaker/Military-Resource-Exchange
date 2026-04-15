<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class EnsureUserIsLender
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Force test user login
        $testUser = User::find(1);
        if ($testUser) {
            Auth::login($testUser);
        }

        // 2. Check the role
        if ($request->user() && $request->user()->role === 'lender') {
            return $next($request);
        }

        // If we get here, either no user or wrong role
        dd("User Role is: " . ($request->user() ? $request->user()->role : 'None'));
    }
}