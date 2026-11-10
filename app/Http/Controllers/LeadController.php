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
            return redirect()->back()->with('success', 'Terima kasih, formulir konsultasi Anda telah terkirim.');
        }

        $validated = $request->validated();
        $validated['status'] = 'new';
        $validated['consent_given'] = $request->boolean('consent_given', true);

        Lead::create($validated);

        return redirect()->back()->with('success', 'Terima kasih! Permintaan konsultasi Anda telah diterima. Tim konsultan pendidikan Erlass akan segera menghubungi Anda dalam 1x24 jam kerja.');
    }
}
