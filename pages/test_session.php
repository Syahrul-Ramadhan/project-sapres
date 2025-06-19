<?php
require_once 'php/session_manager.php';

echo "<h2>🔍 Debug Session</h2>";

// Test 1: Session Status
echo "<h3>1. Session Status:</h3>";
echo "Session Status: " . session_status() . " (1=disabled, 2=active, 3=none)<br>";
echo "Session ID: " . session_id() . "<br><br>";

// Test 2: Raw Session Data
echo "<h3>2. Raw Session Data:</h3>";
echo "<pre>";
print_r($_SESSION ?? 'No session data');
echo "</pre>";

// Test 3: Session Manager Check
echo "<h3>3. Session Manager Check:</h3>";
if (SapresSessionManager::isLoggedIn()) {
    echo "✅ isLoggedIn() = TRUE<br>";
    $userData = SapresSessionManager::getUserData();
    echo "<pre>";
    print_r($userData);
    echo "</pre>";
} else {
    echo "❌ isLoggedIn() = FALSE<br>";
}

// Test 4: Manual Session Check
echo "<h3>4. Manual Session Check:</h3>";
echo "isset(\$_SESSION['user_id']): " . (isset($_SESSION['user_id']) ? 'YES' : 'NO') . "<br>";
echo "!empty(\$_SESSION['user_id']): " . (!empty($_SESSION['user_id']) ? 'YES' : 'NO') . "<br>";

if (isset($_SESSION['user_id'])) {
    echo "user_id value: " . $_SESSION['user_id'] . "<br>";
}
?>