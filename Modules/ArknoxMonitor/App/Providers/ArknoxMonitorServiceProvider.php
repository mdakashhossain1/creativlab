<?php

namespace Modules\ArknoxMonitor\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\ArknoxMonitor\App\Services\BillingEngine;
use Modules\ArknoxMonitor\App\Services\HealthChecker;
use Modules\ArknoxMonitor\App\Services\QueryBuffer;

class ArknoxMonitorServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'ArknoxMonitor';

    public function register(): void
    {
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), 'arknoxmonitor');

        $this->app->singleton(HealthChecker::class);
        $this->app->singleton(BillingEngine::class);

        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));

        $this->publishes([
            module_path($this->moduleName, 'config/config.php') => config_path('arknoxmonitor.php'),
        ], 'arknoxmonitor-config');

        // Start listening to DB queries after all providers are booted
        $this->app->booted(function () {
            QueryBuffer::start();

            // Flush accumulated stats at the very end of each request
            $this->app->terminating(function () {
                QueryBuffer::flush();
            });
        });
    }
}
