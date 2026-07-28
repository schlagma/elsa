<?php

namespace App\Socialite;

use SocialiteProviders\OIDC\EmptyEmailException;
use SocialiteProviders\OIDC\InvalidStateException;
use SocialiteProviders\OIDC\Provider;

class OidcProvider extends Provider
{
    /**
     * {@inheritdoc}
     *
     * Identical to the parent implementation, except it also stores the full
     * token response (which includes the raw "id_token" JWT) on the user via
     * setAccessTokenResponseBody() — the parent never calls it, so
     * $user->accessTokenResponseBody is always null upstream.
     */
    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        if ($this->hasInvalidState()) {
            throw new InvalidStateException('Callback: invalid state.', 401);
        }

        $tokenResponse = $this->getAccessTokenResponse($this->request->input('code'));

        $payload = $this->decodeJWT(
            $tokenResponse['id_token'],
            $this->request->input('code')
        );

        if ($this->hasEmptyEmail($payload)) {
            $payload = $this->getUserByToken($tokenResponse['access_token']);
            $email = $payload['email'] ?? null;
            if (! $email) {
                throw new EmptyEmailException('JWT: User has no email.', 401);
            }
        }

        $this->user = $this->mapUserToObject((array) $payload);
        $this->user->setAccessTokenResponseBody($tokenResponse);

        return $this->user->setToken($tokenResponse['access_token'])
            ->setRefreshToken($tokenResponse['refresh_token'] ?? null)
            ->setExpiresIn($tokenResponse['expires_in']);
    }
}
