<?php

// Simple database connection test
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Boot Laravel
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DATABASE CONNECTION TEST ===\n";
echo "Environment: " . env('APP_ENV') . "\n";
echo "DB Connection: " . env('DB_CONNECTION') . "\n";
echo "DB Host: " . env('DB_HOST') . "\n";
echo "DB Port: " . env('DB_PORT') . "\n";
echo "DB Database: " . env('DB_DATABASE') . "\n";
echo "DB Username: " . env('DB_USERNAME') . "\n";
echo "DATABASE_URL exists: " . (env('DATABASE_URL') ? 'YES' : 'NO') . "\n";
echo "\n";

try {
    echo "Testing PDO connection...\n";
    $pdo = DB::connection()->getPdo();
    echo "✅ PDO Connection: SUCCESS\n";
    echo "Connection Status: " . $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";
    echo "Server Info: " . $pdo->getAttribute(PDO::ATTR_SERVER_INFO) . "\n";
    echo "Driver Name: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "\n";
    
    echo "\nTesting simple query...\n";
    $result = DB::select('SELECT 1 as test');
    echo "✅ Query Test: SUCCESS\n";
    echo "Result: " . json_encode($result) . "\n";
    
    echo "\nChecking database tables...\n";
    // Use information_schema for better compatibility
    $tables = DB::select('SELECT table_name FROM information_schema.tables WHERE table_schema = ?', [env('DB_DATABASE')]);
    echo "Tables found: " . count($tables) . "\n";
    foreach ($tables as $table) {
        echo "- " . $table->table_name . "\n";
    }
    
    if (count($tables) == 0) {
        echo "❌ Database is empty - migrations not run\n";
    } else {
        echo "✅ Database has tables\n";
        
        // Check products table specifically
        try {
            $productCount = DB::table('products')->count();
            echo "Products count: " . $productCount . "\n";
        } catch (Exception $e) {
            echo "❌ Products table error: " . $e->getMessage() . "\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ DATABASE CONNECTION FAILED\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
    
    // Try to get more details
    if (strpos($e->getMessage(), 'could not find driver') !== false) {
        echo "\n🔍 Driver issue detected - checking available drivers:\n";
        echo "PDO Drivers: " . implode(', ', PDO::getAvailableDrivers()) . "\n";
    }
    
    if (strpos($e->getMessage(), 'Connection refused') !== false) {
        echo "\n🔍 Connection refused - check host/port configuration\n";
    }
}

echo "\n=== END TEST ===\n";
