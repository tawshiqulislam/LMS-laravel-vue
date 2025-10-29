<?php

namespace App\Http\Middleware;

use App\Repositories\OrganizationRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrgCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getSchemeAndHttpHost();
        // Check organization by domain
        $organization = OrganizationRepository::query()->where('domain', $host)->first();

        if ($organization) {
            $subscriptionPlan = $organization->organizationPlanSubscription;

            if ($subscriptionPlan && $subscriptionPlan->expires_at->lessThan(now())) {
                if ($request->is('api/*')) {
                    return response()->json(['org_subscription_expired' => route('org.plan.expired')], 403);
                }
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return to_route('org.plan.expired'); // for web
            }

            // Store current organization for use in app
            app()->instance('currentOrganization', $organization);
        }

        return $next($request);
    }
}
