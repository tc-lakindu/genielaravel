<?php

namespace Techcouchits\Genie;

use Illuminate\Support\ServiceProvider;

class GenieIpgServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
    }
}
