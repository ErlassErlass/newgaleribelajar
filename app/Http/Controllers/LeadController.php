<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Store a newly created lead in storage.
     */
    public function store(StoreLeadRequest $request)
    {
        // Honeypot check — if 'website' field is filled, it's a bot
        if ($request->filled('website')) {
            return redirect()->back()->with('success', __('content.lead_form.success_msg') ?? 'Your message has been sent successfully!');
        }

        Lead::create($request->validated());

        return redirect()->back()->with('success', __('content.lead_form.success_msg') ?? 'Pesan Anda berhasil terkirim!');
    }
}
