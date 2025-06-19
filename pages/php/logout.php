<?php
require_once 'session_manager.php';

// Destroy session menggunakan session manager
SapresSessionManager::destroySession();

// Redirect ke halaman login dengan pesan
header('Location: ../login.php?message=logged_out');
exit();
?>