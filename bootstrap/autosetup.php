<?php
/**
 * Auto Setup for MSAPT Laravel Application
 * This will run automatically on first access to setup the application
 */

// Check if setup is needed
$setupFlag = __DIR__ . '/../storage/app/setup_completed.flag';

if (!file_exists($setupFlag)) {
    try {
        // Ensure .env exists
        $envFile = __DIR__ . '/../.env';
        $envHostinger = __DIR__ . '/../.env.hostinger';
        
        if (!file_exists($envFile) && file_exists($envHostinger)) {
            copy($envHostinger, $envFile);
        }
        
        // Create required directories
        $directories = [
            __DIR__ . '/../storage/app',
            __DIR__ . '/../storage/framework/cache',
            __DIR__ . '/../storage/framework/sessions',
            __DIR__ . '/../storage/framework/views',
            __DIR__ . '/../storage/logs',
            __DIR__ . '/../bootstrap/cache'
        ];
        
        foreach ($directories as $dir) {
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
        }
        
        // Set permissions (if possible)
        @chmod(__DIR__ . '/../storage', 0755);
        @chmod(__DIR__ . '/../bootstrap/cache', 0755);
        
        // Mark setup as completed
        file_put_contents($setupFlag, date('Y-m-d H:i:s'));
        
    } catch (Exception $e) {
        // Log error but don't break the application
        error_log('Auto setup error: ' . $e->getMessage());
    }
}
