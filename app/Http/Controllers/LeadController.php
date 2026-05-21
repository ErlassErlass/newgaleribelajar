<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Store a newly created lead in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:b2c,b2b',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'child_age' => 'nullable|string',
            'program' => 'nullable|string',
            'school_name' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        Lead::create($validated);

        return redirect()->back()->with('success', __('content.lead_form.success_msg') ?? 'Your message has been sent successfully!');
    }
}
