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
      <div class="search-container">
        <div class="search-bar">
          <input
            type="text"
            placeholder="Ketik nama beasiswa/lomba yang ingin kamu cari"
          />
        </div>
        <div class="search-btn">Cari</div>
      </div>
      <div class="nav-item">
        <div class="search-icon">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            color="#333332"
            fill="none"
          >
            <path
              d="M17.5 17.5L22 22"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <?php if (SapresSessionManager::isLoggedIn()): ?>
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

            <div class="remember-forgot">
              <div class="terms-checkbox">
                <input type="checkbox" id="remember" />
                <label for="remember">Ingat saya</label>
              </div>
              <a href="#" class="forgot-password">Lupa password?</a>
            </div>

            <div class="button-group">
              <button type="submit" class="register-btn">MASUK</button>
              <div class="divider">
                <span>atau</span>
              </div>
              <button type="button" class="google-btn">
                <img src="../assets/images/google-icon.png" alt="Google" />
                <span>MASUK DENGAN GOOGLE</span>
              </button>
            </div>
          </form>

          <div class="login-link">
            <span>Belum punya akun?</span>
            <a href="register.php">Daftar di sini</a>
          </div>
        </div>
        <div class="image-section">
          <div class="image-content">
            <h2>Akses Semua Fitur Luarkampus</h2>
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
