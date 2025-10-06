<?php
echo "<h1>Fix .env File</h1>";

try {
    // 1. Check if .env exists
    if (file_exists('.env')) {
        echo "✅ .env file exists<br>";
        $envContent = file_get_contents('.env');
    } else {
        echo "❌ .env file not found, creating from .env.hostinger<br>";
        
        if (file_exists('.env.hostinger')) {
            $envContent = file_get_contents('.env.hostinger');
            echo "✅ Loaded .env.hostinger content<br>";
        } else {
            echo "❌ .env.hostinger also not found! Creating basic .env<br>";
            $envContent = "APP_NAME=MSAPT
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://msapt.co.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u919556019_msapt_db
DB_USERNAME=u919556019_supermsaroot
DB_PASSWORD=Aa153456!

CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
";
        }
    }
    
    // 2. Generate APP_KEY if missing
    if (strpos($envContent, 'APP_KEY=base64:') === false || 
        preg_match('/APP_KEY=\s*$/', $envContent) || 
        strpos($envContent, 'APP_KEY=') === false) {
        
        echo "🔑 Generating APP_KEY...<br>";
        $key = 'base64:' . base64_encode(random_bytes(32));
        
        if (strpos($envContent, 'APP_KEY=') !== false) {
            $envContent = preg_replace('/APP_KEY=.*/', "APP_KEY=$key", $envContent);
        } else {
            $envContent = "APP_KEY=$key\n" . $envContent;
        }
        
        echo "✅ APP_KEY generated: $key<br>";
    } else {
        echo "✅ APP_KEY already exists<br>";
    }
    
    // 3. Write .env file
    if (file_put_contents('.env', $envContent)) {
        echo "✅ .env file saved successfully<br>";
    } else {
        echo "❌ Failed to save .env file<br>";
        exit;
    }
    
    // 4. Set file permissions
    chmod('.env', 0644);
    echo "✅ .env permissions set<br>";
    
    // 5. Show .env content (hide sensitive data)
    echo "<h2>.env Content Preview:</h2>";
    echo "<pre>";
    $lines = explode("\n", $envContent);
    foreach ($lines as $line) {
        if (strpos($line, 'APP_KEY=') === 0) {
            echo "APP_KEY=base64:***HIDDEN***\n";
        } elseif (strpos($line, 'DB_PASSWORD=') === 0) {
            echo "DB_PASSWORD=***HIDDEN***\n";
        } else {
            echo htmlspecialchars($line) . "\n";
        }
    }
    echo "</pre>";
    
    echo "<h2>✅ .env Setup Complete!</h2>";
    echo "<p><a href='finish-setup.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Continue with Database Setup</a></p>";
    echo "<p><a href='/' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Website</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
