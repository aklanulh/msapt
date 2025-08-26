<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Service provider for database configuration
        // Uses default Laravel database configuration from config/database.php and .env
    }

    public function boot(): void
    {
        // Boot method - uses default Laravel database configuration
    }
}
