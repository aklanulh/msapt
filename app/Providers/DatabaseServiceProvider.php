<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Force MySQL for all environments (Hostinger deployment)
        Config::set('database.default', 'mysql');
    }

    public function boot(): void
    {
        // Boot method - database configuration handled in register
    }
}
