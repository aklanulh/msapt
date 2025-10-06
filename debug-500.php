<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug 500 Error</h1>";

try {
    echo "<h2>1. Basic PHP Test</h2>";
    echo "✅ PHP is working<br>";
    echo "PHP Version: " . phpversion() . "<br>";
    
    echo "<h2>2. File Structure Check</h2>";
    $files = ['vendor/autoload.php', 'bootstrap/app.php', '.env', 'index.php'];
    foreach ($files as $file) {
        echo ($file . ": " . (file_exists($file) ? "✅ EXISTS" : "❌ MISSING") . "<br>");
    }
    
    echo "<h2>3. Test Laravel Loading</h2>";
    
    // Test autoload
    if (file_exists('vendor/autoload.php')) {
        require 'vendor/autoload.php';
        echo "✅ Autoload successful<br>";
    } else {
        echo "❌ Autoload failed<br>";
        exit;
    }
    
    // Test bootstrap
    if (file_exists('bootstrap/app.php')) {
        $app = require 'bootstrap/app.php';
        echo "✅ Bootstrap successful<br>";
    } else {
        echo "❌ Bootstrap failed<br>";
        exit;
    }
    
    echo "<h2>4. Test Laravel Request Handling</h2>";
    
    // Simulate what index.php does
    use Illuminate\Http\Request;
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "✅ HTTP Kernel created<br>";
    
    $request = Request::capture();
    echo "✅ Request captured<br>";
    
    // Try to handle request
    try {
        $response = $kernel->handle($request);
        echo "✅ Request handled successfully<br>";
        echo "Response Status: " . $response->getStatusCode() . "<br>";
        
        // Show first 500 chars of response
        $content = $response->getContent();
        echo "Response Preview: <pre>" . htmlspecialchars(substr($content, 0, 500)) . "...</pre>";
        
    } catch (Exception $e) {
        echo "❌ Request handling failed: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "<br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
    
    echo "<h2>5. Check Routes</h2>";
    try {
        $routes = app('router')->getRoutes();
        echo "✅ Routes loaded: " . count($routes) . " routes<br>";
    } catch (Exception $e) {
        echo "❌ Routes error: " . $e->getMessage() . "<br>";
    }
    
    echo "<h2>6. Check Database</h2>";
    try {
        $users = DB::table('users')->count();
        echo "✅ Database working: $users users found<br>";
    } catch (Exception $e) {
        echo "❌ Database error: " . $e->getMessage() . "<br>";
    }
    
    echo "<h2>7. Test Direct Laravel App</h2>";
    echo "<a href='test-direct.php' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Direct Laravel</a>";
    
} catch (Exception $e) {
    echo "<h2>❌ Critical Error:</h2>";
    echo "<strong>Message:</strong> " . $e->getMessage() . "<br>";
    echo "<strong>File:</strong> " . $e->getFile() . "<br>";
    echo "<strong>Line:</strong> " . $e->getLine() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
