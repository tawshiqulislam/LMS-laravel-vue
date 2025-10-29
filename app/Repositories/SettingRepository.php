<?php

namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Enum\MediaTypeEnum;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;

class SettingRepository extends Repository
{
    public static function model()
    {
        return Setting::class;
    }

    public static function updateByRequest(SettingUpdateRequest $request, Setting $setting)
    {
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

        $heroThumbnail = $request->hasFile('hero_thumbnail') ? MediaRepository::updateOrCreateByRequest(
            $request->file('hero_thumbnail'),
            'setting/hero_thumbnail',
            $setting->hero,
            MediaTypeEnum::IMAGE
        ) : $setting->hero;

        $aboutThumbnail = $request->hasFile('about_thumbnail') ? MediaRepository::updateOrCreateByRequest(
            $request->file('about_thumbnail'),
            'setting/about_thumbnail',
            $setting->about,
            MediaTypeEnum::IMAGE
        ) : $setting->about;

        $footerBgThumbnail = $request->hasFile('footer_bg_thumbnail') ? MediaRepository::updateOrCreateByRequest(
            $request->file('footer_bg_thumbnail'),
            'setting/footer_bg_thumbnail',
            $setting->footerBG,
            MediaTypeEnum::IMAGE
        ) : $setting->footerBG;


        return self::update($setting, [
            'logo_id' => $logo ? $logo->id : null,
            'footerlogo_id' => $footer ? $footer->id : null,
            'favicon_id' => $favicon ? $favicon->id : null,
            'scaner_id' => $scaner ? $scaner->id : null,
            'footer_text' => $request->footer_text ?? $setting->footer_text,
            'currency_position' => $request->currency_position ?? $setting->currency_position,
            'footer_contact_number' => $request->footer_contact_number ?? $setting->footer_contact_number,
            'footer_support_mail' => $request->footer_support_mail ?? $setting->footer_support_mail,
            'footer_description' => $request->footer_description ?? $setting->footer_description,
            'play_store_url' => $request->play_store_url ?? $setting->play_store_url,
            'app_store_url' => $request->app_store_url ?? $setting->app_store_url,
            'google_map_embed_code' => $request->google_map_embed_code ?? $setting->google_map_embed_code,
            'whatsapp_support_title' => $request->whatsapp_support_title,
            'whatsapp_support_number' => $request->whatsapp_support_number,
            'hero_thumbnail_id' => $heroThumbnail ? $heroThumbnail->id : null,
            'about_thumbnail_id' => $aboutThumbnail ? $aboutThumbnail->id : null,
            'footer_bg_thumbnail_id' => $footerBgThumbnail ? $footerBgThumbnail->id : null,
            'hero_title' => $request->hero_title ?? null,
            'hero_subtitle' => $request->hero_subtitle ?? null,
            'hero_description' => $request->hero_description ?? null,
        ]);
    }
}
