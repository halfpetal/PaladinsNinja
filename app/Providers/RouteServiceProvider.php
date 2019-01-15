<?php

namespace PaladinsNinja\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'PaladinsNinja\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));

        Route::prefix('api-champion/v1')
             ->middleware('api')
             ->namespace($this->namespace . '\API\Champion\v1')
             ->name('api.champion.v1.')
             ->group(base_path('routes/API/v1/Champion.php'));

        Route::prefix('api-match/v1')
             ->middleware('api')
             ->namespace($this->namespace . '\API\Match\v1')
             ->name('api.match.v1.')
             ->group(base_path('routes/API/v1/Match.php'));

        Route::prefix('api-player/v1')
             ->middleware('api')
             ->namespace($this->namespace . '\API\Player\v1')
             ->name('api.player.v1.')
             ->group(base_path('routes/API/v1/Player.php'));

        Route::prefix('api-user/v1')
             ->middleware(['api', 'auth:api', 'verified'])
             ->namespace($this->namespace . '\API\User\v1')
             ->name('api.user.v1.')
             ->group(base_path('routes/API/v1/User.php'));
    }
}
