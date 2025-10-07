<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class AutoMigrate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Check if migrations table exists
            if (!Schema::hasTable('migrations')) {
                // Run migrations silently
                Artisan::call('migrate', ['--force' => true]);
                
                // Seed database if users table is empty
                if (Schema::hasTable('users') && DB::table('users')->count() === 0) {
                    Artisan::call('db:seed', ['--force' => true]);
                }
            }
        } catch (\Exception $e) {
            // Log error but don't break the application
            Log::error('Auto migrate error: ' . $e->getMessage());
        }

        return $next($request);
    }
}
