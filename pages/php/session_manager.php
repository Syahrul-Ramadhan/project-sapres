<?php
// Centralized Session Management untuk SAPRES
class SapresSessionManager {
    
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function isLoggedIn() {
        self::start();
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    public static function getUserData() {
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
        self::start();
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_name'] = $userData['fullname'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['role'] = $userData['role'];
        
        // Backward compatibility
        $_SESSION['fullname'] = $userData['fullname'];
        $_SESSION['email'] = $userData['email'];
    }
    
    public static function destroySession() {
        self::start();
        
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