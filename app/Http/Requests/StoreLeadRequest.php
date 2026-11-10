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
            'type' => 'required|string|in:b2c,b2b,consultation,quotation,collaboration,download',
            'sender_type' => 'nullable|string|in:school,education_office,institution,business_partner,parent,other',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'child_age' => 'nullable|string|max:50',
            'program' => 'nullable|string|max:255',
            'school_name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'student_count' => 'nullable|integer',
            'message' => 'nullable|string|max:3000',
            'consent_given' => 'nullable|boolean',
            'source' => 'nullable|string|max:100',
            'website' => 'max:0', // Honeypot — must be empty
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor WhatsApp / Telepon wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'website.max' => 'Spam detected.',
        ];
    }
}
