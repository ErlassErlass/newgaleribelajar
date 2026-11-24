<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validateWithBag('newsletter', [
            'email' => 'required|email:rfc|max:255',
            'source' => 'nullable|string|max:100',
            'website' => 'max:0', // honeypot
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'website.max' => 'Permintaan tidak valid.',
        ]);

        // Same response for new and existing addresses, so the form can't be used to probe who is subscribed
        Subscriber::updateOrCreate(
            ['email' => mb_strtolower(trim($data['email']))],
            [
                'source' => $data['source'] ?? 'footer',
                'ip_address' => $request->ip(),
                'is_active' => true,
                'unsubscribed_at' => null,
            ]
        );

        // Subscribing to the newsletter is itself consent to receive Erlass info
        Contact::record($data['email'], 'newsletter', ['consent' => true]);

        return redirect()->to(url()->previous().'#newsletter')
            ->with('newsletter_success', 'Terima kasih! Anda akan menerima info terbaru dari Erlass Academy.');
    }
}
