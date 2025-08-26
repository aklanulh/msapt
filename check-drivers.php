<?php

echo "=== PHP PDO DRIVER CHECK ===\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Available PDO drivers: " . implode(', ', PDO::getAvailableDrivers()) . "\n";

echo "\nChecking specific drivers:\n";
echo "- MySQL (pdo_mysql): " . (extension_loaded('pdo_mysql') ? 'AVAILABLE' : 'NOT AVAILABLE') . "\n";
echo "- PostgreSQL (pdo_pgsql): " . (extension_loaded('pdo_pgsql') ? 'AVAILABLE' : 'NOT AVAILABLE') . "\n";
echo "- SQLite (pdo_sqlite): " . (extension_loaded('pdo_sqlite') ? 'AVAILABLE' : 'NOT AVAILABLE') . "\n";

echo "\nAll loaded extensions:\n";
$extensions = get_loaded_extensions();
sort($extensions);
foreach ($extensions as $ext) {
    if (strpos($ext, 'pdo') !== false || strpos($ext, 'mysql') !== false || strpos($ext, 'pgsql') !== false) {
        echo "- " . $ext . "\n";
    }
}

echo "\n=== END CHECK ===\n";
