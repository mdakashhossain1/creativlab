<?php

namespace App\Arknox;

use Illuminate\Support\ServiceProvider;

class ArknoxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/arknox.php', 'arknox');

        $this->app->singleton(ArknoxDb::class, function () {
            return new ArknoxDb(
                apiUrl:   rtrim(config('arknox.api_url',  env('ARKNOX_API_URL',  '')), '/'),
                database: config('arknox.database', env('ARKNOX_DATABASE', '')),
                username: config('arknox.username', env('ARKNOX_USERNAME', '')),
                password: config('arknox.password', env('ARKNOX_PASSWORD', '')),
            );
        });

        $this->app->alias(ArknoxDb::class, 'arknox');
    }
}
