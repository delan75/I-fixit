<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegenerateSessionAfterLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if user just logged in
        if (Auth::check() && $request->session()->has('auth.password_confirmed_at')) {
            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();
            
            // Log the session regeneration for audit purposes
            logger('Session regenerated after login for user: ' . Auth::id());
        }

        return $response;
    }
}
