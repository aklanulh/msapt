<?php
/**
 * Secure Deployment Script for Hostinger
 * This script safely deploys the application without exposing sensitive data
 */

echo "🚀 Starting secure deployment process...\n";

// Check if we're in the right directory
if (!file_exists('artisan')) {
    die("❌ Error: Not in Laravel project directory\n");
}

// Step 1: Check if .env.hostinger exists (should be created manually on server)
if (!file_exists('.env.hostinger')) {
    echo "⚠️  Warning: .env.hostinger not found!\n";
    echo "📝 Please create .env.hostinger manually on the server using .env.hostinger.example as template\n";
    
    if (file_exists('.env.hostinger.example')) {
        echo "📋 Template available: .env.hostinger.example\n";
        echo "🔧 Copy and configure: cp .env.hostinger.example .env.hostinger\n";
    }
    
    // Don't exit, continue with other deployment steps
}

// Step 2: Copy environment file if it exists
if (file_exists('.env.hostinger')) {
    copy('.env.hostinger', '.env');
    echo "✅ Environment file configured\n";
} else {
    echo "⚠️  Skipping environment configuration (file not found)\n";
}

// Step 3: Check for nested directory issue (Hostinger git push problem)
if (is_dir('public_html') && file_exists('public_html/artisan')) {
    echo "🔧 Fixing nested directory structure...\n";
    
    // Move files from nested public_html to root
    $files = scandir('public_html');
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $source = "public_html/$file";
            $destination = $file;
            
            if (is_dir($source)) {
                if (!is_dir($destination)) {
                    rename($source, $destination);
                }
            } else {
                if (!file_exists($destination)) {
                    rename($source, $destination);
                }
            }
        }
    }
    
    // Remove empty public_html directory
    rmdir('public_html');
    echo "✅ Directory structure fixed\n";
}

// Step 4: Generate APP_KEY if missing
if (file_exists('.env')) {
    $envContent = file_get_contents('.env');
    if (strpos($envContent, 'APP_KEY=') === false || strpos($envContent, 'APP_KEY=YOUR_APP_KEY_HERE') !== false) {
        echo "🔑 Generating application key...\n";
        shell_exec('php artisan key:generate --force');
        echo "✅ Application key generated\n";
    }
}

// Step 5: Set proper permissions
echo "🔒 Setting file permissions...\n";
shell_exec('chmod -R 755 storage');
shell_exec('chmod -R 755 bootstrap/cache');
echo "✅ Permissions set\n";

// Step 6: Clear and optimize caches
echo "🧹 Clearing caches...\n";
shell_exec('php artisan config:clear');
shell_exec('php artisan cache:clear');
shell_exec('php artisan route:clear');
shell_exec('php artisan view:clear');
echo "✅ Caches cleared\n";

// Step 7: Optimize for production
echo "⚡ Optimizing for production...\n";
shell_exec('php artisan config:cache');
shell_exec('php artisan route:cache');
shell_exec('php artisan view:cache');
echo "✅ Optimization complete\n";

// Step 8: Run migrations (if needed)
echo "🗄️  Running database migrations...\n";
shell_exec('php artisan migrate --force');
echo "✅ Database updated\n";

// Step 9: Test database connection
echo "🔍 Testing database connection...\n";
$output = shell_exec('php artisan tinker --execute="DB::connection()->getPdo(); echo \"Database connected successfully\";"');
if (strpos($output, 'Database connected successfully') !== false) {
    echo "✅ Database connection successful\n";
} else {
    echo "⚠️  Database connection test failed\n";
}

echo "\n🎉 Deployment completed!\n";
echo "🌐 Your application should now be accessible at: https://msapt.co.id\n";
echo "\n📋 Post-deployment checklist:\n";
echo "   1. Verify website loads correctly\n";
echo "   2. Test login functionality\n";
echo "   3. Check database operations\n";
echo "   4. Monitor error logs\n";
?>
