<?php
// Simple session check - redirect if already logged in
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
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
      </div>
      <div class="auth-buttons">
        <a href="login.php"><button class="btn btn-login">MASUK</button></a>
        <a href="register.php"
          ><button class="btn btn-register">DAFTAR</button></a
        >
      </div>
    </nav>
    <!-- NAVBAR END -->

    <main class="main-content">
      <div class="registration-container">
        <div class="form-section">
          <div class="form-header">
            <h1>Buat Akun Sekarang Yuk!</h1>
            <p>
              Ayo buat akun Luarkampus agar kamu bisa menggunakan fitur lengkap
              kami dan mendapatkan update informasi terbaru.
            </p>
          </div>

          <form id="register-form" class="register-form" method="post">
            <div class="input-fields">
              <div class="input-field">
                <label for="fullname">Nama Lengkap</label>
                <input
                  type="text"
                  id="fullname"
                  placeholder="Masukkan nama lengkap"
                  required
                />
              </div>
              <div class="input-field">
                <label for="email">Email</label>
                <input
                  type="email"
                  id="email"
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
                    placeholder="Buat password"
                    required
                  />
                  <i class="fas fa-eye-slash toggle-password"></i>
                </div>
              </div>
              <div class="input-field">
                <label for="confirm-password">Konfirmasi Password</label>
                <div class="password-container">
                  <input
                    type="password"
                    id="confirm-password"
                    placeholder="Ulangi password"
                    required
                  />
                  <i class="fas fa-eye-slash toggle-password"></i>
                </div>
              </div>
            </div>

            <div class="terms-checkbox">
              <input type="checkbox" id="terms" required />
              <label for="terms"
                >Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan
                <a href="#">Kebijakan Privasi</a></label
              >
            </div>

            <div class="button-group">
              <button class="register-btn" type="submit">DAFTAR</button>
            </div>
          </form>

          <div class="login-link">
            <span>Sudah punya akun?</span>
            <a href="login.php">Masuk di sini</a>
          </div>
        </div>
        <div class="image-section">
          <div class="image-content">
            <h2>Temukan Peluang Terbaik untuk Masa Depanmu</h2>
            <p>
              Akses informasi beasiswa, lomba, dan temukan tim untuk kolaborasi
              proyek.
            </p>
          </div>
        </div>
      </div>
    </main>

    <?php include 'php/footer.php'; ?>

    <!-- SCRIPT JS -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/auth.js"></script>
  </body>
</html>
