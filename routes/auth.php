<?php

use App\Models\User;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/login', function() {
    # Store the requested URL in the session
    session()->put('intended_url', url()->previous());

    # Redirect to Keycloak for authentication
    return Socialite::driver('keycloak')
        ->scopes(['profile', 'email'])
        ->redirect();
})->name('login');

Route::get('/auth/callback', function() {
    # Retrieve the requested URL from the session
    $intendedUrl = session('intended_url');

    # Get user information from Keycloak and update or create the user in the database
    $keycloakUser = Socialite::driver('keycloak')->stateless()->user();
    dd($keycloakUser);
    $user = User::updateOrCreate([
        'username' => $keycloakUser->nickname,
    ], [
        'username' => $keycloakUser->nickname,
        'name' => $keycloakUser->name,
        'firstname' => $keycloakUser->user['given_name'],
        'lastname' => $keycloakUser->user['family_name'],
        'email' => $keycloakUser->email,
        'groups' => json_encode($keycloakUser->user['groups']) ?? json_encode([]),
        'keycloak_token' => $keycloakUser->token,
        'keycloak_refresh_token' => $keycloakUser->refreshToken,
    ]);

    # Log the user in
    Auth::login($user);

    # Redirect to the requested URL
    return redirect()->intended($intendedUrl);
});

Route::get('/auth/logout', function () {
    # Log out the user from the application
    Auth::logout();

    # Tell Keycloak to log out the user and redirect to the base URL of the application
    $redirectUri = Config::get('app.url');
    return redirect(Socialite::driver('keycloak')->getLogoutUrl($redirectUri, env('KEYCLOAK_CLIENT_ID')));
})->name('logout');