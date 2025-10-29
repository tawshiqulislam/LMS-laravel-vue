<?php

namespace App\Providers;

use App\Repositories\OrganizationRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $host = request()->getSchemeAndHttpHost();
        $organization = null;
        $prefixPath = "/admin";

        if (Schema::hasTable('organizations') && Schema::hasColumn('organizations', 'domain')) {
            $organization = OrganizationRepository::query()
                ->where('domain', $host)
                ->first();
            if ($organization && $organization->domain == $host) {
                $prefixPath = "/organizations";
            }
        }

        $this->routes(function () use ($prefixPath) {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', 'check_has_root'])
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'check_has_root', 'org_check'])
                ->prefix($prefixPath)
                ->group(base_path('routes/common.php'));

            // Route::middleware(['web', 'check_has_root'])
            //     ->prefix('/organizations')
            //     ->group(base_path('routes/common.php'));

            Route::middleware(['web'])
                ->prefix('/organizations')
                ->name('org.')
                ->group(base_path('routes/organization.php'));
        });
    }
}
