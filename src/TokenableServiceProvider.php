<?php

namespace Zaoob\Laravel\Tokenable;

use Illuminate\Support\ServiceProvider;
use Zaoob\Laravel\Tokenable\Http\Middleware\ZaoobTokenMiddleware;

class TokenableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $router->aliasMiddleware('zaoobToken', ZaoobTokenMiddleware::class);
    }
}
