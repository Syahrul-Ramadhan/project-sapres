<?php
require_once 'koneksi.php';

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'register':
        handleRegister();
        break;
        
    case 'login':
        handleLogin();
        break;
        
    case 'logout':
        handleLogout();
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function handleRegister() {
    global $koneksi;
    
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Basic validation
    if (empty($fullname) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Semua field harus diisi']);
        return;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Format email tidak valid']);
        return;
    }
    
    if ($password !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Password tidak cocok']);
        return;
    }
    
    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password minimal 6 karakter']);
        return;
    }
    
    try {
        // Check if email exists
        $stmt = $koneksi->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Email sudah terdaftar']);
            return;
        }
        
        // Hash password and insert user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $koneksi->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, 'user')");
        $result = $stmt->execute([$fullname, $email, $hashedPassword]);
        
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Registrasi berhasil! Silakan login.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mendaftar, silakan coba lagi']);
        }
        
    } catch (Exception $e) {
        error_log("Registration error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
    }
}

function handleLogin() {
    global $koneksi;
    
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = $_POST['remember'] ?? '0';
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email dan password harus diisi']);
        return;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Format email tidak valid']);
        return;
    }
    
    try {
        // Get user
        $stmt = $koneksi->prepare("SELECT id, fullname, email, password, role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || !password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Email atau password salah']);
            return;
        }
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        
        // Handle remember me
        if ($remember === '1') {
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + (86400 * 30), '/', '', false, true); // 30 days, httponly
            
            // Store token in database (optional - you can create a remember_tokens table)
            try {
                $stmt = $koneksi->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                $stmt->execute([hash('sha256', $token), $user['id']]);
            } catch (Exception $e) {
                // Log but don't fail login
                error_log("Remember token storage failed: " . $e->getMessage());
            }
        }
        
        // Create session record in database
        createSessionRecord($user['id']);
        
        // Determine redirect based on role and request
        $redirect = determineRedirect($user['role']);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Login berhasil!',
            'redirect' => $redirect,
            'user' => [
                'id' => $user['id'],
                'name' => $user['fullname'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ]);
        
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
    }
}

function handleLogout() {
    global $koneksi;
    
    try {
        // Deactivate session in database
        if (isset($_SESSION['user_id'])) {
            deactivateSession($_SESSION['user_id']);
        }
        
        // Clear remember me cookie and token
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', false, true);
            
            // Clear token from database
            if (isset($_SESSION['user_id'])) {
                $stmt = $koneksi->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
            }
        }
        
        // Destroy session
        session_unset();
        session_destroy();
        
        // Start new session to prevent session fixation
        session_start();
        session_regenerate_id(true);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Logout berhasil', 
            'redirect' => 'dashboard.php'
        ]);
        
    } catch (Exception $e) {
        error_log("Logout error: " . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'message' => 'Logout gagal', 
            'redirect' => 'login.php' // Redirect ke halaman login
        ]);
    }
}

function determineRedirect($role) {
    // Check for specific redirect request
    $requestedRedirect = $_GET['redirect'] ?? $_POST['redirect'] ?? '';
    
    if ($role === 'admin') {
        // Admin redirects
        switch ($requestedRedirect) {
            case 'lomba':
                return 'admin/lombaAdmin.php';
            case 'beasiswa':
                return 'admin/beasiswaAdmin.php';
            case 'tim':
                return 'admin/timAdmin.php';
            case 'forum':
                return 'admin/forumAdmin.php';
            default:
                return 'admin/dashboardAdmin.php';
        }
    } else {
        // Regular user redirects
        switch ($requestedRedirect) {
            case 'beasiswa':
                return 'beasiswa.php';
            case 'lomba':
                return 'lomba.php';
            case 'tim':
                return 'cariTim.php';
            case 'forum':
                return 'forum.php';
            default:
                return 'dashboard.php';
        }
    }
}

function createSessionRecord($userId) {
    global $koneksi;
    
    try {
        $sessionId = session_id();
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        
        // Deactivate old sessions for this user
        $stmt = $koneksi->prepare("UPDATE user_sessions SET is_active = 0 WHERE user_id = ?");
        $stmt->execute([$userId]);
        
        // Create new session record
        $stmt = $koneksi->prepare("
            INSERT INTO user_sessions (user_id, session_id, ip_address, user_agent, is_active) 
            VALUES (?, ?, ?, ?, 1)
        ");
        $stmt->execute([$userId, $sessionId, $ipAddress, $userAgent]);
        
    } catch (Exception $e) {
        // Log but don't fail login
        error_log("Session creation failed: " . $e->getMessage());
    }
}

function deactivateSession($userId) {
    global $koneksi;
    
    try {
        $sessionId = session_id();
        $stmt = $koneksi->prepare("
            UPDATE user_sessions 
            SET is_active = 0, last_activity = CURRENT_TIMESTAMP 
            WHERE user_id = ? AND session_id = ?
        ");
        $stmt->execute([$userId, $sessionId]);
    } catch (Exception $e) {
        error_log("Session deactivation failed: " . $e->getMessage());
    }
}

// Handle GET requests for logout (direct URL access)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'logout') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Deactivate session
    if (isset($_SESSION['user_id'])) {
        deactivateSession($_SESSION['user_id']);
    }
    
    // Clear remember me cookie
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    }
    
    // Destroy session
    session_unset();
    session_destroy();
    
    // Redirect to login page
    header('Location: ../login.php?message=logged_out');
    exit;
}

// Auto-login with remember token (call this function on protected pages)
function checkRememberToken() {
    global $koneksi;
    
    if (isset($_COOKIE['remember_token']) && !isset($_SESSION['user_id'])) {
        try {
            $token = $_COOKIE['remember_token'];
            $hashedToken = hash('sha256', $token);
            
            $stmt = $koneksi->prepare("SELECT id, fullname, email, role FROM users WHERE remember_token = ?");
            $stmt->execute([$hashedToken]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Start session
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                
                // Create session record
                createSessionRecord($user['id']);
                
                return true;
            } else {
                // Invalid token, clear cookie
                setcookie('remember_token', '', time() - 3600, '/', '', false, true);
            }
        } catch (Exception $e) {
            error_log("Remember token check failed: " . $e->getMessage());
        }
    }
    
    return false;
}
?>
