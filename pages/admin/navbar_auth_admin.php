<?php
require_once '../php/session_manager.php';
$isLoggedIn = SapresSessionManager::isLoggedIn();
$userData = SapresSessionManager::getUserData();
?>

<!-- Auth section untuk admin navbar -->
<?php if ($isLoggedIn): ?>
    <!-- Profile section - tampil jika sudah login -->
    <div class="profile-container" id="profile-section">
        <div class="profile-btn">
            <img src="../../assets/img/user_profile/user_profile.png" alt="User Profile" />
            <div class="dropdown-profile">
                <a href="dashboardAdmin.php">Dashboard</a>
                <a href="#" id="logout">Keluar</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <!-- Auth buttons - tampil jika belum login -->
    <div class="auth-buttons">
        <a href="../login.php" class="login-btn">MASUK</a>
        <a href="../register.php" class="btn-register">DAFTAR</a>
    </div>
<?php endif; ?>