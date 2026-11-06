<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Silently drops form submissions where the hidden honeypot field was filled
 * (only bots fill it). The bot receives the normal success response so it
 * learns nothing; nothing is stored or e-mailed.
 */
class RejectHoneypot
{
    public const FIELD = 'company_website';

    public function handle(Request $request, Closure $next, string $fragment = ''): Response
    {
        if (filled($request->input(self::FIELD))) {
            return redirect()->to(url()->previous().($fragment ? '#'.$fragment : ''))
                ->with('toast', ['type' => 'success', 'message' => __('forms.received')]);
        }

        return $next($request);
    }
}
