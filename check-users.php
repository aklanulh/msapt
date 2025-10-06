<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Check Users Database</h1>";

try {
    // Direct database connection
    $pdo = new PDO(
        'mysql:host=localhost;dbname=u919556019_msapt_db',
        'u919556019_supermsaroot',
        'Aa153456!'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connected<br><br>";
    
    // Check if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Users table exists<br><br>";
        
        // Get all users
        $stmt = $pdo->query("SELECT id, name, email, created_at FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        echo "<h2>📋 All Users in Database:</h2>";
        if (count($users) > 0) {
            echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Created At</th></tr>";
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user->id . "</td>";
                echo "<td>" . htmlspecialchars($user->name) . "</td>";
                echo "<td>" . htmlspecialchars($user->email) . "</td>";
                echo "<td>" . $user->created_at . "</td>";
                echo "</tr>";
            }
            echo "</table><br>";
        } else {
            echo "❌ No users found in database!<br><br>";
        }
        
        // Create admin user if not exists
        echo "<h2>🔧 Creating Admin User...</h2>";
        
        // Check if admin@msa.com exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(['admin@msa.com']);
        $adminUser = $stmt->fetch(PDO::FETCH_OBJ);
        
        if (!$adminUser) {
            // Create admin user
            $hashedPassword = password_hash('password', PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, email_verified_at, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW(), NOW())");
            $result = $stmt->execute([
                'Admin MSAPT',
                'admin@msa.com', 
                $hashedPassword,
                date('Y-m-d H:i:s')
            ]);
            
            if ($result) {
                echo "✅ Admin user created successfully!<br>";
            } else {
                echo "❌ Failed to create admin user<br>";
            }
        } else {
            echo "✅ Admin user already exists<br>";
            
            // Update password to make sure it's correct
            $hashedPassword = password_hash('password', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->execute([$hashedPassword, 'admin@msa.com']);
            echo "✅ Admin password updated<br>";
        }
        
        // Test password verification
        echo "<h2>🔑 Testing Password Verification...</h2>";
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(['admin@msa.com']);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($user) {
            echo "User found: " . $user->name . "<br>";
            echo "Email: " . $user->email . "<br>";
            
            $testPassword = 'password';
            if (password_verify($testPassword, $user->password)) {
                echo "✅ Password verification SUCCESS!<br>";
            } else {
                echo "❌ Password verification FAILED!<br>";
                echo "Stored hash: " . substr($user->password, 0, 50) . "...<br>";
            }
        }
        
    } else {
        echo "❌ Users table does not exist!<br>";
        
        // Create users table
        echo "<h2>🔧 Creating Users Table...</h2>";
        $createTable = "
        CREATE TABLE users (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            email_verified_at timestamp NULL DEFAULT NULL,
            password varchar(255) NOT NULL,
            remember_token varchar(100) DEFAULT NULL,
            created_at timestamp NULL DEFAULT NULL,
            updated_at timestamp NULL DEFAULT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY users_email_unique (email)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        $pdo->exec($createTable);
        echo "✅ Users table created<br>";
        
        // Insert admin user
        $hashedPassword = password_hash('password', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, email_verified_at, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW(), NOW())");
        $stmt->execute(['Admin MSAPT', 'admin@msa.com', $hashedPassword, date('Y-m-d H:i:s')]);
        echo "✅ Admin user inserted<br>";
    }
    
    echo "<h2>🎯 Login Test:</h2>";
    echo "<p><a href='app-direct.php' style='background: #007cba; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px;'>Test Login Now</a></p>";
    echo "<p><strong>Email:</strong> admin@msa.com</p>";
    echo "<p><strong>Password:</strong> password</p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
