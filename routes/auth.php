<?php

use App\Models\User;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

$oidcConfiguration = fn () => Cache::remember('oidc_configuration', now()->addDay(), function () {
    return Http::get(rtrim(config('services.oidc.base_url'), '/').'/.well-known/openid-configuration')->json();
});

Route::get('/auth/login', function () {
    // Store the requested URL in the session
    session()->put('intended_url', url()->previous());

    // Redirect to the OIDC provider for authentication
    return Socialite::driver('oidc')
        ->scopes(['profile', 'email', 'groups'])
        ->redirect();
})->name('login');

Route::get('/auth/callback', function () {
    // Retrieve the requested URL from the session
    $intendedUrl = session('intended_url');

    // Get user information from the OIDC provider and update or create the user in the database.
    $oidcUser = Socialite::driver('oidc')->stateless()->user();
    $user = User::where('oidc_sub', $oidcUser->id)->first()
        ?? User::where('email', $oidcUser->email)->first()
        ?? new User;

    $user->fill([
        'oidc_sub' => $oidcUser->id,
        'username' => $oidcUser->user['preferred_username'],
        'name' => $oidcUser->name,
        'firstname' => $oidcUser->user['given_name'],
        'lastname' => $oidcUser->user['family_name'],
        'email' => $oidcUser->email,
        'groups' => json_encode($oidcUser->user['groups']) ?? json_encode([]),
        'oidc_token' => $oidcUser->token,
        'oidc_refresh_token' => $oidcUser->refreshToken,
        'oidc_id_token' => $oidcUser->accessTokenResponseBody['id_token'],
    ])->save();

    // Log the user in
    Auth::login($user);

    // Redirect to the requested URL
    return redirect()->intended($intendedUrl);
});

Route::get('/auth/logout', function () use ($oidcConfiguration) {
    $id_token = auth()->user()->oidc_id_token;

    // Log out the user from the application
    Auth::logout();

    // Tell the OIDC provider to log out the user and redirect to the last page visited in the application
    return redirect($oidcConfiguration()['end_session_endpoint'].'?'.http_build_query([
        'post_logout_redirect_uri' => url()->previous(),
        'client_id' => config('services.oidc.client_id'),
        'id_token_hint' => $id_token,
    ]));
})->name('logout');

Route::post('/auth/backchannel-logout', function (Request $request) use ($oidcConfiguration) {
    $logoutToken = $request->input('logout_token');

    if (! $logoutToken) {
        return response()->json(['error' => 'invalid_request'], 400);
    }

    $configuration = $oidcConfiguration();

    try {
        $jwks = Cache::remember('oidc_jwks', now()->addDay(), function () use ($configuration) {
            return Http::get($configuration['jwks_uri'])->json();
        });

        $payload = JWT::decode($logoutToken, JWK::parseKeySet($jwks));
    } catch (Throwable $e) {
        return response()->json(['error' => 'invalid_token'], 400);
    }

    $isLogoutEvent = isset($payload->events->{'http://schemas.openid.net/event/backchannel-logout'});

    if (
        $payload->iss !== $configuration['issuer']
        || ! in_array(config('services.oidc.client_id'), (array) $payload->aud)
        || ! $isLogoutEvent
        || isset($payload->nonce)
        || ! isset($payload->sub)
    ) {
        return response()->json(['error' => 'invalid_token'], 400);
    }

    DB::table('sessions')
        ->whereIn('user_id', User::where('oidc_sub', $payload->sub)->pluck('id'))
        ->delete();

    return response('', 200)->header('Cache-Control', 'no-cache, no-store');
})->name('backchannel-logout');
