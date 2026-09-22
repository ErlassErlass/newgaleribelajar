<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'type' => 'required|string|in:b2c,b2b',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'child_age' => 'nullable|string',
            'program' => 'nullable|string',
            'school_name' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:2000',
            'website' => 'max:0', // Honeypot — must be empty
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'nama']),
            'phone.required' => __('validation.required', ['attribute' => 'nomor telepon']),
            'website.max' => 'Spam detected.',
        ];
    }
}
