<?php
require_once 'config.php';

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
    global $pdo;
    
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Basic validation
    if (empty($fullname) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Semua field harus diisi']);
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
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Email sudah terdaftar']);
            return;
        }
        
        // Hash password and insert user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$fullname, $email, $hashedPassword]);
        
        echo json_encode(['success' => true, 'message' => 'Registrasi berhasil! Silakan login.']);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
    }
}

function handleLogin() {
    global $pdo;
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email dan password harus diisi']);
        return;
    }
    
    try {
        // Get user
        $stmt = $pdo->prepare("SELECT id, fullname, email, password, role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user || !password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Email atau password salah']);
            return;
        }
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        
        // Create session record in database
        createSessionRecord($user['id']);
        
        // Redirect based on role
        $redirect = ($user['role'] === 'admin') ? 'admin/dashboardAdmin.php' : 'dashboard.php';
        
        echo json_encode([
            'success' => true, 
            'message' => 'Login berhasil!',
            'redirect' => $redirect
        ]);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
    }
}

function handleLogout() {
    if (isset($_SESSION['user_id'])) {
        deactivateSession($_SESSION['user_id']);
    }
    
    session_unset();
    session_destroy();
    
    echo json_encode(['success' => true, 'message' => 'Logout berhasil', 'redirect' => 'login.php']);
}

function createSessionRecord($userId) {
    global $pdo;
    
    try {
        $sessionId = session_id();
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        
        // Deactivate old sessions
        $stmt = $pdo->prepare("UPDATE user_sessions SET is_active = 0 WHERE user_id = ?");
        $stmt->execute([$userId]);
        
        // Create new session
        $stmt = $pdo->prepare("INSERT INTO user_sessions (user_id, session_id, ip_address, user_agent) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $sessionId, $ipAddress, $userAgent]);
        
    } catch (Exception $e) {
        // Log but don't fail login
        error_log("Session creation failed: " . $e->getMessage());
    }
}

function deactivateSession($userId) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("UPDATE user_sessions SET is_active = 0 WHERE user_id = ? AND is_active = 1");
        $stmt->execute([$userId]);
    } catch (Exception $e) {
        error_log("Session deactivation failed: " . $e->getMessage());
    }
}
?>