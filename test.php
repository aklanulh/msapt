<?php
echo "<h1>Laravel Test</h1>";

try {
    // Test basic Laravel
    require 'vendor/autoload.php';
    $app = require 'bootstrap/app.php';
    
    echo "✅ Laravel loaded successfully<br>";
    
    // Test database connection
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel kernel bootstrapped<br>";
    
    // Test database
    $pdo = new PDO(
        'mysql:host=localhost;dbname=u919556019_msapt_db', 
        'u919556019_supermsaroot', 
        'Aa153456!'
    );
    echo "✅ Database connection OK<br>";
    
    // Test Laravel database
    $db = DB::connection();
    $db->getPdo();
    echo "✅ Laravel database connection OK<br>";
    
    echo "<h2>SUCCESS: All tests passed!</h2>";
    echo "<a href='/'>Go to website</a>";
    
} catch (Exception $e) {
    echo "<h2>ERROR:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
