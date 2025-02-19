<?php

use Illuminate\Http\Request;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (config('app.force_email_verification') && (! $request->user() || ! $request->user()->hasVerifiedEmail())) {
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
