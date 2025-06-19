<?php
$imagePath = "../assets/img/user_profile/user_profile.png";
$fullPath = __DIR__ . "/" . $imagePath;

echo "<h2>🖼️ Debug Image Path</h2>";
echo "Relative Path: " . $imagePath . "<br>";
echo "Full Path: " . $fullPath . "<br>";
echo "File Exists: " . (file_exists($fullPath) ? "✅ YES" : "❌ NO") . "<br>";

if (file_exists($fullPath)) {
    echo "<br><img src='$imagePath' alt='Test Image' style='width:50px;height:50px;'><br>";
} else {
    echo "<br>❌ Image file not found!<br>";
}

// Test different paths
$paths = [
    "../assets/img/user_profile/user_profile.png",
    "assets/img/user_profile/user_profile.png", 
    "./assets/img/user_profile/user_profile.png",
    "/project-sapres/assets/img/user_profile/user_profile.png"
];

echo "<h3>Testing Different Paths:</h3>";
foreach ($paths as $path) {
    $exists = file_exists(__DIR__ . "/" . $path);
    echo "$path - " . ($exists ? "✅" : "❌") . "<br>";
}
?>