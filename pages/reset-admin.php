<?php
require_once 'php/koneksi.php';

// Reset admin password
$email = 'admin@sapres.com';
$newPassword = 'admin123';
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

try {
    // Update admin password
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? AND role = 'admin'");
    $result = $stmt->execute([$hashedPassword, $email]);
    
    if ($result) {
        echo "<h2>✅ Admin Password Reset Berhasil!</h2>";
        echo "<p><strong>Email:</strong> admin@sapres.com</p>";
        echo "<p><strong>Password:</strong> admin123</p>";
        echo "<p><a href='login.php'>Login Sekarang</a></p>";
    } else {
        echo "<h2>❌ Reset Gagal</h2>";
    }
    
    // Show current admin users
    echo "<h3>Current Admin Users:</h3>";
    $stmt = $pdo->query("SELECT id, fullname, email, role, created_at FROM users WHERE role = 'admin'");
    while ($user = $stmt->fetch()) {
        echo "<p>ID: {$user['id']} | Name: {$user['fullname']} | Email: {$user['email']}</p>";
    }
    
} catch (Exception $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>