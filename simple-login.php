<?php
// Simple login page bypassing Laravel routing
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Laravel
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Handle login
$message = '';
if ($_POST) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    try {
        $user = DB::table('users')->where('email', $email)->first();
        
        if ($user && Hash::check($password, $user->password)) {
            $message = "<div style='color: green;'>✅ Login successful! Welcome " . $user->name . "</div>";
        } else {
            $message = "<div style='color: red;'>❌ Invalid credentials</div>";
        }
    } catch (Exception $e) {
        $message = "<div style='color: red;'>❌ Error: " . $e->getMessage() . "</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MSAPT - Simple Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="email"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007cba; color: white; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background: #005a87; }
        .message { margin-bottom: 20px; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>🏥 MSAPT Login</h1>
    <p><strong>PT. Mitrajaya Selaras Abadi</strong></p>
    
    <?php echo $message; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="admin@msa.com" required>
        </div>
        
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" value="password" required>
        </div>
        
        <button type="submit">Login</button>
    </form>
    
    <hr>
    <h3>Available Users:</h3>
    <?php
    try {
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            echo "<p>📧 " . $user->email . " - " . $user->name . "</p>";
        }
    } catch (Exception $e) {
        echo "<p>❌ Error loading users: " . $e->getMessage() . "</p>";
    }
    ?>
    
    <hr>
    <p><a href="debug-500.php">🔍 Debug 500 Error</a></p>
    <p><a href="/">🌐 Try Main Website</a></p>
</body>
</html>
