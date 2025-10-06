<?php
/**
 * Hostinger Deployment Script
 * Script ini akan dijalankan otomatis setiap kali ada git push
 */

echo "=== MSAPT Deployment Started ===\n";

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
    // 1. Update composer dependencies
    echo "1. Installing/Updating Composer dependencies...\n";
    runCommand('composer install --no-dev --optimize-autoloader');
    
    // 2. Copy environment file if not exists
    if (!file_exists('.env')) {
        echo "2. Creating .env file...\n";
        if (file_exists('.env.hostinger')) {
            copy('.env.hostinger', '.env');
            echo ".env file created from .env.hostinger\n";
        } else {
            copy('.env.example', '.env');
            echo ".env file created from .env.example\n";
        }
    } else {
        echo "2. .env file already exists, skipping...\n";
    }
    
    // 3. Generate application key if not set
    $envContent = file_get_contents('.env');
    if (strpos($envContent, 'APP_KEY=') !== false && strpos($envContent, 'APP_KEY=base64:') === false) {
        echo "3. Generating application key...\n";
        runCommand('php artisan key:generate --force');
    } else {
        echo "3. Application key already exists, skipping...\n";
    }
    
    // 4. Clear all caches
    echo "4. Clearing caches...\n";
    runCommand('php artisan config:clear');
    runCommand('php artisan route:clear');
    runCommand('php artisan view:clear');
    runCommand('php artisan cache:clear');
    
    // 5. Run database migrations
    echo "5. Running database migrations...\n";
    runCommand('php artisan migrate --force');
    
    // 6. Backup database before migrations (safety measure)
    echo "6. Creating database backup...\n";
    $backupFile = 'storage/backups/db_backup_' . date('Y-m-d_H-i-s') . '.sql';
    if (!is_dir('storage/backups')) {
        mkdir('storage/backups', 0755, true);
    }
    runCommand("mysqldump -h \$DB_HOST -u \$DB_USERNAME -p\$DB_PASSWORD \$DB_DATABASE > $backupFile");
    
    // 7. Seed database if needed (only on first deployment)
    if (!file_exists('storage/app/deployed.flag')) {
        echo "7. Seeding database (first deployment)...\n";
        runCommand('php artisan db:seed --force');
        
        // Create deployment flag
        file_put_contents('storage/app/deployed.flag', date('Y-m-d H:i:s'));
    } else {
        echo "7. Database already seeded, skipping...\n";
    }
    
    // 8. Optimize for production
    echo "8. Optimizing for production...\n";
    runCommand('php artisan config:cache');
    runCommand('php artisan route:cache');
    runCommand('php artisan view:cache');
    
    // 9. Set proper permissions
    echo "9. Setting permissions...\n";
    runCommand('chmod -R 755 storage');
    runCommand('chmod -R 755 bootstrap/cache');
    
    echo "=== MSAPT Deployment Completed Successfully ===\n";
    
} catch (Exception $e) {
    echo "=== Deployment Failed ===\n";
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
