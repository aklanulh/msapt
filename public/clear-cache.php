<?php

// Force clear all Laravel caches and reset database connection
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Boot Laravel
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

echo "=== FORCE CLEAR ALL CACHES ===\n";

try {
    // Clear all caches
    Artisan::call('config:clear');
    echo "✅ Config cache cleared\n";
    
    Artisan::call('cache:clear');
    echo "✅ Application cache cleared\n";
    
    Artisan::call('route:clear');
    echo "✅ Route cache cleared\n";
    
    Artisan::call('view:clear');
    echo "✅ View cache cleared\n";
    
    // Use environment database connection
    // Don't force database connection - use what's in .env
    
    echo "✅ Using environment database configuration\n";
    
    // Test database connection
    echo "\nTesting database connection...\n";
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connected: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "\n";
    
    // Show current database config
    echo "\nCurrent database config:\n";
    echo "- Connection: " . config('database.default') . "\n";
    echo "- Driver: " . config('database.connections.' . config('database.default') . '.driver') . "\n";
    echo "- Host: " . config('database.connections.' . config('database.default') . '.host') . "\n";
    echo "- Database: " . config('database.connections.' . config('database.default') . '.database') . "\n";
    
    echo "\n✅ Cache clearing completed successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== END ===\n";
