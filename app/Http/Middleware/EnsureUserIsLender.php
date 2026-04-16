<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsLender
{
    public function handle(Request $request, Closure $next): Response
    {
        // Now that login is working, we ONLY check the logged-in user's role
        if ($request->user() && $request->user()->role === 'lender') {
            return $next($request);
        }

        // If they aren't a lender, send them to the homepage
        return redirect('/')->with('error', 'Access denied. Authorized Lenders only.');
    }
}