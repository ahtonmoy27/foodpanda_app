<?php

namespace App\Http\Middleware;

use App\Services\SsoService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SsoAuthenticate
{
    protected SsoService $ssoService;

    public function __construct(SsoService $ssoService)
    {
        $this->ssoService = $ssoService;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is already authenticated locally, proceed
        if (Auth::check()) {
            return $next($request);
        }

        // Generate state for CSRF protection
        $state = bin2hex(random_bytes(16));
        session(['sso_state' => $state]);

        // Redirect to SSO auth server
        return redirect($this->ssoService->getLoginUrl($state));
    }
}
