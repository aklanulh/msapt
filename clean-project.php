<?php
/**
 * MSAPT - Clean Project Script
 * Script sederhana untuk membersihkan file yang tidak diperlukan
 */

echo "=== Membersihkan Project MSAPT ===\n";

// 1. Clear Laravel caches
echo "1. Membersihkan cache Laravel...\n";
if (file_exists('artisan')) {
    $commands = [
        'php artisan config:clear',
        'php artisan route:clear', 
        'php artisan view:clear',
        'php artisan cache:clear'
    ];
    
    foreach ($commands as $cmd) {
        echo "   Menjalankan: $cmd\n";
        shell_exec($cmd . ' 2>&1');
    }
    echo "   ✅ Cache Laravel dibersihkan\n";
}

// 2. Hapus file cache
echo "\n2. Menghapus file cache...\n";
$cacheFiles = [
    'bootstrap/cache/config.php',
    'bootstrap/cache/routes-v7.php',
    'bootstrap/cache/events.php'
];

foreach ($cacheFiles as $file) {
    if (file_exists($file)) {
        unlink($file);
        echo "   Dihapus: $file\n";
    }
}

// 3. Bersihkan storage
echo "\n3. Membersihkan storage...\n";
$storageDirs = [
    'storage/framework/cache/data',
    'storage/framework/sessions', 
    'storage/framework/views'
];

foreach ($storageDirs as $dir) {
    if (is_dir($dir)) {
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        echo "   Dibersihkan: $dir (" . count($files) . " files)\n";
    }
}

// 4. Hapus log files (opsional)
echo "\n4. Membersihkan log files...\n";
if (file_exists('storage/logs/laravel.log')) {
    // Backup log terakhir
    $logContent = file_get_contents('storage/logs/laravel.log');
    $lines = explode("\n", $logContent);
    $lastLines = array_slice($lines, -50); // Keep last 50 lines
    
    file_put_contents('storage/logs/laravel.log', implode("\n", $lastLines));
    echo "   ✅ Log file dipangkas (50 baris terakhir disimpan)\n";
}

// 5. Set permissions
echo "\n5. Mengatur permissions...\n";
if (PHP_OS_FAMILY === 'Windows') {
    echo "   ℹ️  Windows detected - skipping chmod\n";
} else {
    shell_exec('chmod -R 755 storage 2>/dev/null');
    shell_exec('chmod -R 755 bootstrap/cache 2>/dev/null');
    echo "   ✅ Permissions diatur\n";
}

echo "\n=== Pembersihan Selesai ===\n";
echo "✅ Project sudah bersih dan siap untuk deployment\n";
?>
