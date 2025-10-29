<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class URLGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $logedInUser = auth()->user();

        if ($logedInUser->is_org || $logedInUser->hasRole('organization')) {
            return to_route('org.dashboard');
        } else if ($logedInUser->hasRole('instructor')) {
            return to_route('instructor.dashboard');
        } else {
            return $next($request);
        }
    }
}
