<?php
/**
 * MSAPT - Hostinger Initial Setup Script
 * Jalankan script ini SEKALI setelah first deployment ke Hostinger
 */

echo "=== MSAPT Hostinger Setup Started ===\n";

// Function to run command and show output
function runCommand($command) {
    echo "Running: $command\n";
    $output = shell_exec($command . ' 2>&1');
    echo $output . "\n";
    return $output;
}

try {
    // 1. Copy public files to root (for Hostinger)
    echo "1. Copying public files to root directory...\n";
    $publicFiles = ['index.php', '.htaccess', 'favicon.ico'];
    foreach ($publicFiles as $file) {
        if (file_exists("public/$file")) {
            copy("public/$file", $file);
            echo "✅ Copied $file\n";
        }
    }
    
    // Copy images folder if exists
    if (is_dir('public/images')) {
        if (!is_dir('images')) {
            mkdir('images', 0755, true);
        }
        runCommand('cp -r public/images/* images/ 2>/dev/null || xcopy public\\images images\\ /E /I /Y 2>nul || echo "Images copied manually"');
        echo "✅ Images folder copied\n";
    }

    // 2. Check if .env exists
    if (!file_exists('.env')) {
        echo "2. Creating .env file from .env.hostinger...\n";
        if (file_exists('.env.hostinger')) {
            copy('.env.hostinger', '.env');
            echo "✅ .env file created\n";
        } else {
            echo "❌ .env.hostinger not found!\n";
            exit(1);
        }
    } else {
        echo "2. .env file already exists\n";
    }
    
    // 3. Generate application key
    echo "3. Generating application key...\n";
    runCommand('php artisan key:generate --force');
    
    // 4. Create storage directories
    echo "4. Creating storage directories...\n";
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
    echo "4. Setting permissions...\n";
    runCommand('chmod -R 755 storage');
    runCommand('chmod -R 755 bootstrap/cache');
    runCommand('chmod -R 644 .env');
    
    // 5. Clear all caches
    echo "5. Clearing caches...\n";
    runCommand('php artisan config:clear');
    runCommand('php artisan route:clear');
    runCommand('php artisan view:clear');
    runCommand('php artisan cache:clear');
    
    // 6. Test database connection
    echo "6. Testing database connection...\n";
    $output = runCommand('php artisan migrate:status');
    if (strpos($output, 'Connection refused') !== false || strpos($output, 'Access denied') !== false) {
        echo "❌ Database connection failed!\n";
        echo "Please check your .env database configuration:\n";
        echo "- DB_HOST\n";
        echo "- DB_DATABASE\n";
        echo "- DB_USERNAME\n";
        echo "- DB_PASSWORD\n";
        exit(1);
    }
    
    // 7. Run migrations
    echo "7. Running database migrations...\n";
    runCommand('php artisan migrate --force');
    
    // 8. Seed database
    echo "8. Seeding database...\n";
    runCommand('php artisan db:seed --force');
    
    // 9. Create storage link
    echo "9. Creating storage link...\n";
    runCommand('php artisan storage:link');
    
    // 10. Optimize for production
    echo "10. Optimizing for production...\n";
    runCommand('php artisan config:cache');
    runCommand('php artisan route:cache');
    runCommand('php artisan view:cache');
    
    // 11. Create deployment flag
    echo "11. Creating deployment flag...\n";
    file_put_contents('storage/app/deployed.flag', date('Y-m-d H:i:s'));
    
    // 12. Create initial backup
    echo "12. Creating initial database backup...\n";
    include 'backup.php';
    
    echo "\n=== MSAPT Setup Completed Successfully! ===\n";
    echo "🎉 Website siap digunakan!\n";
    echo "📧 Login: admin@msa.com\n";
    echo "🔑 Password: password\n";
    echo "\n💡 Untuk update selanjutnya, cukup:\n";
    echo "   git push origin master\n";
    echo "\n🛡️ Database backup otomatis tersedia di storage/backups/\n";
    
} catch (Exception $e) {
    echo "=== Setup Failed ===\n";
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
