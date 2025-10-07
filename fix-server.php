<?php
/**
 * Quick Fix Script untuk 500 Server Error
 * Jalankan: php fix-server.php
 */

echo "=== MSAPT Server Fix Started ===\n";

try {
    // 1. Copy .env file
    echo "1. Creating .env file...\n";
    if (file_exists('.env.hostinger')) {
        copy('.env.hostinger', '.env');
        echo "✅ .env created from .env.hostinger\n";
    }
    
    // 2. Set permissions
    echo "2. Setting permissions...\n";
    shell_exec('chmod -R 755 storage 2>&1');
    shell_exec('chmod -R 755 bootstrap/cache 2>&1');
    echo "✅ Permissions set\n";
    
    // 3. Clear caches
    echo "3. Clearing caches...\n";
    shell_exec('php artisan config:clear 2>&1');
    shell_exec('php artisan cache:clear 2>&1');
    shell_exec('php artisan route:clear 2>&1');
    shell_exec('php artisan view:clear 2>&1');
    echo "✅ Caches cleared\n";
    
    // 4. Test website
    echo "4. Testing website...\n";
    $test = shell_exec('curl -I https://msapt.co.id 2>&1');
    echo $test;
    
    echo "\n✅ Fix completed! Check https://msapt.co.id\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
