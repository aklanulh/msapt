<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Force MySQL Configuration</h1>";

try {
    // 1. Delete ALL cache files
    echo "<h2>1. Deleting ALL Cache Files...</h2>";
    
    $cacheFiles = [
        'bootstrap/cache/config.php',
        'bootstrap/cache/routes.php',
        'bootstrap/cache/services.php',
        'bootstrap/cache/packages.php'
    ];
    
    foreach ($cacheFiles as $file) {
        if (file_exists($file)) {
            unlink($file);
            echo "✅ Deleted $file<br>";
        }
    }
    
    // 2. Clear storage cache
    $cacheDirs = [
        'storage/framework/cache/data',
        'storage/framework/sessions', 
        'storage/framework/views'
    ];
    
    foreach ($cacheDirs as $dir) {
        if (is_dir($dir)) {
            $files = glob("$dir/*");
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            echo "✅ Cleared $dir<br>";
        }
    }
    
    // 3. Force environment variables BEFORE loading Laravel
    echo "<h2>2. Setting Environment Variables...</h2>";
    
    putenv('DB_CONNECTION=mysql');
    putenv('DB_HOST=localhost');
    putenv('DB_DATABASE=u919556019_msapt_db');
    putenv('DB_USERNAME=u919556019_supermsaroot');
    putenv('DB_PASSWORD=Aa153456!');
    
    $_ENV['DB_CONNECTION'] = 'mysql';
    $_ENV['DB_HOST'] = 'localhost';
    $_ENV['DB_DATABASE'] = 'u919556019_msapt_db';
    $_ENV['DB_USERNAME'] = 'u919556019_supermsaroot';
    $_ENV['DB_PASSWORD'] = 'Aa153456!';
    
    echo "✅ Environment variables set<br>";
    
    // 4. Load Laravel
    require 'vendor/autoload.php';
    
    // 5. Override config BEFORE creating app
    echo "<h2>3. Overriding Database Config...</h2>";
    
    // Create custom config
    $mysqlConfig = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'u919556019_msapt_db',
        'username' => 'u919556019_supermsaroot',
        'password' => 'Aa153456!',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ];
    
    // Write temporary config file
    $configContent = "<?php\nreturn [\n    'default' => 'mysql',\n    'connections' => [\n        'mysql' => " . var_export($mysqlConfig, true) . "\n    ]\n];";
    
    if (!is_dir('bootstrap/cache')) {
        mkdir('bootstrap/cache', 0755, true);
    }
    
    file_put_contents('bootstrap/cache/database.php', $configContent);
    echo "✅ Created temporary database config<br>";
    
    // 6. Load Laravel app
    $app = require 'bootstrap/app.php';
    
    // 7. Override config in app
    $app['config']->set('database.default', 'mysql');
    $app['config']->set('database.connections.mysql', $mysqlConfig);
    
    echo "✅ Laravel app loaded with MySQL config<br>";
    
    // 8. Bootstrap Laravel
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel bootstrapped<br>";
    
    // 9. Test database connection
    echo "<h2>4. Testing Database Connection...</h2>";
    
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=u919556019_msapt_db",
            "u919556019_supermsaroot",
            "Aa153456!"
        );
        echo "✅ Direct PDO connection successful<br>";
        
        // Test Laravel DB
        $users = DB::connection('mysql')->table('users')->get();
        echo "✅ Laravel MySQL connection successful<br>";
        echo "Users found: " . count($users) . "<br>";
        
        foreach ($users as $user) {
            echo "- " . $user->name . " (" . $user->email . ")<br>";
        }
        
    } catch (Exception $e) {
        echo "❌ Database error: " . $e->getMessage() . "<br>";
        exit;
    }
    
    // 10. Cache the correct config
    echo "<h2>5. Caching MySQL Configuration...</h2>";
    
    try {
        Artisan::call('config:cache');
        echo "✅ Configuration cached with MySQL<br>";
    } catch (Exception $e) {
        echo "⚠️ Cache error: " . $e->getMessage() . "<br>";
    }
    
    echo "<h2>🎉 MySQL Configuration Complete!</h2>";
    echo "<p><a href='/' style='background: #007cba; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px;'>Test Website Now</a></p>";
    echo "<p><a href='simple-login.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Simple Login</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
