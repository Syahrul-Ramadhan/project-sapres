<?php
echo "<h2>🔍 Full Debug</h2>";

// 1. Cek session sebelum start
echo "<h3>1. Before Session Start:</h3>";
echo "Session status: " . session_status() . "<br>";

// 2. Force start session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

echo "<h3>2. After Session Start:</h3>";
echo "Session status: " . session_status() . "<br>";
echo "Session ID: " . session_id() . "<br>";

// 3. Raw session data
echo "<h3>3. Raw Session Data:</h3>";
echo "<pre>";
print_r($_SESSION ?? 'No session data');
echo "</pre>";

// 4. Test session manager
require_once 'php/session_manager.php';

echo "<h3>4. Session Manager Test:</h3>";
echo "isLoggedIn(): " . (SapresSessionManager::isLoggedIn() ? 'TRUE' : 'FALSE') . "<br>";

if (SapresSessionManager::isLoggedIn()) {
    $userData = SapresSessionManager::getUserData();
    echo "User data: <pre>" . print_r($userData, true) . "</pre>";
}

// 5. Test manual session set
echo "<h3>5. Manual Session Test:</h3>";
$_SESSION['test'] = 'test_value';
echo "Set test session: " . $_SESSION['test'] . "<br>";

// 6. Cek cookies
echo "<h3>6. Cookies:</h3>";
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

// 7. Cek session file
echo "<h3>7. Session Save Path:</h3>";
echo "Save path: " . session_save_path() . "<br>";
echo "Session name: " . session_name() . "<br>";
?>