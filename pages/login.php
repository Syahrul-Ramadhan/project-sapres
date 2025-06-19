<?php
require_once 'php/session_manager.php';

// Redirect jika sudah login
if (SapresSessionManager::isLoggedIn()) {
    $userData = SapresSessionManager::getUserData();
    $redirectUrl = ($userData['role'] === 'admin') ? 'admin/dashboardAdmin.php' : 'dashboard.php';
    header("Location: $redirectUrl");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sapres</title>
    <link
      rel="icon"
      type="image/png"
      href="../assets/img/icons/forum_beasiswa.png"
    />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/auth.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
    <!-- NAVBAR START -->
    <nav class="navbar">
      <div class="nav-responsive">
        <div class="burger-menu">
          <span></span>
        </div>
        <div class="logo">
          <a href="index.php">SaPres</a>
        </div>
      </div>

      <div class="nav-content">
        <div class="menu-responsive">
          <ul>
            <li><a href="beasiswa.php">Beasiswa</a></li>
            <li><a href="lomba.php">Lomba</a></li>
            <li><a href="cariTim.php">Cari Tim</a></li>
            <li><a href="forum.php">Forum</a></li>
            <li><a href="login.php" class="auth-resp">MASUK</a></li>
            <li>
              <a
                href="register.php"
                class="btn-register register-responsive auth-resp"
                >DAFTAR</a
              >
            </li>
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
      <div class="nav-item">
        <?php if (SapresSessionManager::isLoggedIn()): ?>
          <?php $userData = SapresSessionManager::getUserData(); ?>
          <div
            class="profile-container"
            id="profile-section"
          >
            <div class="profile-btn">
              <img
                src="../assets/img/user_profile/user_profile.png"
                alt="User Profile"
              />
              <div class="dropdown-profile">
                <a href="dashboard.php">Dashboard</a>
                <a id="logout">Keluar</a>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div
            class="profile-container"
            id="profile-section"
            style="display: none"
          >
            <div class="profile-btn">
              <img
                src="../assets/img/user_profile/user_profile.png"
                alt="User Profile"
              />
              <div class="dropdown-profile">
                <a href="dashboard.php">Dashboard</a>
                <a id="logout">Keluar</a>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <?php if (!SapresSessionManager::isLoggedIn()): ?>
        <div class="auth-buttons">
          <a href="login.php"><button class="btn btn-login">MASUK</button></a>
          <a href="register.php"
            ><button class="btn btn-register">DAFTAR</button></a
          >
        </div>
      <?php else: ?>
        <div class="auth-buttons" style="display: none;">
          <a href="login.php"><button class="btn btn-login">MASUK</button></a>
          <a href="register.php"
            ><button class="btn btn-register">DAFTAR</button></a
          >
        </div>
      <?php endif; ?>
    </nav>
    <!-- NAVBAR END -->

    <main class="main-content">
      <div class="registration-container">
        <div class="form-section">
          <div class="form-header">
            <h1>Selamat Datang Kembali!</h1>
            <p>
              Selamat datang kembali di Luarkampus! Yuk masuk ke akun kamu agar
              bisa menggunakan fitur lengkap kami dan mendapatkan update
              informasi terbaru.
            </p>
          </div>

          <form id="login-form" class="register-form">
            <div class="input-fields">
              <div class="input-field">
                <label for="email">Email</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  placeholder="Masukkan email"
                  required
                />
              </div>
              <div class="input-field">
                <label for="password">Password</label>
                <div class="password-container">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                  />
                  <i class="fas fa-eye-slash toggle-password"></i>
                </div>
              </div>
            </div>

            <div class="button-group">
              <button type="submit" class="register-btn">MASUK</button>
            </div>
          </form>

          <div class="login-link">
            <span>Belum punya akun?</span>
            <a href="register.php">Daftar di sini</a>
          </div>
        </div>
        <div class="image-section">
          <div class="image-content">
            <h2>Akses Semua Fitur Sapres</h2>
            <p>
              Dapatkan informasi terbaru tentang beasiswa, lomba, dan temukan
              kolaborator untuk proyekmu.
            </p>
          </div>
        </div>
      </div>
    </main>

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- SCRIPT JS -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/auth.js"></script>
  </body>
</html>
