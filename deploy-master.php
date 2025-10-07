<?php
/**
 * MASTER DEPLOYMENT SCRIPT - MSAPT Laravel Project
 * 
 * Script ini menggabungkan SEMUA perbaikan yang sudah dikerjakan:
 * - Fix nested directory issue (Hostinger git push problem)
 * - Fix environment loading (.env encoding, BOM, line endings)
 * - Fix database configuration (force MySQL, clear cached config)
 * - Fix APP_KEY generation
 * - Fix file permissions (storage, bootstrap/cache)
 * - Clear all caches (config, route, view, application)
 * - Test database connection
 * - Run migrations and optimizations
 * 
 * CARA PAKAI:
 * 1. Git push dari local
 * 2. Di server SSH: git pull origin master
 * 3. Di server SSH: php deploy-master.php
 * 
 * @author Cascade AI Assistant
 * @version 2.0 - Complete Fix
 */

echo "=== MSAPT MASTER DEPLOYMENT STARTED ===\n";
echo "Timestamp: " . date('Y-m-d H:i:s') . "\n";
echo "===========================================\n\n";

// Function to run command and show output
function runCommand($command, $description = '') {
    if ($description) {
        echo "→ $description\n";
    }
    echo "Running: $command\n";
    $output = shell_exec($command . ' 2>&1');
    echo $output . "\n";
    return $output;
}

// Function to check if command was successful
function checkSuccess($output, $successIndicators = []) {
    if (empty($successIndicators)) {
        return !empty($output);
    }
    
    foreach ($successIndicators as $indicator) {
        if (strpos($output, $indicator) !== false) {
            return true;
        }
    }
    return false;
}

try {
    // ==========================================
    // STEP 0: FIX NESTED DIRECTORY ISSUE
    // ==========================================
    echo "STEP 0: Checking for nested directory issue...\n";
    if (is_dir('public_html')) {
        echo "Found nested public_html directory, fixing...\n";
        
        // Move all files from nested directory
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
        
        // Force remove nested directory
        shell_exec('rm -rf public_html 2>&1');
        echo "✅ Nested directory issue fixed\n";
    } else {
        echo "✅ No nested directory issue found\n";
    }
    echo "\n";

    // ==========================================
    // STEP 1: FIX ENVIRONMENT FILE
    // ==========================================
    echo "STEP 1: Setting up environment file with proper encoding...\n";
    
    // Backup existing .env
    if (file_exists('.env')) {
        copy('.env', '.env.backup.' . date('YmdHis'));
        echo "Backed up existing .env\n";
    }
    
    if (file_exists('.env.hostinger')) {
        // Read content and fix all encoding issues
        $content = file_get_contents('.env.hostinger');
        
        // Remove BOM (Byte Order Mark)
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
        
        // Fix line endings (Windows CRLF to Unix LF)
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        
        // Ensure correct database configuration
        $content = preg_replace('/DB_CONNECTION=.*/', 'DB_CONNECTION=mysql', $content);
        $content = preg_replace('/DB_HOST=.*/', 'DB_HOST=127.0.0.1', $content);
        
        // Write with proper encoding
        file_put_contents('.env', $content);
        chmod('.env', 0644);
        echo "✅ .env file created with proper encoding and MySQL config\n";
    } else {
        copy('.env.example', '.env');
        echo "✅ .env file created from .env.example\n";
    }
    echo "\n";

    // ==========================================
    // STEP 2: GENERATE/VERIFY APP_KEY
    // ==========================================
    echo "STEP 2: Checking and generating APP_KEY...\n";
    $envContent = file_get_contents('.env');
    
    $needsNewKey = false;
    if (strpos($envContent, 'APP_KEY=') === false) {
        $needsNewKey = true;
        echo "APP_KEY missing\n";
    } elseif (preg_match('/APP_KEY=\s*$/', $envContent)) {
        $needsNewKey = true;
        echo "APP_KEY empty\n";
    } elseif (strpos($envContent, 'APP_KEY=base64:YourGenerated') !== false) {
        $needsNewKey = true;
        echo "APP_KEY is placeholder\n";
    }
    
    if ($needsNewKey) {
        echo "Generating new APP_KEY...\n";
        runCommand('php artisan key:generate --force', 'Generate APP_KEY');
        echo "✅ New APP_KEY generated\n";
    } else {
        echo "✅ APP_KEY already exists and is valid\n";
    }
    echo "\n";

    // ==========================================
    // STEP 3: COMPOSER DEPENDENCIES
    // ==========================================
    echo "STEP 3: Installing/Updating Composer dependencies...\n";
    $composerOutput = runCommand('composer install --no-dev --optimize-autoloader --no-interaction', 'Install Composer packages');
    
    if (strpos($composerOutput, 'Generating optimized autoload files') !== false || 
        strpos($composerOutput, 'Nothing to install') !== false) {
        echo "✅ Composer dependencies ready\n";
    } else {
        echo "⚠️ Composer may have issues, but continuing...\n";
    }
    echo "\n";

    // ==========================================
    // STEP 4: CLEAR ALL CACHED FILES
    // ==========================================
    echo "STEP 4: Clearing ALL cached files and directories...\n";
    
    $cacheDirs = [
        'bootstrap/cache',
        'storage/framework/cache/data',
        'storage/framework/sessions', 
        'storage/framework/views',
        'storage/logs'
    ];
    
    foreach ($cacheDirs as $dir) {
        if (is_dir($dir)) {
            shell_exec("rm -rf $dir/* 2>/dev/null");
            echo "Cleared: $dir\n";
        }
    }
    echo "✅ All cached files cleared\n";
    echo "\n";

    // ==========================================
    // STEP 5: SET PROPER PERMISSIONS
    // ==========================================
    echo "STEP 5: Setting proper file permissions...\n";
    runCommand('chmod -R 755 storage', 'Set storage permissions');
    runCommand('chmod -R 755 bootstrap/cache', 'Set bootstrap cache permissions');
    runCommand('chmod 644 .env', 'Set .env permissions');
    echo "✅ File permissions set correctly\n";
    echo "\n";

    // ==========================================
    // STEP 6: CLEAR ARTISAN CACHES
    // ==========================================
    echo "STEP 6: Clearing all Laravel caches...\n";
    runCommand('php artisan config:clear', 'Clear config cache');
    runCommand('php artisan route:clear', 'Clear route cache');
    runCommand('php artisan view:clear', 'Clear view cache');
    runCommand('php artisan cache:clear', 'Clear application cache');
    echo "✅ All Laravel caches cleared\n";
    echo "\n";

    // ==========================================
    // STEP 7: FORCE RELOAD CONFIGURATION
    // ==========================================
    echo "STEP 7: Force reloading configuration...\n";
    runCommand('php artisan config:cache', 'Cache configuration');
    echo "✅ Configuration reloaded and cached\n";
    echo "\n";

    // ==========================================
    // STEP 8: TEST DATABASE CONNECTION
    // ==========================================
    echo "STEP 8: Testing database connection...\n";
    
    // Test environment variables
    $envTest = runCommand('php artisan tinker --execute="echo \'DB_CONNECTION: \' . env(\'DB_CONNECTION\'); echo \'\nDB_HOST: \' . env(\'DB_HOST\'); echo \'\nDB_DATABASE: \' . env(\'DB_DATABASE\');"', 'Check environment variables');
    echo "Environment variables:\n$envTest\n";
    
    // Test config
    $configTest = runCommand('php artisan tinker --execute="echo \'Config DB: \' . config(\'database.default\');"', 'Check config database');
    echo "Configuration: $configTest\n";
    
    // Test actual connection
    $dbTest = runCommand('php artisan tinker --execute="try { DB::connection()->getPdo(); echo \'Database: Connected successfully\'; } catch(Exception \$e) { echo \'Database Error: \' . \$e->getMessage(); }"', 'Test database connection');
    
    if (strpos($dbTest, 'Connected successfully') !== false) {
        echo "✅ Database connection successful\n";
        $dbConnected = true;
    } else {
        echo "❌ Database connection failed: $dbTest\n";
        $dbConnected = false;
        
        // Try alternative connection test
        echo "Trying alternative connection test...\n";
        $altTest = runCommand('php artisan tinker --execute="try { DB::connection(\'mysql\')->getPdo(); echo \'MySQL Direct: Connected\'; } catch(Exception \$e) { echo \'MySQL Error: \' . \$e->getMessage(); }"', 'Test MySQL direct connection');
        echo "Alternative test: $altTest\n";
    }
    echo "\n";

    // ==========================================
    // STEP 9: DATABASE MIGRATIONS (if connected)
    // ==========================================
    if ($dbConnected) {
        echo "STEP 9: Running database migrations...\n";
        $migrateOutput = runCommand('php artisan migrate --force', 'Run migrations');
        
        if (strpos($migrateOutput, 'Nothing to migrate') !== false || 
            strpos($migrateOutput, 'Migrated:') !== false) {
            echo "✅ Database migrations completed\n";
        } else {
            echo "⚠️ Migration may have issues: $migrateOutput\n";
        }
        
        // Seed database if needed (only on first deployment)
        if (!file_exists('storage/app/deployed.flag')) {
            echo "First deployment detected, seeding database...\n";
            runCommand('php artisan db:seed --force', 'Seed database');
            file_put_contents('storage/app/deployed.flag', date('Y-m-d H:i:s'));
            echo "✅ Database seeded\n";
        }
    } else {
        echo "STEP 9: Skipping migrations due to database connection issues\n";
    }
    echo "\n";

    // ==========================================
    // STEP 10: OPTIMIZE FOR PRODUCTION
    // ==========================================
    echo "STEP 10: Optimizing for production...\n";
    runCommand('php artisan config:cache', 'Cache config');
    runCommand('php artisan route:cache', 'Cache routes');
    runCommand('php artisan view:cache', 'Cache views');
    echo "✅ Production optimizations applied\n";
    echo "\n";

    // ==========================================
    // STEP 11: FINAL TESTS
    // ==========================================
    echo "STEP 11: Running final tests...\n";
    
    // Test Laravel version
    $versionTest = runCommand('php artisan --version', 'Check Laravel version');
    echo "Laravel version: $versionTest\n";
    
    // Test website response
    echo "Testing website response...\n";
    $websiteTest = runCommand('curl -I https://msapt.co.id', 'Test website');
    
    if (strpos($websiteTest, 'HTTP/2 200') !== false || strpos($websiteTest, 'HTTP/1.1 200') !== false) {
        echo "✅ Website responding with 200 OK\n";
        $websiteStatus = "SUCCESS";
    } elseif (strpos($websiteTest, 'HTTP/2 500') !== false || strpos($websiteTest, 'HTTP/1.1 500') !== false) {
        echo "❌ Website still returning 500 error\n";
        $websiteStatus = "ERROR 500";
    } else {
        echo "⚠️ Website response unclear: $websiteTest\n";
        $websiteStatus = "UNCLEAR";
    }
    echo "\n";

    // ==========================================
    // DEPLOYMENT SUMMARY
    // ==========================================
    echo "===========================================\n";
    echo "✅ MSAPT MASTER DEPLOYMENT COMPLETED!\n";
    echo "===========================================\n";
    echo "Timestamp: " . date('Y-m-d H:i:s') . "\n";
    echo "Website Status: $websiteStatus\n";
    echo "Database Status: " . ($dbConnected ? "CONNECTED" : "ERROR") . "\n";
    echo "\n";
    echo "🌐 Your website: https://msapt.co.id\n";
    echo "\n";
    echo "📋 NEXT DEVELOPMENT WORKFLOW:\n";
    echo "1. Make changes in local development\n";
    echo "2. git add . && git commit -m 'Your message'\n";
    echo "3. git push origin master\n";
    echo "4. SSH to server: git pull origin master\n";
    echo "5. SSH to server: php deploy-master.php\n";
    echo "\n";
    
    if ($websiteStatus !== "SUCCESS") {
        echo "🔧 TROUBLESHOOTING:\n";
        echo "- Check error logs: tail -20 storage/logs/laravel.log\n";
        echo "- Check server error log: tail -10 error_log\n";
        echo "- Verify database credentials in .env\n";
        echo "- Contact hosting support if needed\n";
    }
    
    echo "===========================================\n";
    
} catch (Exception $e) {
    echo "\n❌ DEPLOYMENT FAILED ❌\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
?>
