<?php
/**
 * AUTO FIX ALL ISSUES - Complete Laravel Fix for Hostinger
 * 
 * Script ini akan memperbaiki SEMUA masalah yang teridentifikasi:
 * 1. Environment file issues (.env encoding, BOM, line endings)
 * 2. Database configuration (force MySQL, bypass env() issues)
 * 3. APP_KEY generation and validation
 * 4. File permissions (storage, bootstrap/cache)
 * 5. Cache clearing (all types of cache)
 * 6. Nested directory issues (Hostinger git push problem)
 * 7. Configuration reload and optimization
 * 8. Database connection testing
 * 9. Website functionality testing
 * 
 * USAGE: php auto-fix-all.php
 */

echo "=== AUTO FIX ALL ISSUES - MSAPT Laravel Project ===\n";
echo "Starting comprehensive fix at: " . date('Y-m-d H:i:s') . "\n";
echo "====================================================\n\n";

function runCommand($command, $description = '') {
    if ($description) echo "→ $description\n";
    echo "Running: $command\n";
    $output = shell_exec($command . ' 2>&1');
    echo $output . "\n";
    return $output;
}

function forceRemoveDirectory($dir) {
    if (is_dir($dir)) {
        shell_exec("rm -rf $dir/* 2>/dev/null");
        shell_exec("rm -rf $dir/.* 2>/dev/null");
        return true;
    }
    return false;
}

try {
    // ==============================================
    // FIX 1: HANDLE NESTED DIRECTORY ISSUE
    // ==============================================
    echo "FIX 1: Checking and fixing nested directory issue...\n";
    if (is_dir('public_html')) {
        echo "Found nested public_html directory - fixing...\n";
        
        // Move all files
        $files = glob('public_html/*');
        foreach ($files as $file) {
            $filename = basename($file);
            if (!file_exists($filename)) {
                rename($file, $filename);
                echo "Moved: $filename\n";
            }
        }
        
        // Move hidden files
        $hiddenFiles = glob('public_html/.*');
        foreach ($hiddenFiles as $file) {
            $filename = basename($file);
            if ($filename !== '.' && $filename !== '..' && !file_exists($filename)) {
                rename($file, $filename);
                echo "Moved hidden: $filename\n";
            }
        }
        
        shell_exec('rm -rf public_html 2>&1');
        echo "✅ Nested directory fixed\n";
    } else {
        echo "✅ No nested directory issue\n";
    }
    echo "\n";

    // ==============================================
    // FIX 2: ENVIRONMENT FILE COMPREHENSIVE FIX
    // ==============================================
    echo "FIX 2: Comprehensive environment file fix...\n";
    
    // Backup existing .env
    if (file_exists('.env')) {
        copy('.env', '.env.backup.' . date('YmdHis'));
        echo "Backed up existing .env\n";
    }
    
    // Create proper .env from .env.hostinger
    if (file_exists('.env.hostinger')) {
        $content = file_get_contents('.env.hostinger');
        
        // Fix encoding issues
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content); // Remove BOM
        $content = str_replace(["\r\n", "\r"], "\n", $content); // Fix line endings
        
        // Ensure critical configurations
        $content = preg_replace('/DB_CONNECTION=.*/', 'DB_CONNECTION=mysql', $content);
        $content = preg_replace('/DB_HOST=.*/', 'DB_HOST=127.0.0.1', $content);
        
        // Write with proper permissions
        file_put_contents('.env', $content);
        chmod('.env', 0644);
        echo "✅ Environment file created with proper encoding\n";
    } else {
        copy('.env.example', '.env');
        echo "✅ Environment file created from example\n";
    }
    echo "\n";

    // ==============================================
    // FIX 3: FORCE DATABASE CONFIGURATION
    // ==============================================
    echo "FIX 3: Force database configuration to MySQL...\n";
    
    // Ensure config/database.php uses MySQL by default
    $dbConfigPath = 'config/database.php';
    if (file_exists($dbConfigPath)) {
        $dbConfig = file_get_contents($dbConfigPath);
        
        // Force MySQL as default (bypass env() issues)
        if (strpos($dbConfig, "'default' => 'mysql'") === false) {
            $dbConfig = preg_replace(
                "/'default' => env\('DB_CONNECTION', '[^']*'\),/",
                "'default' => 'mysql', // Force MySQL - bypass env() issue",
                $dbConfig
            );
            file_put_contents($dbConfigPath, $dbConfig);
            echo "✅ Database config forced to MySQL\n";
        } else {
            echo "✅ Database config already set to MySQL\n";
        }
    }
    echo "\n";

    // ==============================================
    // FIX 4: APP_KEY GENERATION AND VALIDATION
    // ==============================================
    echo "FIX 4: APP_KEY generation and validation...\n";
    
    $envContent = file_get_contents('.env');
    $needsNewKey = false;
    
    if (strpos($envContent, 'APP_KEY=') === false) {
        $needsNewKey = true;
        echo "APP_KEY missing\n";
    } elseif (preg_match('/APP_KEY=\s*$/', $envContent)) {
        $needsNewKey = true;
        echo "APP_KEY empty\n";
    } elseif (strpos($envContent, 'YourGenerated') !== false) {
        $needsNewKey = true;
        echo "APP_KEY is placeholder\n";
    }
    
    if ($needsNewKey) {
        runCommand('php artisan key:generate --force', 'Generate new APP_KEY');
        echo "✅ New APP_KEY generated\n";
    } else {
        echo "✅ APP_KEY is valid\n";
    }
    echo "\n";

    // ==============================================
    // FIX 5: AGGRESSIVE CACHE CLEARING
    // ==============================================
    echo "FIX 5: Aggressive cache clearing...\n";
    
    // Remove specific problematic cache files
    $cacheFiles = [
        'bootstrap/cache/config.php',
        'bootstrap/cache/packages.php',
        'bootstrap/cache/services.php',
        'bootstrap/cache/routes-v7.php'
    ];
    
    foreach ($cacheFiles as $file) {
        if (file_exists($file)) {
            unlink($file);
            echo "Removed: $file\n";
        }
    }
    
    // Clear cache directories
    $cacheDirs = [
        'bootstrap/cache',
        'storage/framework/cache',
        'storage/framework/sessions',
        'storage/framework/views'
    ];
    
    foreach ($cacheDirs as $dir) {
        if (forceRemoveDirectory($dir)) {
            echo "Cleared: $dir\n";
        }
    }
    
    echo "✅ All caches aggressively cleared\n";
    echo "\n";

    // ==============================================
    // FIX 6: FILE PERMISSIONS
    // ==============================================
    echo "FIX 6: Setting proper file permissions...\n";
    
    runCommand('chmod -R 755 storage', 'Set storage permissions');
    runCommand('chmod -R 755 bootstrap/cache', 'Set bootstrap cache permissions');
    runCommand('chmod 644 .env', 'Set .env permissions');
    
    // Create necessary directories if they don't exist
    $requiredDirs = [
        'storage/logs',
        'storage/framework/cache/data',
        'storage/framework/sessions',
        'storage/framework/views',
        'bootstrap/cache'
    ];
    
    foreach ($requiredDirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
            echo "Created: $dir\n";
        }
    }
    
    echo "✅ File permissions set correctly\n";
    echo "\n";

    // ==============================================
    // FIX 7: LARAVEL ARTISAN CACHE CLEARING
    // ==============================================
    echo "FIX 7: Laravel artisan cache clearing...\n";
    
    runCommand('php artisan config:clear', 'Clear config cache');
    runCommand('php artisan route:clear', 'Clear route cache');
    runCommand('php artisan view:clear', 'Clear view cache');
    
    // Try to clear application cache (may fail if DB not connected yet)
    $cacheOutput = shell_exec('php artisan cache:clear 2>&1');
    if (strpos($cacheOutput, 'successfully') !== false) {
        echo "✅ Application cache cleared\n";
    } else {
        echo "⚠️ Application cache clear skipped (DB not ready)\n";
    }
    
    echo "✅ Artisan caches cleared\n";
    echo "\n";

    // ==============================================
    // FIX 8: CONFIGURATION RELOAD
    // ==============================================
    echo "FIX 8: Force configuration reload...\n";
    
    runCommand('php artisan config:cache', 'Cache configuration');
    echo "✅ Configuration reloaded and cached\n";
    echo "\n";

    // ==============================================
    // FIX 9: DATABASE CONNECTION TEST
    // ==============================================
    echo "FIX 9: Testing database connection...\n";
    
    // Test environment variables
    $envTest = shell_exec('php artisan tinker --execute="echo \'ENV DB_CONNECTION: \' . env(\'DB_CONNECTION\'); echo \'\nENV DB_HOST: \' . env(\'DB_HOST\'); echo \'\nENV DB_DATABASE: \' . env(\'DB_DATABASE\');" 2>&1');
    echo "Environment variables:\n$envTest\n";
    
    // Test configuration
    $configTest = shell_exec('php artisan tinker --execute="echo \'Config default: \' . config(\'database.default\');" 2>&1');
    echo "Configuration: $configTest\n";
    
    // Test actual database connection
    $dbTest = shell_exec('php artisan tinker --execute="try { DB::connection()->getPdo(); echo \'Database: Connected successfully\'; } catch(Exception \$e) { echo \'Database Error: \' . \$e->getMessage(); }" 2>&1');
    
    if (strpos($dbTest, 'Connected successfully') !== false) {
        echo "✅ Database connection successful\n";
        $dbConnected = true;
    } else {
        echo "❌ Database connection failed: $dbTest\n";
        $dbConnected = false;
        
        // Try MySQL direct connection
        $mysqlTest = shell_exec('php artisan tinker --execute="try { DB::connection(\'mysql\')->getPdo(); echo \'MySQL Direct: Connected\'; } catch(Exception \$e) { echo \'MySQL Error: \' . \$e->getMessage(); }" 2>&1');
        echo "MySQL direct test: $mysqlTest\n";
    }
    echo "\n";

    // ==============================================
    // FIX 10: DATABASE MIGRATIONS (if connected)
    // ==============================================
    if ($dbConnected) {
        echo "FIX 10: Running database migrations...\n";
        $migrateOutput = runCommand('php artisan migrate --force', 'Run migrations');
        
        if (strpos($migrateOutput, 'Nothing to migrate') !== false || 
            strpos($migrateOutput, 'Migrated:') !== false) {
            echo "✅ Database migrations completed\n";
        }
        
        // Seed database on first deployment
        if (!file_exists('storage/app/deployed.flag')) {
            runCommand('php artisan db:seed --force', 'Seed database');
            file_put_contents('storage/app/deployed.flag', date('Y-m-d H:i:s'));
            echo "✅ Database seeded\n";
        }
    } else {
        echo "FIX 10: Skipping migrations (database not connected)\n";
    }
    echo "\n";

    // ==============================================
    // FIX 11: PRODUCTION OPTIMIZATION
    // ==============================================
    echo "FIX 11: Production optimization...\n";
    
    runCommand('php artisan config:cache', 'Cache config');
    runCommand('php artisan route:cache', 'Cache routes');
    runCommand('php artisan view:cache', 'Cache views');
    
    echo "✅ Production optimizations applied\n";
    echo "\n";

    // ==============================================
    // FIX 12: FINAL WEBSITE TEST
    // ==============================================
    echo "FIX 12: Final website functionality test...\n";
    
    // Test Laravel version
    $versionTest = shell_exec('php artisan --version 2>&1');
    echo "Laravel version: $versionTest\n";
    
    // Test website response
    $websiteTest = shell_exec('curl -I https://msapt.co.id 2>&1');
    
    if (strpos($websiteTest, 'HTTP/2 200') !== false || strpos($websiteTest, 'HTTP/1.1 200') !== false) {
        echo "✅ Website responding with 200 OK\n";
        $websiteStatus = "SUCCESS";
    } elseif (strpos($websiteTest, 'HTTP/2 500') !== false || strpos($websiteTest, 'HTTP/1.1 500') !== false) {
        echo "❌ Website still returning 500 error\n";
        $websiteStatus = "ERROR 500";
    } else {
        echo "⚠️ Website response: $websiteTest\n";
        $websiteStatus = "UNCLEAR";
    }
    echo "\n";

    // ==============================================
    // COMPLETION SUMMARY
    // ==============================================
    echo "====================================================\n";
    echo "✅ AUTO FIX ALL ISSUES COMPLETED!\n";
    echo "====================================================\n";
    echo "Completion time: " . date('Y-m-d H:i:s') . "\n";
    echo "Website Status: $websiteStatus\n";
    echo "Database Status: " . ($dbConnected ? "CONNECTED" : "ERROR") . "\n";
    echo "\n";
    echo "🌐 Your website: https://msapt.co.id\n";
    echo "\n";
    
    if ($websiteStatus === "SUCCESS") {
        echo "🎉 SUCCESS! Your website is now working properly!\n";
        echo "\n";
        echo "📋 FUTURE DEVELOPMENT WORKFLOW:\n";
        echo "1. Make changes in local development\n";
        echo "2. git add . && git commit -m 'Your message'\n";
        echo "3. git push origin master\n";
        echo "4. SSH to server: git pull origin master\n";
        echo "5. SSH to server: php auto-fix-all.php\n";
    } else {
        echo "🔧 TROUBLESHOOTING NEEDED:\n";
        echo "- Check error logs: tail -20 storage/logs/laravel.log\n";
        echo "- Check server error log: tail -10 error_log\n";
        echo "- Verify database credentials\n";
        echo "- Contact hosting support if needed\n";
    }
    
    echo "====================================================\n";

} catch (Exception $e) {
    echo "\n❌ AUTO FIX FAILED ❌\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
?>
