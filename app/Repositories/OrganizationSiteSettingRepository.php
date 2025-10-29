<?php

namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Enum\MediaTypeEnum;
use App\Models\OrganizationSiteSetting;

class OrganizationSiteSettingRepository extends Repository
{
    public static function model()
    {
        return OrganizationSiteSetting::class;
    }

    public static function storeByRequest($request)
    {
        $loggedInUser = auth()->user();
        $organizationId = $loggedInUser?->organization->id;

        $logo = $request->hasFile('logo') ? MediaRepository::storeByRequest(
            $request->file('logo'),
            'setting/logo',
            MediaTypeEnum::IMAGE
        ) : null;

        $footer = $request->hasFile('footerlogo') ? MediaRepository::storeByRequest(
            $request->file('footerlogo'),
            'setting/logo/footer',
            MediaTypeEnum::IMAGE
        ) : null;


        $favicon = $request->hasFile('favicon') ? MediaRepository::storeByRequest(
            $request->file('favicon'),
            'setting/favicon',
            MediaTypeEnum::IMAGE
        ) : null;

        $scaner = $request->hasFile('scaner') ? MediaRepository::storeByRequest(
            $request->file('scaner'),
            'setting/scaner',
            MediaTypeEnum::IMAGE
        ) : null;

        return self::create([
            'organization_id' => $organizationId,
            'logo_id' => $logo ? $logo->id : null,
            'footerlogo_id' => $footer ? $footer->id : null,
            'favicon_id' => $favicon ? $favicon->id : null,
            'scaner_id' => $scaner ? $scaner->id : null,
            'app_name' => $request->app_name ?? '',
            'app_currency' => $request->app_currency ?? '',
            'app_currency_symbol' => $request->app_currency_symbol ?? '',
            'footer_text' => $request->footer_text ?? '',
            'footer_contact_number' => $request->footer_contact_number ?? '',
            'footer_support_mail' => $request->footer_support_mail ?? '',
            "footer_description" => $request->footer_description ?? '',
            'play_store_url' => $request->play_store_url ?? '',
            'app_store_url' => $request->app_store_url ?? '',
            'google_map_embed_code' => $request->google_map_embed_code ?? '',
            'whatsapp_support_title' => $request->whatsapp_support_title ?? '',
            'whatsapp_support_number' => $request->whatsapp_support_number ?? '',
        ]);
    }

    public static function updateByRequest($request, $setting)
    {
        $loggedInUser = auth()->user();
        $organizationId = $loggedInUser?->organization->id;

        $logo = $request->hasFile('logo') ? MediaRepository::updateOrCreateByRequest(
            $request->file('logo'),
            'setting/logo',
            $setting->logo,
            MediaTypeEnum::IMAGE
        ) : $setting->logo;

        $footer = $request->hasFile('footerlogo') ? MediaRepository::updateOrCreateByRequest(
            $request->file('footerlogo'),
            'setting/logo/footer',
            $setting->footer,
            MediaTypeEnum::IMAGE
        ) : $setting->footer;


        $favicon = $request->hasFile('favicon') ? MediaRepository::updateOrCreateByRequest(
            $request->file('favicon'),
            'setting/favicon',
            $setting->favicon,
            MediaTypeEnum::IMAGE
        ) : $setting->favicon;

        $scaner = $request->hasFile('scaner') ? MediaRepository::updateOrCreateByRequest(
            $request->file('scaner'),
            'setting/scaner',
            $setting->scaner,
            MediaTypeEnum::IMAGE
        ) : $setting->scaner;

        return self::update($setting, [
            'organization_id' => $organizationId,
            'logo_id' => $logo ? $logo->id : $setting->logo_id,
            'footerlogo_id' => $footer ? $footer->id : $setting->footerlogo_id,
            'favicon_id' => $favicon ? $favicon->id : $setting->favicon_id,
            'scaner_id' => $scaner ? $scaner->id : $setting->scaner_id,
            'app_name' => $request->app_name ?? $setting->app_name,
            'app_currency' => $request->app_currency ?? $setting->app_currency,
            'app_currency_symbol' => $request->app_currency_symbol ?? $setting->app_currency_symbol,
            'footer_text' => $request->footer_text ?? $setting->footer_text,
            'footer_contact_number' => $request->footer_contact_number ?? $setting->footer_contact_number,
            'footer_support_mail' => $request->footer_support_mail ?? $setting->footer_support_mail,
            "footer_description" => $request->footer_description ?? $setting->footer_description,
            'play_store_url' => $request->play_store_url ?? $setting->play_store_url,
            'app_store_url' => $request->app_store_url ?? $setting->app_store_url,
            'google_map_embed_code' => $request->google_map_embed_code ?? $setting->google_map_embed_code,
            'whatsapp_support_title' => $request->whatsapp_support_title ?? '',
            'whatsapp_support_number' => $request->whatsapp_support_number ?? '',
        ]);
    }
}
