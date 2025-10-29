<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'app_name' => 'string|max:50',
            'app_currency' => 'string|min:3|max:3',
            'app_currency_symbol' => 'string|max:1',
            'logo' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'footerlogo' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'favicon' => "image|mimes:png,gif,ico|max:2048",
            'hero_thumbnail' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'footer_bg_thumbnail' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'about_thumbnail' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'footer_text' => 'string|max:500',
            'footer_contact_number' => 'nullable',
            'footer_support_mail' => 'nullable|email',
            'footer_description' => 'string|max:800',
            'play_store_url' => 'nullable|url',
            'app_store_url' => 'nullable|url',
            'social_links.*' => 'nullable|url',
            "hero_title" => "nullable|string|max:255",
            "hero_subtitle" => "nullable|string|max:255",
            "hero_description" => "nullable|string",
        ];
    }

    public function messages(): array
    {
        return [
            'social_links.*' => 'Social media URL is not valid',
        ];
    }
}
