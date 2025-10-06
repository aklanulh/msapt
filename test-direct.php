<?php
// Direct Laravel test without routing
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Direct Laravel Test</h1>";

try {
    // Load Laravel
    require 'vendor/autoload.php';
    $app = require 'bootstrap/app.php';
    
    // Bootstrap Laravel
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel loaded and bootstrapped<br>";
    
    // Test basic Laravel functionality
    echo "<h2>Laravel Environment:</h2>";
    echo "App Name: " . config('app.name') . "<br>";
    echo "App URL: " . config('app.url') . "<br>";
    echo "Environment: " . app()->environment() . "<br>";
    echo "Debug Mode: " . (config('app.debug') ? 'ON' : 'OFF') . "<br>";
    
    // Test database
    echo "<h2>Database Test:</h2>";
    $users = DB::table('users')->get();
    echo "Users found: " . count($users) . "<br>";
    
    foreach ($users as $user) {
        echo "- " . $user->name . " (" . $user->email . ")<br>";
    }
    
    // Test basic HTML response
    echo "<h2>Basic Laravel Response:</h2>";
    echo "<div style='background: #f8f9fa; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px;'>";
    echo "<h3>🎉 Laravel is Working!</h3>";
    echo "<p>If you see this, Laravel core is functioning properly.</p>";
    echo "<p>The 500 error might be in routing or view rendering.</p>";
    echo "</div>";
    
    echo "<h2>Next Steps:</h2>";
    echo "<p><a href='/' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Main Website (might still error)</a></p>";
    echo "<p><a href='simple-login.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Try Simple Login Page</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
