<?php
/**
 * Hostinger Auto Setup - MSAPT Laravel Application
 * This ensures the website runs automatically after git deployment
 */

// Setup flag to prevent repeated execution
$setupFlag = __DIR__ . '/../storage/app/hostinger_setup.flag';

if (!file_exists($setupFlag)) {
    try {
        echo "<!-- Hostinger Auto Setup Running -->\n";
        
        // 1. Ensure .env exists with correct configuration
        $envFile = __DIR__ . '/../.env';
        $envHostinger = __DIR__ . '/../.env.hostinger';
        
        if (!file_exists($envFile) && file_exists($envHostinger)) {
            copy($envHostinger, $envFile);
        }
        
        // 2. Create all required directories with proper structure
        $directories = [
            __DIR__ . '/../storage/app/public',
            __DIR__ . '/../storage/framework/cache/data',
            __DIR__ . '/../storage/framework/sessions',
            __DIR__ . '/../storage/framework/views',
            __DIR__ . '/../storage/logs',
            __DIR__ . '/../bootstrap/cache'
        ];
        
        foreach ($directories as $dir) {
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @chmod($dir, 0755);
        }
        
        // 3. Set file permissions for critical files
        $files = [
            __DIR__ . '/../.env' => 0644,
            __DIR__ . '/../artisan' => 0755,
            __DIR__ . '/../public/index.php' => 0644
        ];
        
        foreach ($files as $file => $permission) {
            if (file_exists($file)) {
                @chmod($file, $permission);
            }
        }
        
        // 4. Test database connection
        if (file_exists($envFile)) {
            $env = file_get_contents($envFile);
            preg_match('/DB_HOST=(.*)/', $env, $host);
            preg_match('/DB_DATABASE=(.*)/', $env, $database);
            preg_match('/DB_USERNAME=(.*)/', $env, $username);
            preg_match('/DB_PASSWORD=(.*)/', $env, $password);
            
            $dbHost = trim($host[1] ?? '127.0.0.1');
            $dbName = trim($database[1] ?? '');
            $dbUser = trim($username[1] ?? '');
            $dbPass = trim($password[1] ?? '');
            
            // Test connection
            try {
                $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Create sessions table if not exists
                $pdo->exec("CREATE TABLE IF NOT EXISTS sessions (
                    id VARCHAR(255) PRIMARY KEY,
                    user_id BIGINT UNSIGNED NULL,
                    ip_address VARCHAR(45) NULL,
                    user_agent TEXT NULL,
                    payload LONGTEXT NOT NULL,
                    last_activity INT NOT NULL,
                    INDEX sessions_user_id_index (user_id),
                    INDEX sessions_last_activity_index (last_activity)
                )");
                
                // Create cache table if not exists
                $pdo->exec("CREATE TABLE IF NOT EXISTS cache (
                    `key` VARCHAR(255) PRIMARY KEY,
                    value MEDIUMTEXT NOT NULL,
                    expiration INT NOT NULL,
                    INDEX cache_expiration_index (expiration)
                )");
                
                // Create cache_locks table if not exists
                $pdo->exec("CREATE TABLE IF NOT EXISTS cache_locks (
                    `key` VARCHAR(255) PRIMARY KEY,
                    owner VARCHAR(255) NOT NULL,
                    expiration INT NOT NULL
                )");
                
                // Create jobs table if not exists
                $pdo->exec("CREATE TABLE IF NOT EXISTS jobs (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    queue VARCHAR(255) NOT NULL,
                    payload LONGTEXT NOT NULL,
                    attempts TINYINT UNSIGNED NOT NULL,
                    reserved_at INT UNSIGNED NULL,
                    available_at INT UNSIGNED NOT NULL,
                    created_at INT UNSIGNED NOT NULL,
                    INDEX jobs_queue_index (queue)
                )");
                
                // Create job_batches table if not exists
                $pdo->exec("CREATE TABLE IF NOT EXISTS job_batches (
                    id VARCHAR(255) PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    total_jobs INT NOT NULL,
                    pending_jobs INT NOT NULL,
                    failed_jobs INT NOT NULL,
                    failed_job_ids LONGTEXT NOT NULL,
                    options MEDIUMTEXT NULL,
                    cancelled_at INT NULL,
                    created_at INT NOT NULL,
                    finished_at INT NULL
                )");
                
                // Create failed_jobs table if not exists
                $pdo->exec("CREATE TABLE IF NOT EXISTS failed_jobs (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    uuid VARCHAR(255) UNIQUE NOT NULL,
                    connection TEXT NOT NULL,
                    queue TEXT NOT NULL,
                    payload LONGTEXT NOT NULL,
                    exception LONGTEXT NOT NULL,
                    failed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )");
                
            } catch (PDOException $e) {
                error_log("Database setup error: " . $e->getMessage());
            }
        }
        
        // 5. Mark setup as completed
        file_put_contents($setupFlag, json_encode([
            'setup_time' => date('Y-m-d H:i:s'),
            'database' => $dbName ?? 'unknown',
            'host' => $dbHost ?? 'unknown'
        ]));
        
        echo "<!-- Hostinger Auto Setup Completed -->\n";
        
    } catch (Exception $e) {
        error_log('Hostinger setup error: ' . $e->getMessage());
    }
}
