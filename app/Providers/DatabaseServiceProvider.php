<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Auto-detect environment and set appropriate database
        if (env('RAILWAY_ENVIRONMENT') || env('DATABASE_URL')) {
            // Railway environment - use PostgreSQL
            Config::set('database.default', 'pgsql');
        } else {
            // Local environment - use SQLite
            Config::set('database.default', 'sqlite');
        }
    }

    public function boot(): void
    {
        // Boot method - database configuration handled in register
    }
}
