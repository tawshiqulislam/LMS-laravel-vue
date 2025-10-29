<?php

use App\Enum\NotificationTypeEnum;
use App\Repositories\SettingRepository;
use App\Repositories\SocialMediaRepository;

if (!function_exists('currency')) {
    function currency($amount)
    {
        $setting = SettingRepository::query()->get()->first();
        $currencySymbol = config('app.currency_symbol');
        $currencyPosition = $setting?->currency_position ?? "Left";
        $finalPosition = number_format($amount, 2) . $currencySymbol;

        if ($currencyPosition == 'Left') {
            $finalPosition = $currencySymbol . number_format($amount, 2);
        }

        return $finalPosition;
    }
}

if (!function_exists('prefix')) {
    function prefix($auth)
    {
        $prefix = '';

        if ($auth->hasRole('organization')) {
            $prefix = 'organization';
        } else if ($auth->hasRole('instructor')) {
            $prefix = 'instructor';
        } else {
            $prefix = 'admin';
        }

        return $prefix;
    }
}



if (!function_exists('filterPermission')) {
    function filterPermission($name)
    {
        if ($name == "index") {
            return "list";
        }
        if ($name == "destroy") {
            return "delete";
        }
        if ($name == "free") {
            return "course free";
        }

        if ($name == "select_course") {
            return "show course list";
        }

        if ($name == "assign_roletopermission") {
            return "assign role to permission";
        }

        if ($name == "get_permission") {
            return "get permission";
        }

        if ($name == "assign_roletouser") {
            return "assign role to user";
        }

        if ($name == "dispatchRole") {
            return "dispatch role";
        }

        if ($name == "paymentView") {
            return "payment view";
        }

        if ($name == "plan.index") {
            return "Plan Index";
        }

        if ($name == "plan.create") {
            return "Plan create";
        }

        if ($name == "plan.store") {
            return "Plan store";
        }

        if ($name == "plan.edit") {
            return "Plan edit";
        }

        if ($name == "plan.update") {
            return "Plan update";
        }

        if ($name == 'custom.send.message') {
            return "Custom Notification Send Message";
        }

        if ($name == 'switch.status') {
            return "Notification Switch Status";
        }

        if ($name == 'custom.index') {
            return "Custom Notification Index";
        }

        if ($name == "profile.image.update") {
            return "Profile Image Update";
        }

        if ($name == "generate.pdf") {
            return "Generate PDF";
        }

        if ($name == "exportCSV") {
            return "Export CSV";
        }

        if ($name == "org.transaction") {
            return "Organization Transaction";
        }

        return $name;
    }
}


if (!function_exists('filterNotificationType')) {

    function filterNotificationType($type)
    {

        $getSpaceBetween = str_replace('_', ' ', $type?->value);
        $filterType = ucWords(strtolower($getSpaceBetween));
        return  $filterType;
    }
}



if (!function_exists('orgSocialLinksCreate')) {
    function orgSocialLinksCreate($orgId)
    {
        $socialMedia = [
            [
                'title' => 'Facebook',
                'icon' => 'bi bi-facebook',
                'url' => null,
            ],
            [
                'title' => 'Twitter',
                'icon' => 'bi bi-twitter',
                'url' => null,
            ],
            [
                'title' => 'Whatsapp',
                'icon' => 'bi bi-whatsapp',
                'url' => null,
            ],
            [
                'title' => 'Linkedin',
                'icon' => 'bi bi-linkedin',
                'url' => null,
            ],
            [
                'title' => 'Instagram',
                'icon' => 'bi bi-instagram',
                'url' => null,
            ],
            [
                'title' => 'Youtube',
                'icon' => 'bi bi-youtube',
                'url' => null,
            ],
            [
                'title' => 'Pinterest',
                'icon' => 'bi bi-pinterest',
                'url' => null,
            ],
            [
                'title' => 'Tiktok',
                'icon' => 'bi bi-tiktok',
                'url' => null,
            ],
            [
                'title' => 'Snapchat',
                'icon' => 'bi bi-snapchat',
                'url' => null,
            ],
            [
                'title' => 'Reddit',
                'icon' => 'bi bi-reddit',
                'url' => null,
            ],
            [
                'title' => 'Vimeo',
                'icon' => 'bi bi-vimeo',
                'url' => null,
            ],
            [
                'title' => 'Twitch',
                'icon' => 'bi bi-twitch',
                'url' => null,
            ],
        ];

        foreach ($socialMedia as $media) {
            SocialMediaRepository::query()->create([
                'organization_id' => $orgId,
                'title' => $media['title'],
                'icon' => $media['icon'],
                'url' => $media['url'],
            ]);
        };
    }
}
