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
    // 1. Fix Hostinger deployment path issue
    echo "1. Checking deployment path...\n";
    if (file_exists('../public_html') && is_dir('../public_html')) {
        echo "⚠️ Detected nested deployment path, moving files...\n";
        shell_exec('cp -r * ../public_html/ 2>/dev/null || xcopy * ..\\public_html\\ /E /I /Y 2>nul');
        echo "✅ Files moved to correct path\n";
        chdir('../public_html');
        echo "✅ Changed working directory\n";
    }
    
    // 2. Copy public files to root (for Hostinger)
    echo "2. Copying public files to root directory...\n";
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

    // 3. Check if .env exists
    if (!file_exists('.env')) {
        echo "3. Creating .env file from .env.hostinger...\n";
        if (file_exists('.env.hostinger')) {
            copy('.env.hostinger', '.env');
            echo "✅ .env file created\n";
        } else {
            echo "❌ .env.hostinger not found!\n";
            exit(1);
        }
    } else {
        echo "3. .env file already exists\n";
    }
    
    // 4. Generate application key
    echo "4. Generating application key...\n";
    runCommand('php artisan key:generate --force');
    
    // 3.1 Verify APP_KEY exists
    $envContent = file_get_contents('.env');
    if (strpos($envContent, 'APP_KEY=base64:') === false) {
        echo "⚠️ APP_KEY not generated properly, creating manually...\n";
        $key = 'base64:' . base64_encode(random_bytes(32));
        $envContent = preg_replace('/APP_KEY=.*/', "APP_KEY=$key", $envContent);
        file_put_contents('.env', $envContent);
        echo "✅ APP_KEY created manually\n";
    }
    
    // 5. Create storage directories
    echo "5. Creating storage directories...\n";
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
    
    echo "4. Setting permissions...\n";
    runCommand('chmod -R 755 storage');
    runCommand('chmod -R 755 bootstrap/cache');
    runCommand('chmod -R 644 .env');
    
    // 5. Clear all caches and optimize
    echo "5. Clearing caches and optimizing...\n";
    runCommand('php artisan config:clear');
    runCommand('php artisan cache:clear');
    runCommand('php artisan route:clear');
    runCommand('php artisan view:clear');
    
    // 6. Test database connection
    echo "6. Testing database connection...\n";
    $dbTest = runCommand('php artisan migrate:status');
    if (strpos($dbTest, 'could not find driver') !== false || strpos($dbTest, 'Connection refused') !== false) {
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
