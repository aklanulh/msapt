<?php
/**
 * MSAPT - Database Backup Script
 * Script untuk backup database secara otomatis
 */

echo "=== MSAPT Database Backup Started ===\n";

// Load environment variables
if (file_exists('.env')) {
    $env = file_get_contents('.env');
    preg_match('/DB_HOST=(.*)/', $env, $host);
    preg_match('/DB_DATABASE=(.*)/', $env, $database);
    preg_match('/DB_USERNAME=(.*)/', $env, $username);
    preg_match('/DB_PASSWORD=(.*)/', $env, $password);
    
    $dbHost = trim($host[1] ?? 'localhost');
    $dbName = trim($database[1] ?? '');
    $dbUser = trim($username[1] ?? '');
    $dbPass = trim($password[1] ?? '');
} else {
    echo "Error: .env file not found\n";
    exit(1);
}

// Create backup directory if not exists
$backupDir = 'storage/backups';
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
    echo "Created backup directory: $backupDir\n";
}

// Generate backup filename
$timestamp = date('Y-m-d_H-i-s');
$backupFile = "$backupDir/msapt_backup_$timestamp.sql";

// Create database backup
echo "Creating database backup...\n";
echo "Database: $dbName\n";
echo "Backup file: $backupFile\n";

$command = "mysqldump -h $dbHost -u $dbUser -p$dbPass $dbName > $backupFile";
$output = shell_exec($command . ' 2>&1');

if (file_exists($backupFile) && filesize($backupFile) > 0) {
    echo "✅ Backup created successfully!\n";
    echo "File size: " . formatBytes(filesize($backupFile)) . "\n";
    
    // Keep only last 10 backups
    $backups = glob("$backupDir/msapt_backup_*.sql");
    if (count($backups) > 10) {
        // Sort by modification time
        usort($backups, function($a, $b) {
            return filemtime($a) - filemtime($b);
        });
        
        // Delete oldest backups
        $toDelete = array_slice($backups, 0, count($backups) - 10);
        foreach ($toDelete as $file) {
            unlink($file);
            echo "Deleted old backup: " . basename($file) . "\n";
        }
    }
    
} else {
    echo "❌ Backup failed!\n";
    if ($output) {
        echo "Error: $output\n";
    }
    exit(1);
}

echo "=== Backup Completed Successfully ===\n";

function formatBytes($size, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
        $size /= 1024;
    }
    
    return round($size, $precision) . ' ' . $units[$i];
}
?>
