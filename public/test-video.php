<?php
/**
 * Test Video Files - Debug video loading issues
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>MSAPT - Test Video Files</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .video-test { margin: 20px 0; padding: 15px; border: 1px solid #ddd; }
        .success { color: green; }
        .error { color: red; }
        video { max-width: 400px; height: auto; }
    </style>
</head>
<body>
    <h1>🎬 MSAPT Video Files Test</h1>
    
    <?php
    $videos = [
        'homemsa.mp4' => 'Homepage Video',
        'mapsmsa.mp4' => 'Maps Video', 
        'videotentangkami.mp4' => 'About Us Video'
    ];
    
    foreach ($videos as $filename => $title) {
        $filepath = __DIR__ . '/' . $filename;
        $url = '/' . $filename;
        
        echo "<div class='video-test'>";
        echo "<h3>$title ($filename)</h3>";
        
        // Check if file exists
        if (file_exists($filepath)) {
            $size = filesize($filepath);
            $sizeFormatted = number_format($size / (1024 * 1024), 2) . ' MB';
            echo "<p class='success'>✅ File exists: $sizeFormatted</p>";
            
            // Check file permissions
            $perms = substr(sprintf('%o', fileperms($filepath)), -3);
            echo "<p>📁 Permissions: $perms</p>";
            
            // Check if readable
            if (is_readable($filepath)) {
                echo "<p class='success'>✅ File is readable</p>";
            } else {
                echo "<p class='error'>❌ File is not readable</p>";
            }
            
            // Test direct URL access
            echo "<p>🔗 Direct URL: <a href='$url' target='_blank'>$url</a></p>";
            
            // Test video tag
            echo "<video controls width='400' style='display: block; margin: 10px 0;'>";
            echo "<source src='$url' type='video/mp4'>";
            echo "Your browser does not support video.";
            echo "</video>";
            
        } else {
            echo "<p class='error'>❌ File not found: $filepath</p>";
        }
        
        echo "</div>";
    }
    ?>
    
    <div class='video-test'>
        <h3>🔧 Server Information</h3>
        <p><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT']; ?></p>
        <p><strong>Current Directory:</strong> <?php echo __DIR__; ?></p>
        <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
        <p><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></p>
    </div>
    
    <div class='video-test'>
        <h3>🌐 Test Laravel Asset Helper</h3>
        <?php if (function_exists('asset')): ?>
            <p class='success'>✅ Laravel asset() function available</p>
            <?php foreach ($videos as $filename => $title): ?>
                <p>Laravel URL: <?php echo asset($filename); ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p class='error'>❌ Laravel asset() function not available</p>
            <p>Manual URLs:</p>
            <?php foreach ($videos as $filename => $title): ?>
                <p>Manual URL: <?php echo "https://" . $_SERVER['HTTP_HOST'] . "/" . $filename; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
</body>
</html>
