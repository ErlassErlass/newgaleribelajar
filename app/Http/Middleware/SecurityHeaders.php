<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Browser security headers for every web response.
 * The Content-Security-Policy is applied to public pages only (the admin panel's Livewire/Alpine
 * runtime needs a looser policy) and is skipped in local dev so the Vite dev server keeps working.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $headers = [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Permissions-Policy' => 'camera=(), microphone=(), geolocation=(), payment=(), usb=()',
            'Cross-Origin-Opener-Policy' => 'same-origin',
        ];

        if ($request->isSecure()) {
            $headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains';
        }

        $isAdmin = $request->is('admin', 'admin/*', 'livewire/*', 'filament/*');
        if (! $isAdmin && ! app()->isLocal()) {
            $headers['Content-Security-Policy'] = implode('; ', [
                "default-src 'self'",
                // Inline <script> blocks are used for small page widgets and JSON-LD
                "script-src 'self' 'unsafe-inline'",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
                "font-src 'self' https://fonts.gstatic.com data:",
                "img-src 'self' data: blob: https:",
                'frame-src https://www.youtube-nocookie.com https://www.youtube.com',
                "connect-src 'self'",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "frame-ancestors 'self'",
                'upgrade-insecure-requests',
            ]);
        }

        foreach ($headers as $name => $value) {
            if (! $response->headers->has($name)) {
                $response->headers->set($name, $value);
            }
        }

        // Don't advertise the PHP version
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
