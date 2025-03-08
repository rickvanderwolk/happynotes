<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $headers = [
            'X-Frame-Options' => 'DENY',
            'X-Content-Type-Options' => 'nosniff',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Permissions-Policy' => "geolocation=(), microphone=(), camera=()",
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload',
        ];

        if (app()->environment('production')) {
            $headers['Cross-Origin-Opener-Policy'] = 'same-origin';
            $headers['Cross-Origin-Resource-Policy'] = 'same-origin';
            $headers['Content-Security-Policy'] = "default-src 'self'; script-src 'self'; style-src 'self'; frame-ancestors 'none';";
            $headers['X-Permitted-Cross-Domain-Policies'] = 'none';
        }

        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
