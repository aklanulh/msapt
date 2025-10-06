<?php
echo "<h1>Force Clear All Laravel Cache</h1>";

try {
    // 1. Delete all cache files manually
    echo "<h2>Deleting Cache Files...</h2>";
    
    $cacheFiles = [
        'bootstrap/cache/config.php',
        'bootstrap/cache/routes.php', 
        'bootstrap/cache/services.php',
        'bootstrap/cache/packages.php',
        'storage/framework/cache/data/*',
        'storage/framework/sessions/*',
        'storage/framework/views/*'
    ];
    
    foreach ($cacheFiles as $pattern) {
        if (strpos($pattern, '*') !== false) {
            // Handle wildcard patterns
            $dir = dirname($pattern);
            if (is_dir($dir)) {
                $files = glob($pattern);
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                        echo "✅ Deleted $file<br>";
                    }
                }
            }
        } else {
            // Handle single files
            if (file_exists($pattern)) {
                unlink($pattern);
                echo "✅ Deleted $pattern<br>";
            }
        }
    }
    
    // 2. Show current .env database config
    echo "<h2>Current .env Database Config:</h2>";
    if (file_exists('.env')) {
        $envContent = file_get_contents('.env');
        $lines = explode("\n", $envContent);
        foreach ($lines as $line) {
            if (strpos($line, 'DB_') === 0) {
                if (strpos($line, 'DB_PASSWORD=') === 0) {
                    echo "DB_PASSWORD=***HIDDEN***<br>";
                } else {
                    echo htmlspecialchars($line) . "<br>";
                }
            }
        }
    }
    
    // 3. Test direct database connection with .env values
    echo "<h2>Testing Direct Database Connection...</h2>";
    
    // Parse .env manually
    $envVars = [];
    if (file_exists('.env')) {
        $envContent = file_get_contents('.env');
        $lines = explode("\n", $envContent);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $envVars[trim($key)] = trim($value, '"');
            }
        }
    }
    
    $host = $envVars['DB_HOST'] ?? 'localhost';
    $database = $envVars['DB_DATABASE'] ?? '';
    $username = $envVars['DB_USERNAME'] ?? '';
    $password = $envVars['DB_PASSWORD'] ?? '';
    
    echo "Host: $host<br>";
    echo "Database: $database<br>";
    echo "Username: $username<br>";
    echo "Password: " . (empty($password) ? 'EMPTY!' : 'SET') . "<br>";
    
    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$database", 
            $username, 
            $password
        );
        echo "✅ Direct database connection successful!<br>";
        
        // Test query
        $stmt = $pdo->query("SELECT 1 as test");
        $result = $stmt->fetch();
        echo "✅ Database query test: " . $result['test'] . "<br>";
        
    } catch (Exception $e) {
        echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
        echo "<h3>Troubleshooting:</h3>";
        echo "1. Check if database exists in Hostinger<br>";
        echo "2. Verify username and password<br>";
        echo "3. Check if user has permissions<br>";
        exit;
    }
    
    echo "<h2>✅ Database Connection Working!</h2>";
    echo "<p><a href='fix-database.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Continue with Laravel Setup</a></p>";
    echo "<p><a href='/' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Website</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
