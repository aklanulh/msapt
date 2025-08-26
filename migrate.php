<?php

// Simple migration script to run manually
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Set environment
putenv('DB_CONNECTION=mysql');

// Boot Laravel
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Testing database connection...\n";
    $pdo = DB::connection()->getPdo();
    echo "Connected to: " . $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";
    
    echo "Running migrations...\n";
    Artisan::call('migrate', ['--force' => true, '--verbose' => true]);
    echo Artisan::output();
    
    echo "Running seeders...\n";
    Artisan::call('db:seed', ['--force' => true, '--verbose' => true]);
    echo Artisan::output();
    
    echo "Migration completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
