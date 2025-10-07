<?php
/**
 * Fix Environment Loading Issue
 * Script untuk memperbaiki masalah .env tidak terbaca
 */

echo "=== Fixing Environment Loading Issue ===\n";

try {
    // 1. Backup current .env
    if (file_exists('.env')) {
        copy('.env', '.env.backup');
        echo "✅ .env backed up\n";
    }
    
    // 2. Recreate .env from .env.hostinger with proper encoding
    if (file_exists('.env.hostinger')) {
        $content = file_get_contents('.env.hostinger');
        
        // Remove any BOM or hidden characters
        $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
        
        // Ensure Unix line endings
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        
        // Write with proper encoding
        file_put_contents('.env', $content);
        echo "✅ .env recreated with proper encoding\n";
    }
    
    // 3. Verify critical environment variables
    $envContent = file_get_contents('.env');
    $requiredVars = ['APP_NAME', 'APP_KEY', 'DB_CONNECTION', 'DB_HOST', 'DB_DATABASE'];
    
    foreach ($requiredVars as $var) {
        if (strpos($envContent, $var . '=') !== false) {
            echo "✅ $var found\n";
        } else {
            echo "❌ $var missing\n";
        }
    }
    
    // 4. Set proper file permissions
    chmod('.env', 0644);
    echo "✅ .env permissions set\n";
    
    echo "\n=== Environment Fix Completed ===\n";
    echo "Run: php artisan config:clear && php artisan config:cache\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
