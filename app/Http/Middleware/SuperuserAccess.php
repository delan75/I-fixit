<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperuserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is a superuser
        if (!Auth::check() || !Auth::user()->isSuperuser()) {
            // Log unauthorized access attempt
            if (Auth::check()) {
                logger('Unauthorized superuser access attempt by user: ' . Auth::id());
            }
            
            // Redirect to dashboard with error message
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to access this area. Superuser privileges required.');
        }

        return $next($request);
    }
}
