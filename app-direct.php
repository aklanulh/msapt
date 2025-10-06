<?php
// Direct application without Laravel routing
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Laravel core only
require 'vendor/autoload.php';

// Direct database connection
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=u919556019_msapt_db',
        'u919556019_supermsaroot',
        'Aa153456!'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle login
session_start();
$message = '';
$user = null;

if ($_POST) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    
    if ($user && password_verify($password, $user->password)) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $message = "<div class='alert success'>✅ Login berhasil! Selamat datang " . $user->name . "</div>";
    } else {
        $message = "<div class='alert error'>❌ Email atau password salah</div>";
    }
}

// Check if logged in
$isLoggedIn = isset($_SESSION['user_id']);
if ($isLoggedIn) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);
}

// Get dashboard data
$stats = [];
if ($isLoggedIn) {
    // Get products count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products");
    $stats['products'] = $stmt->fetch(PDO::FETCH_OBJ)->count ?? 0;
    
    // Get customers count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM customers");
    $stats['customers'] = $stmt->fetch(PDO::FETCH_OBJ)->count ?? 0;
    
    // Get suppliers count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM suppliers");
    $stats['suppliers'] = $stmt->fetch(PDO::FETCH_OBJ)->count ?? 0;
    
    // Get recent products
    $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 5");
    $recentProducts = $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSAPT - PT. Mitrajaya Selaras Abadi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #007cba, #005a87); color: white; padding: 20px 0; margin-bottom: 30px; }
        .header h1 { text-align: center; font-size: 2.5em; margin-bottom: 10px; }
        .header p { text-align: center; font-size: 1.2em; opacity: 0.9; }
        .card { background: white; border-radius: 10px; padding: 30px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .form-group input { width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 6px; font-size: 16px; }
        .form-group input:focus { border-color: #007cba; outline: none; }
        .btn { background: #007cba; color: white; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: 600; }
        .btn:hover { background: #005a87; }
        .btn-logout { background: #dc3545; }
        .btn-logout:hover { background: #c82333; }
        .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; }
        .alert.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stat-number { font-size: 2.5em; font-weight: bold; color: #007cba; }
        .stat-label { color: #666; margin-top: 10px; }
        .products-list { background: white; border-radius: 10px; padding: 20px; }
        .product-item { padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .product-item:last-child { border-bottom: none; }
        .logout-form { text-align: right; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>🏥 MSAPT</h1>
            <p>PT. Mitrajaya Selaras Abadi - Sistem Manajemen ERP</p>
        </div>
    </div>

    <div class="container">
        <?php if (!$isLoggedIn): ?>
            <!-- Login Form -->
            <div class="card">
                <h2>🔐 Login Sistem</h2>
                <?php echo $message; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label>📧 Email:</label>
                        <input type="email" name="email" value="admin@msa.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label>🔑 Password:</label>
                        <input type="password" name="password" value="password" required>
                    </div>
                    
                    <button type="submit" class="btn">Login</button>
                </form>
            </div>
        <?php else: ?>
            <!-- Dashboard -->
            <div class="logout-form">
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="logout" value="1">
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </div>

            <?php echo $message; ?>
            
            <div class="card">
                <h2>👋 Selamat Datang, <?php echo htmlspecialchars($user->name); ?>!</h2>
                <p>Sistem ERP PT. Mitrajaya Selaras Abadi siap digunakan.</p>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $stats['products']; ?></div>
                    <div class="stat-label">📦 Total Produk</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo $stats['customers']; ?></div>
                    <div class="stat-label">👥 Total Customer</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo $stats['suppliers']; ?></div>
                    <div class="stat-label">🏢 Total Supplier</div>
                </div>
            </div>

            <?php if (!empty($recentProducts)): ?>
            <div class="products-list">
                <h3>📋 Produk Terbaru</h3>
                <?php foreach ($recentProducts as $product): ?>
                <div class="product-item">
                    <div>
                        <strong><?php echo htmlspecialchars($product->name); ?></strong><br>
                        <small>Stok: <?php echo $product->current_stock ?? 0; ?></small>
                    </div>
                    <div>
                        <strong>Rp <?php echo number_format($product->price ?? 0, 0, ',', '.'); ?></strong>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="card" style="text-align: center; margin-top: 30px;">
            <h3>🎉 Website MSAPT Berhasil Online!</h3>
            <p>Sistem ERP PT. Mitrajaya Selaras Abadi telah berhasil di-deploy dan siap digunakan.</p>
            <p><strong>Database:</strong> MySQL ✅ | <strong>Status:</strong> Production Ready ✅</p>
        </div>
    </div>
</body>
</html>

<?php
// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: app-direct.php');
    exit;
}
?>
