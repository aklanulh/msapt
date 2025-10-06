<?php
echo "<h1>Simple MSAPT Setup</h1>";

try {
    // 1. Create .env if not exists
    if (!file_exists('.env')) {
        echo "Creating .env file...<br>";
        if (file_exists('.env.hostinger')) {
            copy('.env.hostinger', '.env');
            echo "✅ .env created from .env.hostinger<br>";
        } else {
            echo "❌ .env.hostinger not found!<br>";
            exit;
        }
    } else {
        echo "✅ .env already exists<br>";
    }
    
    // 2. Generate APP_KEY manually
    echo "Checking APP_KEY...<br>";
    $envContent = file_get_contents('.env');
    if (strpos($envContent, 'APP_KEY=base64:') === false || strpos($envContent, 'APP_KEY=') === false) {
        echo "Generating APP_KEY...<br>";
        $key = 'base64:' . base64_encode(random_bytes(32));
        
        if (strpos($envContent, 'APP_KEY=') !== false) {
            $envContent = preg_replace('/APP_KEY=.*/', "APP_KEY=$key", $envContent);
        } else {
            $envContent = "APP_KEY=$key\n" . $envContent;
        }
        
        file_put_contents('.env', $envContent);
        echo "✅ APP_KEY generated: $key<br>";
    } else {
        echo "✅ APP_KEY already exists<br>";
    }
    
    // 3. Create directories
    echo "Creating directories...<br>";
    $dirs = ['storage/app', 'storage/logs', 'storage/framework/cache', 'storage/framework/sessions', 'storage/framework/views', 'bootstrap/cache'];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
            echo "Created: $dir<br>";
        }
    }
    
    // 4. Set permissions
    echo "Setting permissions...<br>";
    chmod('storage', 0755);
    chmod('bootstrap/cache', 0755);
    echo "✅ Permissions set<br>";
    
    // 5. Test Laravel
    echo "Testing Laravel...<br>";
    if (file_exists('vendor/autoload.php')) {
        require 'vendor/autoload.php';
        echo "✅ Autoload OK<br>";
        
        if (file_exists('bootstrap/app.php')) {
            $app = require 'bootstrap/app.php';
            echo "✅ Laravel Bootstrap OK<br>";
        }
    }
    
    echo "<h2>Setup Complete!</h2>";
    echo "<a href='https://msapt.co.id'>Test Website</a><br>";
    echo "<a href='debug.php'>View Debug Info</a>";
    
} catch (Exception $e) {
    echo "<h2>Error:</h2>";
    echo $e->getMessage();
}
?>
