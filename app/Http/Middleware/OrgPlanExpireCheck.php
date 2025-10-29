<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrgPlanExpireCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedInUser = auth()->user();
        $subscriptionPlan = $loggedInUser?->organization?->organizationPlanSubscription;

        if (($loggedInUser->is_org || $loggedInUser->hasRole('organization')) && $subscriptionPlan?->expires_at->lessThan(now())) {
            return to_route('org.pricing.index')->withError('Your organization plan has expired.');
        } else if (($loggedInUser->is_org || $loggedInUser->hasRole('organization')) &&  $loggedInUser->organization->domain == null && $loggedInUser->organization->organizationPlanSubscription == null) {
            return to_route('org.pricing.index')->withSuccess('Please choose a plan first for setting up your domain.');
        } else if (($loggedInUser->is_org || $loggedInUser->hasRole('organization')) && $loggedInUser->organization->domain != null && $loggedInUser->organization->organizationPlanSubscription == null) {
            return to_route('org.pricing.index')->withSuccess('Please choose a plan first for setting up your domain.');
        }
        return $next($request);
    }
}
