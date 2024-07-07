<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login.page');  // Redirect to login if not authenticated
        }

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('frontend.home');
        }

        // If the user is authenticated and is an admin, proceed with the request
        return $next($request);
    }
}
