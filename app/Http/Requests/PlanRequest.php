<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'course_ids' => 'required|array|exists:courses,id',
            'title' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'course_limit' => 'required|numeric',
            'plan_type' => 'required',
            'description' => 'required|string',
            'is_active' => 'nullable',
        ];
    }
}
