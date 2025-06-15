<?php
require_once 'koneksi.php';

echo "<h2>Database Connection Test</h2>";

try {
    // Test users table
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $result = $stmt->fetch();
    echo "<p>Total Users: " . $result['total'] . "</p>";
    
    // Test recent users
    $stmt = $pdo->query("SELECT fullname, email, created_at FROM users ORDER BY created_at DESC LIMIT 5");
    echo "<h3>Recent Users:</h3>";
    while ($user = $stmt->fetch()) {
        echo "<p>" . htmlspecialchars($user['fullname']) . " - " . htmlspecialchars($user['email']) . " (" . $user['created_at'] . ")</p>";
    }
    
    // Test sessions
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM user_sessions WHERE is_active = 1");
    $result = $stmt->fetch();
    echo "<p>Active Sessions: " . $result['total'] . "</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?>