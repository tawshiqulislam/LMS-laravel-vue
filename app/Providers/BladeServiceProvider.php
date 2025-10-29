<?php

namespace App\Providers;

use App\Models\Notification;
use App\Repositories\LanguageRepository;
use App\Repositories\NotificationInstanceRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\OrganizationSiteSettingRepository;
use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $host = request()->getSchemeAndHttpHost();
            // Check organization by domain
            $organization = OrganizationRepository::query()->where('domain', $host)->orWhere('id', auth()->user()?->organization_id)->first();

            if ($organization && $organization->organizationPlanSubscription && !$organization->organizationPlanSubscription->expires_at->lessThan(now())) {
                // Organization site settings\
                $setting = OrganizationSiteSettingRepository::query()->where('organization_id', $organization->id)->first();
            } else {
                // Main LMS settings
                $setting = SettingRepository::query()->first();
            }
            $languages = Cache::remember('languages', 60 * 24, function () {
                return LanguageRepository::query()->get();
            });

            $layoutPath = null;

            if (auth()->check()) {
                $user = auth()->user();
                $layoutPath = match ($user->hasRole('admin') || $user->hasRole('instructor') || $user->instructor || $user->is_admin || $user->is_root) {
                    true => 'layouts.app',
                    default => 'organization.layouts.app',
                };
            }

            $data = [
                'name' => $organization ? $setting?->app_name ?? config('app.name') : config('app.name'),
                'currency' => $organization ? $setting?->app_currency ?? config('app.currency') : config('app.currency'),
                'currency_symbol' => $organization ? $setting?->app_currency_symbol ?? config('app.currency_symbol') : config('app.currency_symbol'),
                'logo' => $setting?->logoPath,
                'favicon' => $setting?->faviconPath,
                'footer_text' => $setting?->footer_text,
                'timezone' => config('app.timezone'),
                'currency_position' => $setting?->currency_position ?? 'Left',
                'organization' => $organization,
            ];

            $user = auth()->user();

            $notifications = NotificationInstanceRepository::query()
                ->whereNull('recipient_id')
                ->when($organization, function ($query) use ($organization) {
                    $query->whereHas('course', function ($q) use ($organization) {
                        $q->where('organization_id', $organization->id);
                    });
                })
                ->latest('id')
                ->get();

            $view->with([
                'app_setting' => $data,
                'layout_path' => $layoutPath,
                'notificationMessages' => $notifications,
                'languages' => $languages,
            ]);
        });
    }
}
