<?php

namespace StealthAuth;

use Illuminate\Support\ServiceProvider;
use StealthAuth\Middleware\StealthAuthMiddleware;

class StealthAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/../config/stealth-auth.php', 'stealth-auth');
        $this->publishes([
            __DIR__.'/../config/stealth-auth.php' => config_path('stealth-auth.php')
        ], 'stealth-auth-config');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app['router']->aliasMiddleware('stealth.auth', StealthAuthMiddleware::class);
    }
}