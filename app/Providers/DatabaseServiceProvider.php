<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Force MySQL connection at runtime
        Config::set('database.default', 'mysql');
        
        // Remove any PostgreSQL configuration that might exist
        if (Config::has('database.connections.pgsql')) {
            Config::forget('database.connections.pgsql');
        }
    }

    public function boot(): void
    {
        //
    }
}
