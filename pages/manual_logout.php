<?php
require_once 'php/session_manager.php';

echo "<h2>🚪 Manual Logout Test</h2>";

echo "<h3>Before Logout:</h3>";
echo "isLoggedIn: " . (SapresSessionManager::isLoggedIn() ? 'TRUE' : 'FALSE') . "<br>";
echo "Session data: <pre>" . print_r($_SESSION ?? [], true) . "</pre>";

if (SapresSessionManager::isLoggedIn()) {
    echo "<br><a href='#' onclick='performLogout()' style='background: red; color: white; padding: 10px; text-decoration: none;'>LOGOUT NOW</a><br><br>";
    
    echo "<script>
    function performLogout() {
        if (confirm('Logout sekarang?')) {
            window.location.href = 'php/logout.php';
        }
    }
    </script>";
} else {
    echo "<br>✅ Already logged out!<br>";
    echo "<a href='login.php'>Go to Login</a>";
}
?>