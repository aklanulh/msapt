<?php
echo "<h1>Debug Info</h1>";

// 1. PHP Version
echo "<h2>PHP Version</h2>";
echo "PHP Version: " . phpversion() . "<br>";

// 2. Check if files exist
echo "<h2>File Check</h2>";
echo ".env exists: " . (file_exists('.env') ? 'YES' : 'NO') . "<br>";
echo "vendor/autoload.php exists: " . (file_exists('vendor/autoload.php') ? 'YES' : 'NO') . "<br>";
echo "bootstrap/app.php exists: " . (file_exists('bootstrap/app.php') ? 'YES' : 'NO') . "<br>";

// 3. Check Laravel
echo "<h2>Laravel Check</h2>";
if (file_exists('vendor/autoload.php')) {
    try {
        require 'vendor/autoload.php';
        echo "Autoload: OK<br>";
        
        if (file_exists('bootstrap/app.php')) {
            $app = require 'bootstrap/app.php';
            echo "Bootstrap: OK<br>";
        } else {
            echo "Bootstrap: MISSING<br>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
} else {
    echo "Vendor autoload missing!<br>";
}

// 4. Check .env
echo "<h2>.env Content</h2>";
if (file_exists('.env')) {
    $env = file_get_contents('.env');
    $lines = explode("\n", $env);
    foreach ($lines as $line) {
        if (strpos($line, 'APP_KEY=') === 0) {
            echo "APP_KEY: " . (strlen(trim(substr($line, 8))) > 0 ? 'SET' : 'EMPTY') . "<br>";
        }
        if (strpos($line, 'DB_') === 0) {
            echo htmlspecialchars($line) . "<br>";
        }
    }
} else {
    echo ".env file not found!<br>";
}

// 5. Directory permissions
echo "<h2>Directory Permissions</h2>";
echo "storage writable: " . (is_writable('storage') ? 'YES' : 'NO') . "<br>";
echo "bootstrap/cache writable: " . (is_writable('bootstrap/cache') ? 'YES' : 'NO') . "<br>";

phpinfo();
?>
