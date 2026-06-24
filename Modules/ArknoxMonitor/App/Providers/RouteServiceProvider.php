<?php

namespace Modules\ArknoxMonitor\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'ArknoxMonitor';

    public function boot(): void
    {
        parent::boot();
    }

    public function map(): void
    {
        Route::group([], module_path($this->moduleName, 'routes/api.php'));
    }
}
