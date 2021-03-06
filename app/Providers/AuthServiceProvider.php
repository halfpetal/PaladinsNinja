<?php

namespace PaladinsNinja\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'PaladinsNinja\Model' => 'PaladinsNinja\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Laravel\Passport\Passport::routes(null, ['middleware' => 'hashed_passport']);

        $this->definePassportScopes();

        Gate::before(function($user, $ability) {
            if ($user->hasPermissionTo('super-admin')) {
                return true;
            }
        });
    }

    private function definePassportScopes() {
        \Laravel\Passport\Passport::tokensCan([
           'user-info' => 'Get current user info.'
        ]);

        \Laravel\Passport\Passport::setDefaultScope([
            'user-info'
        ]);
    }
}
