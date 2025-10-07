<?php
/**
 * MSAPT - Production Fix Script
 * Script untuk memperbaiki masalah 500 error di production
 */

echo "=== MSAPT Production Fix Started ===\n";

// Function to run command and show output
function runCommand($command) {
    echo "Running: $command\n";
    $output = shell_exec($command . ' 2>&1');
    echo $output . "\n";
    return $output;
}

try {
    // 1. Check if .env exists, if not create from .env.hostinger
    if (!file_exists('.env')) {
        echo "1. Creating .env file from .env.hostinger...\n";
        if (file_exists('.env.hostinger')) {
            copy('.env.hostinger', '.env');
            echo "✅ .env file created from .env.hostinger\n";
        } else {
            echo "❌ .env.hostinger not found!\n";
            exit(1);
        }
    } else {
        echo "1. .env file already exists\n";
    }
    
    // 2. Generate application key if empty
    $envContent = file_get_contents('.env');
    if (strpos($envContent, 'APP_KEY=base64:YourGeneratedKeyWillBeHere') !== false || 
        preg_match('/APP_KEY=\s*$/', $envContent)) {
        echo "2. Generating new application key...\n";
        runCommand('php artisan key:generate --force');
    } else {
        echo "2. Application key already exists and is valid\n";
    }
    
    // 3. Create necessary directories
    echo "3. Creating necessary directories...\n";
    $directories = [
        'storage/app/public',
        'storage/backups',
        'storage/logs',
        'bootstrap/cache'
    ];
    
    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
            echo "Created: $dir\n";
        }
    }
    
    // 4. Set proper permissions
    echo "4. Setting proper permissions...\n";
    runCommand('chmod -R 755 storage');
    runCommand('chmod -R 755 bootstrap/cache');
    runCommand('chmod 644 .env');
    
    // 5. Clear all caches
    echo "5. Clearing all caches...\n";
    runCommand('php artisan config:clear');
    runCommand('php artisan route:clear');
    runCommand('php artisan view:clear');
    runCommand('php artisan cache:clear');
    
    // 6. Test database connection
    echo "6. Testing database connection...\n";
    $output = runCommand('php artisan migrate:status');
    if (strpos($output, 'Connection refused') !== false || 
        strpos($output, 'Access denied') !== false ||
        strpos($output, 'SQLSTATE') !== false) {
        echo "❌ Database connection failed!\n";
        echo "Please check your database configuration in .env file\n";
        // Don't exit, continue with other fixes
    } else {
        echo "✅ Database connection successful\n";
        
        // 7. Run migrations if database is accessible
        echo "7. Running database migrations...\n";
        runCommand('php artisan migrate --force');
    }
    
    // 8. Create storage link if not exists
    echo "8. Creating storage link...\n";
    if (!file_exists('public/storage')) {
        runCommand('php artisan storage:link');
    } else {
        echo "Storage link already exists\n";
    }
    
    // 9. Optimize for production
    echo "9. Optimizing for production...\n";
    runCommand('php artisan config:cache');
    runCommand('php artisan route:cache');
    runCommand('php artisan view:cache');
    
    // 10. Show current configuration
    echo "10. Current configuration:\n";
    echo "- APP_ENV: " . (getenv('APP_ENV') ?: 'Not set') . "\n";
    echo "- APP_DEBUG: " . (getenv('APP_DEBUG') ?: 'Not set') . "\n";
    echo "- DB_CONNECTION: " . (getenv('DB_CONNECTION') ?: 'Not set') . "\n";
    echo "- APP_URL: " . (getenv('APP_URL') ?: 'Not set') . "\n";
    
    echo "\n=== Production Fix Completed Successfully! ===\n";
    echo "🎉 Website should now be working properly!\n";
    echo "\n💡 If you still get 500 error, check:\n";
    echo "   1. Web server error logs\n";
    echo "   2. Laravel logs in storage/logs/\n";
    echo "   3. Database connection settings\n";
    echo "   4. File permissions on server\n";
    
} catch (Exception $e) {
    echo "=== Fix Failed ===\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Please check the error and try again.\n";
    exit(1);
}
?>
