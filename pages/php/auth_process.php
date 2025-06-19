<?php
// Enable error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'koneksi.php';
require_once 'session_manager.php';

// Set header JSON
header('Content-Type: application/json');

// Log untuk debugging
error_log("=== AUTH PROCESS DEBUG ===");
error_log("Request method: " . $_SERVER['REQUEST_METHOD']);
error_log("POST data: " . print_r($_POST, true));
error_log("Raw input: " . file_get_contents('php://input'));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$action = $_POST['action'] ?? '';
error_log("Action received: " . $action);

switch ($action) {
    case 'login':
        handleLogin();
        break;
    case 'register':
        handleRegister();
        break;
    case 'logout':
        handleLogout();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action: ' . $action]);
        break;
}

function handleLogin() {
    global $koneksi;
    
    try {
        error_log("=== LOGIN FUNCTION START ===");
        
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        error_log("Email received: '" . $email . "'");
        error_log("Password length: " . strlen($password));
        error_log("Email empty check: " . (empty($email) ? 'true' : 'false'));
        error_log("Password empty check: " . (empty($password) ? 'true' : 'false'));
        
        if (empty($email) || empty($password)) {
            error_log("Validation failed - empty fields");
            echo json_encode(['success' => false, 'message' => 'Email dan password harus diisi']);
            return;
        }
        
        // Cek koneksi database
        if (!$koneksi) {
            error_log("Database connection failed");
            echo json_encode(['success' => false, 'message' => 'Database connection failed']);
            return;
        }
        
        error_log("Database connection OK");
        
        // Cek user di database
        $stmt = $koneksi->prepare("SELECT user_id, fullname, email, password, role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        error_log("User query executed");
        error_log("User found: " . ($user ? 'Yes' : 'No'));
        
        if ($user) {
            error_log("User data: " . print_r($user, true));
        }
        
        if (!$user || !password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Email atau password salah']);
            return;
        }
        
        // DEBUG: Log before setting session
        error_log("=== LOGIN DEBUG ===");
        error_log("User found: " . print_r($user, true));
        
        // Set session
        SapresSessionManager::setUserSession($user);
        
        // DEBUG: Log after setting session
        error_log("Session after set: " . print_r($_SESSION, true));
        error_log("isLoggedIn check: " . (SapresSessionManager::isLoggedIn() ? 'TRUE' : 'FALSE'));
        
        // Update user_sessions table
        $sessionId = session_id();
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        try {
            $stmt = $koneksi->prepare("INSERT INTO user_sessions (user_id, session_id, ip_address, user_agent, is_active) VALUES (?, ?, ?, ?, 1)");
            $stmt->execute([$user['user_id'], $sessionId, $ipAddress, $userAgent]);
            error_log("User session record created");
        } catch (Exception $e) {
            error_log("Session insert error: " . $e->getMessage());
            // Continue even if session insert fails
        }
        
        $redirectUrl = ($user['role'] === 'admin') ? 'admin/dashboardAdmin.php' : 'dashboard.php';
        error_log("Login successful, redirecting to: " . $redirectUrl);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Login berhasil',
            'redirect' => $redirectUrl,
            'debug_session' => $_SESSION // Add for debugging
        ]);
        
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
    }
}

function handleRegister() {
    global $koneksi;
    
    try {
        error_log("=== REGISTER FUNCTION START ===");
        
        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        error_log("Register data - Name: '$fullname', Email: '$email'");
        error_log("Password length: " . strlen($password));
        error_log("Confirm password length: " . strlen($confirmPassword));
        
        // Validasi input
        if (empty($fullname) || empty($email) || empty($password)) {
            error_log("Validation failed - empty required fields");
            echo json_encode(['success' => false, 'message' => 'Semua field harus diisi']);
            return;
        }
        
        if ($password !== $confirmPassword) {
            error_log("Password confirmation mismatch");
            echo json_encode(['success' => false, 'message' => 'Password dan konfirmasi password tidak sama']);
            return;
        }
        
        if (strlen($password) < 6) {
            error_log("Password too short");
            echo json_encode(['success' => false, 'message' => 'Password minimal 6 karakter']);
            return;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            error_log("Invalid email format");
            echo json_encode(['success' => false, 'message' => 'Format email tidak valid']);
            return;
        }
        
        // Cek koneksi database
        if (!$koneksi) {
            error_log("Database connection failed");
            echo json_encode(['success' => false, 'message' => 'Database connection failed']);
            return;
        }
        
        error_log("Database connection OK");
        
        // Cek email sudah terdaftar
        $stmt = $koneksi->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            error_log("Email already exists");
            echo json_encode(['success' => false, 'message' => 'Email sudah terdaftar']);
            return;
        }
        
        error_log("Email is available");
        
        // Hash password dan insert user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        error_log("Password hashed successfully");
        
        $stmt = $koneksi->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, 'user')");
        $result = $stmt->execute([$fullname, $email, $hashedPassword]);
        
        if (!$result) {
            error_log("Failed to insert user");
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data user']);
            return;
        }
        
        error_log("User registered successfully");
        
        echo json_encode([
            'success' => true, 
            'message' => 'Registrasi berhasil! Silakan login.',
            'redirect' => 'login.php'
        ]);
        
    } catch (Exception $e) {
        error_log("Register error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
    }
}

function handleLogout() {
    global $koneksi;
    
    try {
        error_log("Logout function called");
        
        // Update user_sessions status jika ada
        if (SapresSessionManager::isLoggedIn()) {
            $userData = SapresSessionManager::getUserData();
            try {
                $stmt = $koneksi->prepare("UPDATE user_sessions SET is_active = 0, last_activity = NOW() WHERE user_id = ? AND is_active = 1");
                $stmt->execute([$userData['user_id']]);
            } catch (Exception $e) {
                error_log("Session update error: " . $e->getMessage());
            }
        }
        
        // Destroy session
        SapresSessionManager::destroySession();
        
        echo json_encode([
            'success' => true, 
            'message' => 'Logout berhasil',
            'redirect' => 'login.php'
        ]);
        
    } catch (Exception $e) {
        error_log("Logout error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
    }
}
?>