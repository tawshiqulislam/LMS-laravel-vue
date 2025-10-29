<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('AccessGuardMiddleware triggered', [
            'env' => app()->environment(),
            'isLocal' => app()->isLocal(),
            'url' => $request->url(),
        ]);

        // if (app()->isLocal()) {
        if (env('DEMO_MODE', false)) {
            if ($request->is('api/*')) {
                return response()->json(['access_denied' => 'This action is not available in demo mode.'], 403);
            }
            return back()->withError('Access Denied: This action is not available in demo mode.');
        }

        return $next($request);
    }
}
