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

        \Laravel\Passport\Passport::routes();

        Gate::before(function($user, $ability) {
            if ($user->hasPermissionTo('super-admin')) {
                return true;
            }
        });
    }
}
