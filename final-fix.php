<?php
echo "<h1>Final Database Fix</h1>";

try {
    // 1. Delete ALL cache files aggressively
    echo "<h2>Aggressive Cache Clearing...</h2>";
    
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
    
    // 2. Clear storage cache directories
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
    
    // 3. Force set environment variables
    echo "<h2>Setting Environment Variables...</h2>";
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
    
    // 4. Load Laravel with fresh environment
    require 'vendor/autoload.php';
    $app = require 'bootstrap/app.php';
    
    // 5. Bootstrap Laravel
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel bootstrapped with fresh config<br>";
    
    // 6. Test Laravel database connection
    echo "<h2>Testing Laravel Database...</h2>";
    
    try {
        // Force MySQL connection
        $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'u919556019_msapt_db',
            'username' => 'u919556019_supermsaroot',
            'password' => 'Aa153456!',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ];
        
        // Set database config manually
        config(['database.default' => 'mysql']);
        config(['database.connections.mysql' => $config]);
        
        $db = DB::connection('mysql');
        $db->getPdo();
        echo "✅ Laravel MySQL connection successful!<br>";
        
        // Test query
        $result = $db->select('SELECT 1 as test');
        echo "✅ Database query test: " . $result[0]->test . "<br>";
        
    } catch (Exception $e) {
        echo "❌ Laravel database error: " . $e->getMessage() . "<br>";
        exit;
    }
    
    // 7. Run migrations
    echo "<h2>Running Migrations...</h2>";
    try {
        Artisan::call('migrate', ['--force' => true]);
        echo "✅ Migrations completed<br>";
        echo "<pre>" . Artisan::output() . "</pre>";
    } catch (Exception $e) {
        echo "⚠️ Migration error: " . $e->getMessage() . "<br>";
    }
    
    // 8. Run seeders
    echo "<h2>Running Seeders...</h2>";
    try {
        Artisan::call('db:seed', ['--force' => true]);
        echo "✅ Database seeded<br>";
        echo "<pre>" . Artisan::output() . "</pre>";
    } catch (Exception $e) {
        echo "⚠️ Seeder error: " . $e->getMessage() . "<br>";
    }
    
    // 9. Cache optimized config
    echo "<h2>Caching Configuration...</h2>";
    try {
        Artisan::call('config:cache');
        echo "✅ Configuration cached<br>";
    } catch (Exception $e) {
        echo "⚠️ Cache error: " . $e->getMessage() . "<br>";
    }
    
    echo "<h2>🎉 MSAPT Setup Complete!</h2>";
    echo "<p><strong>Website Ready!</strong></p>";
    echo "<p>Email: admin@msa.com</p>";
    echo "<p>Password: password</p>";
    echo "<p><a href='/' style='background: #007cba; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-size: 18px;'>🚀 Launch Website</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
