<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Keycloak\Provider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('keycloak', Provider::class);
        });

        Gate::define('admin', function (User $user) {
            if (in_array(config('app.group_admin'), json_decode($user->groups))) {
                return true;
            }

            return false;
        });

        Gate::define('election-commission', function (User $user) {
            if (
                in_array(config('app.group_admin'), json_decode($user->groups)) ||
                in_array(config('app.group_election_commission'), json_decode($user->groups))
            ) {
                return true;
            }

            return false;
        });
    }
}
