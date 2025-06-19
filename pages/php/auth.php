<?php
// Simple auth helper that uses koneksi.php
require_once 'koneksi.php';

class Auth {
    private $pdo;
    
    public function __construct() {
        global $koneksi;
        $this->pdo = $koneksi;
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    public function isAdmin() {
        return $this->isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }
    
    public function requireLogin($redirectTo = 'login.php') {
        if (!$this->isLoggedIn()) {
            header('Location: ' . $redirectTo);
            exit;
        }
    }
    
    public function requireAdmin($redirectTo = 'login.php') {
        $this->requireLogin($redirectTo);
        if (!$this->isAdmin()) {
            header('Location: dashboard.php');
            exit;
        }
    }
    
    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    public function getUserName() {
        return $_SESSION['user_name'] ?? '';
    }
    
    public function getUserEmail() {
        return $_SESSION['user_email'] ?? '';
    }
    
    public function getUserRole() {
        return $_SESSION['role'] ?? 'guest';
    }
    
    public function logout() {
        session_unset();
        session_destroy();
        
        // Clear session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    }
}

// Create global auth instance
$auth = new Auth();
?>
