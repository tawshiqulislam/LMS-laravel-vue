<?php

namespace App\Http\Middleware;

use App\Repositories\OrganizationRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrgPlanExpireRouteGuard
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

        if ($organization && $organization?->organizationPlanSubscription && $organization?->organizationPlanSubscription?->expires_at->lessThan(now())) {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
