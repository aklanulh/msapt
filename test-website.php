<?php
/**
 * MSAPT - Website Test Script
 * Jalankan ini setelah upload untuk memastikan website berjalan dengan baik
 */

echo "<h1>🧪 MSAPT Website Test</h1>";
echo "<style>body{font-family:Arial;margin:20px;} .success{color:green;} .error{color:red;} .info{color:blue;}</style>";

// Test 1: PHP Version
echo "<h2>1. PHP Version Test</h2>";
$phpVersion = phpversion();
if (version_compare($phpVersion, '8.2', '>=')) {
    echo "<p class='success'>✅ PHP Version: $phpVersion (OK)</p>";
} else {
    echo "<p class='error'>❌ PHP Version: $phpVersion (Butuh PHP 8.2+)</p>";
}

// Test 2: Laravel Files
echo "<h2>2. Laravel Files Test</h2>";
$requiredFiles = [
    'artisan' => 'Laravel Artisan',
    'composer.json' => 'Composer Config',
    '.env' => 'Environment File',
    'app/Models/User.php' => 'User Model',
    'public/index.php' => 'Public Index'
];

foreach ($requiredFiles as $file => $name) {
    if (file_exists($file)) {
        echo "<p class='success'>✅ $name: Found</p>";
    } else {
        echo "<p class='error'>❌ $name: Missing ($file)</p>";
    }
}

// Test 3: Directory Permissions
echo "<h2>3. Directory Permissions Test</h2>";
$directories = [
    'storage' => 'Storage Directory',
    'bootstrap/cache' => 'Bootstrap Cache',
    'storage/logs' => 'Log Directory'
];

foreach ($directories as $dir => $name) {
    if (is_dir($dir)) {
        $perms = substr(sprintf('%o', fileperms($dir)), -3);
        if ($perms >= '755') {
            echo "<p class='success'>✅ $name: $perms (OK)</p>";
        } else {
            echo "<p class='error'>❌ $name: $perms (Butuh 755+)</p>";
        }
    } else {
        echo "<p class='error'>❌ $name: Directory not found</p>";
    }
}

// Test 4: Environment Variables
echo "<h2>4. Environment Test</h2>";
if (file_exists('.env')) {
    $envContent = file_get_contents('.env');
    
    // Check APP_KEY
    if (strpos($envContent, 'APP_KEY=base64:') !== false) {
        echo "<p class='success'>✅ APP_KEY: Set</p>";
    } else {
        echo "<p class='error'>❌ APP_KEY: Not generated</p>";
    }
    
    // Check Database
    if (strpos($envContent, 'DB_DATABASE=u919556019_msapt_db') !== false) {
        echo "<p class='success'>✅ Database Config: OK</p>";
    } else {
        echo "<p class='error'>❌ Database Config: Check .env file</p>";
    }
} else {
    echo "<p class='error'>❌ .env file not found</p>";
}

// Test 5: Database Connection
echo "<h2>5. Database Connection Test</h2>";
try {
    if (file_exists('.env')) {
        // Load environment
        $env = parse_ini_file('.env');
        if ($env) {
            $host = $env['DB_HOST'] ?? 'localhost';
            $dbname = $env['DB_DATABASE'] ?? '';
            $username = $env['DB_USERNAME'] ?? '';
            $password = $env['DB_PASSWORD'] ?? '';
            
            if ($dbname && $username) {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                echo "<p class='success'>✅ Database Connection: OK</p>";
            } else {
                echo "<p class='error'>❌ Database credentials missing</p>";
            }
        }
    }
} catch (Exception $e) {
    echo "<p class='error'>❌ Database Connection: " . $e->getMessage() . "</p>";
}

// Next Steps
echo "<h2>🎯 Next Steps</h2>";
echo "<p class='info'>1. Jika semua test ✅, jalankan: <strong>setup-hostinger.php</strong></p>";
echo "<p class='info'>2. Jika ada ❌, perbaiki dulu sebelum setup</p>";
echo "<p class='info'>3. Setelah setup, test website di: <strong>https://msapt.co.id</strong></p>";

echo "<hr>";
echo "<p><a href='setup-hostinger.php' style='background:green;color:white;padding:10px;text-decoration:none;'>🚀 Jalankan Setup</a></p>";
echo "<p><a href='/' style='background:blue;color:white;padding:10px;text-decoration:none;'>🏠 Lihat Website</a></p>";
?>
