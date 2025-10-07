<?php
/**
 * Fix Database Configuration Script
 * Script untuk memastikan Laravel menggunakan MySQL dengan benar
 */

echo "=== Fixing Database Configuration ===\n";

try {
    // 1. Force recreate .env with correct database config
    echo "1. Recreating .env file...\n";
    if (file_exists('.env.hostinger')) {
        $content = file_get_contents('.env.hostinger');
        
        // Ensure correct database configuration
        $content = preg_replace('/DB_CONNECTION=.*/', 'DB_CONNECTION=mysql', $content);
        $content = preg_replace('/DB_HOST=.*/', 'DB_HOST=127.0.0.1', $content);
        
        // Remove any BOM and fix line endings
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        
        file_put_contents('.env', $content);
        chmod('.env', 0644);
        echo "✅ .env recreated with MySQL config\n";
    }
    
    // 2. Completely remove all cached files
    echo "2. Removing ALL cached files...\n";
    $cacheDirs = [
        'bootstrap/cache',
        'storage/framework/cache',
        'storage/framework/sessions', 
        'storage/framework/views',
        'storage/logs'
    ];
    
    foreach ($cacheDirs as $dir) {
        if (is_dir($dir)) {
            shell_exec("rm -rf $dir/* 2>/dev/null");
            echo "✅ Cleared $dir\n";
        }
    }
    
    // 3. Force clear artisan caches
    echo "3. Force clearing artisan caches...\n";
    shell_exec('php artisan config:clear 2>/dev/null');
    shell_exec('php artisan cache:clear 2>/dev/null');
    shell_exec('php artisan route:clear 2>/dev/null');
    shell_exec('php artisan view:clear 2>/dev/null');
    echo "✅ Artisan caches cleared\n";
    
    // 4. Set proper permissions
    echo "4. Setting proper permissions...\n";
    shell_exec('chmod -R 755 storage 2>/dev/null');
    shell_exec('chmod -R 755 bootstrap/cache 2>/dev/null');
    echo "✅ Permissions set\n";
    
    // 5. Force rebuild config cache
    echo "5. Rebuilding config cache...\n";
    shell_exec('php artisan config:cache 2>/dev/null');
    echo "✅ Config cache rebuilt\n";
    
    // 6. Test database connection
    echo "6. Testing database connection...\n";
    $output = shell_exec('php artisan tinker --execute="echo config(\'database.default\'); try { DB::connection()->getPdo(); echo \' - Connected!\'; } catch(Exception \$e) { echo \' - Error: \' . \$e->getMessage(); }" 2>&1');
    echo "Result: $output\n";
    
    echo "\n=== Database Configuration Fix Complete ===\n";
    echo "Test your website: https://msapt.co.id\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
