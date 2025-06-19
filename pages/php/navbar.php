<?php
// Pastikan session sudah dimulai
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Cek login status
$isLoggedIn = SapresSessionManager::isLoggedIn();
$userData = null;

if ($isLoggedIn) {
    $userData = SapresSessionManager::getUserData();
}
?>

<!-- NAVBAR START -->
<nav class="navbar">
  <div class="nav-responsive">
    <div class="burger-menu"><span></span></div>
    <div class="logo"><a href="index.php">SaPres</a></div>
  </div>

  <div class="nav-content">
    <div class="menu-responsive">
      <ul>
        <li><a href="beasiswa.php">Beasiswa</a></li>
        <li><a href="lomba.php">Lomba</a></li>
        <li><a href="cariTim.php">Cari Tim</a></li>
        <li><a href="forum.php">Forum</a></li>
        <?php if (!$isLoggedIn): ?>
        <li><a href="login.php" class="auth-resp">MASUK</a></li>
        <li><a href="register.php" class="btn-register register-responsive auth-resp">DAFTAR</a></li>
        <?php endif; ?>
      </ul>
    </div>
    <div class="close-nav"></div>
    <div class="nav-menu">
      <ul class="nav-list">
        <li><a href="beasiswa.php">Beasiswa</a></li>
        <li><a href="lomba.php">Lomba</a></li>
        <li><a href="cariTim.php">Cari Tim</a></li>
        <li><a href="forum.php">Forum</a></li>
      </ul>
    </div>
  </div>
  
  <div class="search-container">
    <div class="search-bar">
      <input type="text" placeholder="Ketik nama beasiswa/lomba yang ingin kamu cari" />
    </div>
    <div class="search-btn">Cari</div>
  </div>
  
  <div class="nav-item">
    <div class="search-icon">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#333332" fill="none">
        <path d="M17.5 17.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
      </svg>
    </div>
    
    <?php if ($isLoggedIn): ?>
    <div class="profile-container" id="profile-section">
      <div class="profile-btn">
        <img src="../assets/img/user_profile/user_profile.png" alt="User Profile" />
        <div class="dropdown-profile">
          <a href="dashboard.php">Dashboard</a>
          <a href="#" id="logout">Keluar</a>
        </div>
      </div>
    </div>
    <?php else: ?>
    <div class="auth-buttons">
      <a href="login.php"><button class="btn btn-login">MASUK</button></a>
      <a href="register.php"><button class="btn btn-register">DAFTAR</button></a>
    </div>
    <?php endif; ?>
  </div>
</nav>
<!-- NAVBAR END -->