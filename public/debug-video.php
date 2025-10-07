<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Video Debug - Simple Test</h1>";

// Test 1: Basic PHP info
echo "<h2>1. PHP Status</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Current Directory: " . __DIR__ . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

// Test 2: Check video files
echo "<h2>2. Video Files Check</h2>";
$videos = ['homemsa.mp4', 'mapsmsa.mp4', 'videotentangkami.mp4'];

foreach ($videos as $video) {
    $path = __DIR__ . '/' . $video;
    echo "File: $video<br>";
    echo "Path: $path<br>";
    
    if (file_exists($path)) {
        echo "Status: EXISTS<br>";
        echo "Size: " . filesize($path) . " bytes<br>";
        echo "Readable: " . (is_readable($path) ? 'YES' : 'NO') . "<br>";
    } else {
        echo "Status: NOT FOUND<br>";
    }
    echo "<hr>";
}

// Test 3: Simple video test
echo "<h2>3. Video Test</h2>";
echo '<video controls width="300">';
echo '<source src="homemsa.mp4" type="video/mp4">';
echo 'Video not supported';
echo '</video>';

echo "<br><br>";
echo '<a href="homemsa.mp4" target="_blank">Direct link to homemsa.mp4</a>';
?>
