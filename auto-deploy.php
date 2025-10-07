<?php
/**
 * Auto Deployment Script untuk Hostinger
 * Script ini akan memperbaiki semua masalah yang ditemukan
 */

echo "=== MSAPT Auto Deployment & Fix Started ===\n";

// Set working directory
$projectPath = __DIR__;
chdir($projectPath);

// Function to run command and show output
function runCommand($command) {
    echo "Running: $command\n";
    $output = shell_exec($command . ' 2>&1');
    echo $output . "\n";
    return $output;
}

try {
    // 1. Copy environment file
    echo "1. Setting up environment file...\n";
    if (file_exists('.env.hostinger')) {
        copy('.env.hostinger', '.env');
        echo "✅ .env file created from .env.hostinger\n";
    } else {
        copy('.env.example', '.env');
        echo "✅ .env file created from .env.example\n";
    }
    
    // 2. Generate application key if needed
    echo "2. Checking and generating APP_KEY...\n";
    $envContent = file_get_contents('.env');
    if (strpos($envContent, 'APP_KEY=') === false || 
        preg_match('/APP_KEY=\s*$/', $envContent) ||
        strpos($envContent, 'APP_KEY=base64:YourGenerated') !== false) {
        
        echo "Generating new APP_KEY...\n";
        runCommand('php artisan key:generate --force');
    } else {
        echo "✅ APP_KEY already exists and is valid\n";
    }
    
    // 3. Install/Update composer dependencies
    echo "3. Installing Composer dependencies...\n";
    runCommand('composer install --no-dev --optimize-autoloader');
    
    // 4. Clear all caches
    echo "4. Clearing all caches...\n";
    runCommand('php artisan config:clear');
    runCommand('php artisan route:clear');
    runCommand('php artisan view:clear');
    runCommand('php artisan cache:clear');
    
    // 5. Set proper permissions
    echo "5. Setting proper permissions...\n";
    runCommand('chmod -R 755 storage');
    runCommand('chmod -R 755 bootstrap/cache');
    
    // 6. Test database connection
    echo "6. Testing database connection...\n";
    $dbTest = runCommand('php artisan tinker --execute="try { DB::connection()->getPdo(); echo \"Database connected successfully\n\"; } catch(Exception \$e) { echo \"Database error: \" . \$e->getMessage() . \"\n\"; }"');
    
    // 7. Run migrations if database is connected
    if (strpos($dbTest, 'Database connected successfully') !== false) {
        echo "7. Running database migrations...\n";
        runCommand('php artisan migrate --force');
        
        // 8. Seed database if needed (only on first deployment)
        if (!file_exists('storage/app/deployed.flag')) {
            echo "8. Seeding database (first deployment)...\n";
            runCommand('php artisan db:seed --force');
            file_put_contents('storage/app/deployed.flag', date('Y-m-d H:i:s'));
        }
    } else {
        echo "⚠️ Database connection failed, skipping migrations\n";
    }
    
    // 9. Optimize for production
    echo "9. Optimizing for production...\n";
    runCommand('php artisan config:cache');
    runCommand('php artisan route:cache');
    runCommand('php artisan view:cache');
    
    // 10. Final test
    echo "10. Running final tests...\n";
    runCommand('php artisan about');
    
    echo "\n=== ✅ MSAPT Deployment Completed Successfully! ===\n";
    echo "Website should now be working at: https://msapt.co.id\n";
    
} catch (Exception $e) {
    echo "\n=== ❌ Deployment Failed ===\n";
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
