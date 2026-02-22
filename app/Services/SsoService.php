<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Http;

class SsoService
{
    private string $authServerUrl;
    private string $clientId;
    private string $clientSecret;
    private string $jwtSecret;
    private string $callbackUrl;

    public function __construct()
    {
        $this->authServerUrl = config('sso.auth_server_url');
        $this->clientId = config('sso.client_id');
        $this->clientSecret = config('sso.client_secret');
        $this->jwtSecret = config('sso.jwt_secret');
        $this->callbackUrl = config('sso.callback_url');
    }

    /**
     * Get the SSO login URL.
     */
    public function getLoginUrl(?string $state = null): string
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->callbackUrl,
        ];

        if ($state) {
            $params['state'] = $state;
        }

        return $this->authServerUrl . '/sso/authorize?' . http_build_query($params);
    }

    /**
     * Validate token with the auth server.
     */
    public function validateToken(string $token): ?array
    {
        try {
            // First, try to decode locally using shared secret
            $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));
            
            // Also validate with auth server to mark token as used
            $response = Http::post($this->authServerUrl . '/api/sso/validate', [
                'token' => $token,
            ]);

            if ($response->successful() && $response->json('valid')) {
                return [
                    'user_id' => $decoded->sub,
                    'user' => (array) $decoded->user,
                    'client' => $decoded->client,
                ];
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get logout URL.
     */
    public function getLogoutUrl(?string $redirectTo = null): string
    {
        $params = [];
        if ($redirectTo) {
            $params['redirect'] = $redirectTo;
        }
        
        return $this->authServerUrl . '/logout?' . http_build_query($params);
    }
}
