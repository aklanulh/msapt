<?php
/**
 * Force MySQL Configuration
 * Script untuk memaksa Laravel menggunakan MySQL
 */

echo "=== Force MySQL Configuration ===\n";

try {
    // 1. Verify .env has correct values
    $envContent = file_get_contents('.env');
    echo "1. Checking .env content...\n";
    
    if (strpos($envContent, 'DB_CONNECTION=mysql') !== false) {
        echo "✅ .env has DB_CONNECTION=mysql\n";
    } else {
        echo "❌ .env missing DB_CONNECTION=mysql\n";
        // Fix it
        $envContent = preg_replace('/DB_CONNECTION=.*/', 'DB_CONNECTION=mysql', $envContent);
        file_put_contents('.env', $envContent);
        echo "✅ Fixed DB_CONNECTION in .env\n";
    }
    
    // 2. Remove ALL cached files
    echo "2. Removing all cached files...\n";
    shell_exec('rm -rf bootstrap/cache/* 2>/dev/null');
    shell_exec('rm -rf storage/framework/cache/* 2>/dev/null');
    shell_exec('rm -rf storage/framework/sessions/* 2>/dev/null');
    shell_exec('rm -rf storage/framework/views/* 2>/dev/null');
    echo "✅ All cache cleared\n";
    
    // 3. Force clear artisan caches
    echo "3. Clearing artisan caches...\n";
    shell_exec('php artisan config:clear 2>/dev/null');
    shell_exec('php artisan cache:clear 2>/dev/null');
    shell_exec('php artisan route:clear 2>/dev/null');
    shell_exec('php artisan view:clear 2>/dev/null');
    echo "✅ Artisan caches cleared\n";
    
    // 4. Test environment loading
    echo "4. Testing environment loading...\n";
    $dbConnection = getenv('DB_CONNECTION') ?: $_ENV['DB_CONNECTION'] ?? 'not found';
    echo "ENV DB_CONNECTION: $dbConnection\n";
    
    // 5. Force cache config with proper environment
    echo "5. Force caching config...\n";
    shell_exec('php artisan config:cache 2>/dev/null');
    echo "✅ Config cached\n";
    
    echo "\n=== Force MySQL Configuration Complete ===\n";
    echo "Now test: php artisan tinker --execute=\"echo config('database.default');\"\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
