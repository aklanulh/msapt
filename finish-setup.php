<?php
echo "<h1>Finish MSAPT Setup</h1>";

try {
    // Load Laravel
    require 'vendor/autoload.php';
    $app = require 'bootstrap/app.php';
    
    // Bootstrap Laravel
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel loaded<br>";
    
    // Test database connection
    try {
        $db = DB::connection();
        $db->getPdo();
        echo "✅ Database connection OK<br>";
    } catch (Exception $e) {
        echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
        exit;
    }
    
    // Run migrations
    echo "<h2>Running Migrations...</h2>";
    try {
        Artisan::call('migrate', ['--force' => true]);
        echo "✅ Migrations completed<br>";
        echo "<pre>" . Artisan::output() . "</pre>";
    } catch (Exception $e) {
        echo "⚠️ Migration error: " . $e->getMessage() . "<br>";
    }
    
    // Run seeders
    echo "<h2>Running Seeders...</h2>";
    try {
        Artisan::call('db:seed', ['--force' => true]);
        echo "✅ Database seeded<br>";
        echo "<pre>" . Artisan::output() . "</pre>";
    } catch (Exception $e) {
        echo "⚠️ Seeder error: " . $e->getMessage() . "<br>";
    }
    
    // Clear and cache config
    echo "<h2>Optimizing...</h2>";
    try {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        echo "✅ Cache cleared<br>";
        
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        echo "✅ Configuration cached<br>";
    } catch (Exception $e) {
        echo "⚠️ Optimization error: " . $e->getMessage() . "<br>";
    }
    
    // Create storage link
    try {
        Artisan::call('storage:link');
        echo "✅ Storage link created<br>";
    } catch (Exception $e) {
        echo "⚠️ Storage link error: " . $e->getMessage() . "<br>";
    }
    
    echo "<h2>🎉 Setup Complete!</h2>";
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
