<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerConfigRequest extends FormRequest
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
            'server_name' => 'nullable|string|max:255',
            'domain' => 'nullable|string|max:255',
            'ns1' => 'required|string|max:255',
            'ns2' => 'required|string|max:255',
            'root_path' => 'nullable|string|max:255',
            'ssl_enabled' => 'nullable',
        ];
    }
}
