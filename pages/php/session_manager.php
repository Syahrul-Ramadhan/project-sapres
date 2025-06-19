<?php
// Centralized Session Management untuk SAPRES
class SapresSessionManager {
    
    public static function start() {
        // Force start session jika belum aktif
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Set session parameters sebelum start
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_secure', 0); // Set 1 jika menggunakan HTTPS
            
            session_start();
            
            // Debug
            error_log("Session force started. New status: " . session_status());
        }
    }
    
    public static function isLoggedIn() {
        self::start(); // Pastikan session aktif
        $result = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
        
        // Debug
        error_log("Session status in isLoggedIn: " . session_status());
        error_log("Session ID: " . session_id());
        error_log("isLoggedIn result: " . ($result ? 'TRUE' : 'FALSE'));
        
        return $result;
    }
    
    public static function getUserData() {
        self::start(); // Pastikan session aktif
        
        if (self::isLoggedIn()) {
            return [
                'user_id' => $_SESSION['user_id'],
                'fullname' => $_SESSION['user_name'] ?? $_SESSION['fullname'] ?? '',
                'email' => $_SESSION['user_email'] ?? $_SESSION['email'] ?? '',
                'role' => $_SESSION['role'] ?? 'user'
            ];
        }
        return null;
    }
    
    public static function setUserSession($userData) {
        self::start(); // Pastikan session aktif
        
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_name'] = $userData['fullname'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['role'] = $userData['role'];
        
        // Backward compatibility
        $_SESSION['fullname'] = $userData['fullname'];
        $_SESSION['email'] = $userData['email'];
        
        // Debug
        error_log("Session set. Status: " . session_status());
        error_log("Session ID: " . session_id());
        error_log("Session data: " . print_r($_SESSION, true));
    }
    
    public static function destroySession() {
        self::start(); // Pastikan session aktif sebelum destroy
        
        // Hapus semua session variables
        $_SESSION = array();
        
        // Hapus session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Destroy session
        session_destroy();
        
        // Start new session untuk mencegah masalah
        session_start();
        
        return true;
    }
    
    public static function requireLogin($redirectTo = 'login.php') {
        if (!self::isLoggedIn()) {
            header("Location: $redirectTo");
            exit();
        }
    }
    
    public static function requireAdmin($redirectTo = 'login.php') {
        if (!self::isLoggedIn() || self::getUserData()['role'] !== 'admin') {
            header("Location: $redirectTo");
            exit();
        }
    }
}
?>