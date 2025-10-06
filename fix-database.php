<?php
echo "<h1>Fix Database Configuration</h1>";

try {
    // 1. Load Laravel
    require 'vendor/autoload.php';
    $app = require 'bootstrap/app.php';
    
    echo "✅ Laravel loaded<br>";
    
    // 2. Clear all caches first
    echo "<h2>Clearing Caches...</h2>";
    
    // Clear cache files manually
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
    
    // 3. Bootstrap Laravel with fresh config
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel kernel bootstrapped<br>";
    
    // 4. Test database connection
    echo "<h2>Testing Database Connection...</h2>";
    
    // Get database config
    $config = config('database.connections.mysql');
    echo "Database Host: " . $config['host'] . "<br>";
    echo "Database Name: " . $config['database'] . "<br>";
    echo "Database User: " . $config['username'] . "<br>";
    
    // Test direct PDO connection
    try {
        $pdo = new PDO(
            "mysql:host={$config['host']};dbname={$config['database']}", 
            $config['username'], 
            $config['password']
        );
        echo "✅ Direct PDO connection successful<br>";
    } catch (Exception $e) {
        echo "❌ Direct PDO failed: " . $e->getMessage() . "<br>";
        exit;
    }
    
    // Test Laravel database connection
    try {
        $db = DB::connection();
        $db->getPdo();
        echo "✅ Laravel database connection successful<br>";
    } catch (Exception $e) {
        echo "❌ Laravel database failed: " . $e->getMessage() . "<br>";
        exit;
    }
    
    // 5. Run migrations
    echo "<h2>Running Migrations...</h2>";
    try {
        Artisan::call('migrate', ['--force' => true]);
        echo "✅ Migrations completed<br>";
        echo "<pre>" . Artisan::output() . "</pre>";
    } catch (Exception $e) {
        echo "⚠️ Migration error: " . $e->getMessage() . "<br>";
    }
    
    // 6. Run seeders
    echo "<h2>Running Seeders...</h2>";
    try {
        Artisan::call('db:seed', ['--force' => true]);
        echo "✅ Database seeded<br>";
        echo "<pre>" . Artisan::output() . "</pre>";
    } catch (Exception $e) {
        echo "⚠️ Seeder error: " . $e->getMessage() . "<br>";
    }
    
    // 7. Cache config for production
    echo "<h2>Caching Configuration...</h2>";
    try {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        echo "✅ Configuration cached<br>";
    } catch (Exception $e) {
        echo "⚠️ Cache error: " . $e->getMessage() . "<br>";
    }
    
    // 8. Create storage link
    try {
        Artisan::call('storage:link');
        echo "✅ Storage link created<br>";
    } catch (Exception $e) {
        echo "⚠️ Storage link error: " . $e->getMessage() . "<br>";
    }
    
    echo "<h2>🎉 Database Setup Complete!</h2>";
    echo "<p><strong>Login Details:</strong></p>";
    echo "<p>Email: admin@msa.com</p>";
    echo "<p>Password: password</p>";
    echo "<p><a href='/' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Website</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
