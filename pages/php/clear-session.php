<?php
session_start();
session_unset();
session_destroy();

// Also clear session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

echo "<h2>Session Cleared!</h2>";
echo "<p><a href='login.php'>Go to Login</a></p>";
echo "<p><a href='register.php'>Go to Register</a></p>";
?>