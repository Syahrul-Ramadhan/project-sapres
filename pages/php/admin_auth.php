<?php
// Admin Authentication Handler
class AdminAuth {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function requireAdminLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check remember token first
        if (!isset($_SESSION['user_id'])) {
            $this->checkRememberToken();
        }
        
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->redirectToLogin('login_required');
            exit;
        }
        
        // Verify user still exists and is active
        if (!$this->verifyUser($_SESSION['user_id'])) {
            $this->destroySessionAndRedirect('user_not_found');
            exit;
        }
        
        // Check if user is admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            // If user is regular user, redirect to regular dashboard
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
                header('Location: ../dashboard.php?error=access_denied');
                exit;
            }
            
            // If no role or invalid role, redirect to login
            $this->destroySessionAndRedirect('admin_required');
            exit;
        }
        
        // Update last activity
        $this->updateLastActivity();
        
        return true;
    }
    
    public function getAdminInfo() {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }
        
        try {
            $stmt = $this->pdo->prepare("SELECT id, fullname, email, role, created_at FROM users WHERE id = ? AND role = 'admin'");
            $stmt->execute([$_SESSION['user_id']]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error getting admin info: " . $e->getMessage());
            return null;
        }
    }
    
    public function isLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['user_id']) && isset($_SESSION['role']);
    }
    
    public function isAdmin() {
        return $this->isLoggedIn() && $_SESSION['role'] === 'admin';
    }
    
    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    public function getUserName() {
        return $_SESSION['user_name'] ?? null;
    }
    
    public function getUserEmail() {
        return $_SESSION['user_email'] ?? null;
    }
    
    public function getUserRole() {
        return $_SESSION['role'] ?? null;
    }
    
    private function checkRememberToken() {
        if (!isset($_COOKIE['remember_token'])) {
            return false;
        }
        
        try {
            $token = $_COOKIE['remember_token'];
            $hashedToken = hash('sha256', $token);
            
            $stmt = $this->pdo->prepare("SELECT id, fullname, email, role FROM users WHERE remember_token = ? AND role = 'admin'");
            $stmt->execute([$hashedToken]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Restore session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                
                // Create new session record
                $this->createSessionRecord($user['id']);
                
                return true;
            } else {
                // Invalid token, clear cookie
                $this->clearRememberToken();
            }
        } catch (Exception $e) {
            error_log("Remember token check failed: " . $e->getMessage());
            $this->clearRememberToken();
        }
        
        return false;
    }
    
    private function verifyUser($userId) {
        try {
            $stmt = $this->pdo->prepare("SELECT id, role FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $user && $user['role'] === 'admin';
        } catch (Exception $e) {
            error_log("User verification failed: " . $e->getMessage());
            return false;
        }
    }
    
    private function updateLastActivity() {
        try {
            $sessionId = session_id();
            $stmt = $this->pdo->prepare("
                UPDATE user_sessions 
                SET last_activity = CURRENT_TIMESTAMP 
                WHERE user_id = ? AND session_id = ? AND is_active = 1
            ");
            $stmt->execute([$_SESSION['user_id'], $sessionId]);
        } catch (Exception $e) {
            error_log("Failed to update last activity: " . $e->getMessage());
        }
    }
    
    private function createSessionRecord($userId) {
        try {
            $sessionId = session_id();
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            
            // Deactivate old sessions for this user
            $stmt = $this->pdo->prepare("UPDATE user_sessions SET is_active = 0 WHERE user_id = ?");
            $stmt->execute([$userId]);
            
            // Create new session record
            $stmt = $this->pdo->prepare("
                INSERT INTO user_sessions (user_id, session_id, ip_address, user_agent, is_active) 
                VALUES (?, ?, ?, ?, 1)
            ");
            $stmt->execute([$userId, $sessionId, $ipAddress, $userAgent]);
            
        } catch (Exception $e) {
            error_log("Session creation failed: " . $e->getMessage());
        }
    }
    
    private function clearRememberToken() {
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', false, true);
        }
    }
    
    private function redirectToLogin($message = '') {
        $url = '../login.php?redirect=admin';
        if (!empty($message)) {
            $url .= '&message=' . urlencode($message);
        }
        header('Location: ' . $url);
    }
    
    private function destroySessionAndRedirect($message = '') {
        // Clear remember token
        $this->clearRememberToken();
        
        // Clear session from database
        if (isset($_SESSION['user_id'])) {
            try {
                $stmt = $this->pdo->prepare("UPDATE user_sessions SET is_active = 0 WHERE user_id = ?");
                $stmt->execute([$_SESSION['user_id']]);
            } catch (Exception $e) {
                error_log("Failed to deactivate session: " . $e->getMessage());
            }
        }
        
        // Destroy session
        session_unset();
        session_destroy();
        
        // Redirect to login
        $this->redirectToLogin($message);
    }
    
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Deactivate session in database
        if (isset($_SESSION['user_id'])) {
            try {
                $sessionId = session_id();
                $stmt = $this->pdo->prepare("
                    UPDATE user_sessions 
                    SET is_active = 0, last_activity = CURRENT_TIMESTAMP 
                    WHERE user_id = ? AND session_id = ?
                ");
                $stmt->execute([$_SESSION['user_id'], $sessionId]);
            } catch (Exception $e) {
                error_log("Session deactivation failed: " . $e->getMessage());
            }
        }
        
        // Clear remember token
        $this->clearRememberToken();
        
        // Clear remember token from database
        if (isset($_SESSION['user_id'])) {
            try {
                $stmt = $this->pdo->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
            } catch (Exception $e) {
                error_log("Failed to clear remember token from database: " . $e->getMessage());
            }
        }
        
        // Destroy session
        session_unset();
        session_destroy();
        
        return true;
    }
    
    public function getActiveAdminSessions() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT us.*, u.fullname, u.email 
                FROM user_sessions us 
                JOIN users u ON us.user_id = u.id 
                WHERE u.role = 'admin' AND us.is_active = 1 
                ORDER BY us.last_activity DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Failed to get active admin sessions: " . $e->getMessage());
            return [];
        }
    }
    
    public function cleanExpiredSessions($expireAfterHours = 24) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE user_sessions 
                SET is_active = 0 
                WHERE is_active = 1 
                AND last_activity < DATE_SUB(NOW(), INTERVAL ? HOUR)
            ");
            $stmt->execute([$expireAfterHours]);
            
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log("Failed to clean expired sessions: " . $e->getMessage());
            return 0;
        }
    }
    
    public function hasPermission($permission) {
        // For now, all admins have all permissions
        // You can extend this to have role-based permissions
        return $this->isAdmin();
    }
    
    public function requirePermission($permission) {
        if (!$this->hasPermission($permission)) {
            header('HTTP/1.0 403 Forbidden');
            echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
            exit;
        }
    }
    
    public function logAdminActivity($action, $details = '') {
        if (!$this->isAdmin()) {
            return false;
        }
        
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO admin_activity_log (admin_id, action, details, ip_address, user_agent, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $this->getUserId(),
                $action,
                $details,
                $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
            ]);
            
            return true;
        } catch (Exception $e) {
            error_log("Failed to log admin activity: " . $e->getMessage());
            return false;
        }
    }
    
    public function getAdminActivityLog($limit = 50, $offset = 0) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT aal.*, u.fullname, u.email 
                FROM admin_activity_log aal 
                JOIN users u ON aal.admin_id = u.id 
                ORDER BY aal.created_at DESC 
                LIMIT ? OFFSET ?
            ");
            $stmt->execute([$limit, $offset]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Failed to get admin activity log: " . $e->getMessage());
            return [];
        }
    }
}

// Helper function for backward compatibility
function requireAdminAuth() {
    global $pdo;
    $adminAuth = new AdminAuth($pdo);
    return $adminAuth->requireAdminLogin();
}

// Helper function to get admin info
function getAdminInfo() {
    global $pdo;
    $adminAuth = new AdminAuth($pdo);
    return $adminAuth->getAdminInfo();
}
?>
