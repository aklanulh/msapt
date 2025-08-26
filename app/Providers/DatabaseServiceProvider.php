<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Force PostgreSQL connection at runtime
        Config::set('database.default', 'pgsql');
        
        // Force environment variables
        $_ENV['DB_CONNECTION'] = 'pgsql';
        putenv('DB_CONNECTION=pgsql');
        
        // Override any existing database configuration
        Config::set('database.connections.pgsql', [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'railway'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ]);
    }

    public function boot(): void
    {
        // Ensure we're using PostgreSQL
        DB::purge('default');
        Config::set('database.default', 'pgsql');
    }
}
