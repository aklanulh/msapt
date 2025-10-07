<?php
/**
 * Setup Videos - Download or check video files
 */

echo "<h1>🎬 MSAPT Video Setup</h1>";

// Create videos directory if not exists
$videosDir = __DIR__ . '/videos';
if (!is_dir($videosDir)) {
    mkdir($videosDir, 0755, true);
    echo "<p>✅ Created videos directory</p>";
}

// Check video files
$videos = [
    'homemsa.mp4' => 'Homepage Video',
    'mapsmsa.mp4' => 'Maps Video',
    'videotentangkami.mp4' => 'About Us Video'
];

echo "<h2>📁 Video Files Status</h2>";

foreach ($videos as $filename => $title) {
    $filepath = $videosDir . '/' . $filename;
    echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
    echo "<h3>$title</h3>";
    echo "<p><strong>File:</strong> $filename</p>";
    
    if (file_exists($filepath)) {
        $size = filesize($filepath);
        $sizeFormatted = number_format($size / (1024 * 1024), 2) . ' MB';
        echo "<p style='color: green;'>✅ EXISTS - Size: $sizeFormatted</p>";
        
        // Test URL
        $url = '/videos/' . $filename;
        echo "<p>🔗 <a href='$url' target='_blank'>Test Direct Access</a></p>";
        
    } else {
        echo "<p style='color: red;'>❌ NOT FOUND</p>";
        echo "<p>📤 Please upload this file to: <code>public/videos/$filename</code></p>";
    }
    echo "</div>";
}

echo "<hr>";
echo "<h2>📋 Upload Instructions</h2>";
echo "<ol>";
echo "<li>Go to Hostinger File Manager</li>";
echo "<li>Navigate to: <code>public_html/public/videos/</code></li>";
echo "<li>Upload the 3 video files</li>";
echo "<li>Set permissions: 644 for files, 755 for folder</li>";
echo "<li>Refresh this page to verify</li>";
echo "</ol>";

echo "<p><a href='/' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🏠 Back to Homepage</a></p>";
?>
