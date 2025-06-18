<?php
require_once 'php/koneksi.php'; // Pastikan koneksi database sudah benar
require_once 'php/session_manager.php';

// Ambil ID lomba dari URL
$lombaId = $_GET['id'] ?? 0;

if ($lombaId > 0) {
    try {
        // Ambil data lomba berdasarkan ID
        $sql = "SELECT * FROM lomba WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute([$lombaId]);
        $lomba = $stmt->fetch();

        // Jika data lomba ditemukan
        if (!$lomba) {
            echo "Lomba tidak ditemukan.";
            exit;
        }
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit;
    }
} else {
    echo "ID lomba tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Lomba - SAPRES</title>
    <link rel="icon" type="image/png" href="../assets/img/icons/forum_beasiswa.png" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/detailLomba.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
              <a id="logout" href="php/logout.php">Keluar</a>
            </div>
          </div>
        </div>
      </div>
       <?php else: ?>
      <div class="auth-buttons">
        <a href="login.php"><button class="btn btn-login">MASUK</button></a>
        <a href="register.php"
          ><button class="btn btn-register">DAFTAR</button></a
        >
      </div>
      <?php endif; ?>
    </nav>
    <!-- NAVBAR END -->

    <!-- MAIN CONTENT START -->
    <main class="main-content">
      <!-- Title Section with Bookmark and Share -->
      <div class="competition-title-container">
        <div class="competition-title-content">
          <h1><?php echo htmlspecialchars($lomba['title']); ?></h1>
          <div class="competition-actions">
            <button class="btn-bookmark">
              <i class="far fa-bookmark"></i>
              <span>Bookmark</span>
            </button>
            <button class="btn-share">
              <i class="fas fa-share-alt"></i>
              <span>Salin Tautan</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Competition Detail Content -->
      <div class="competition-detail-container">
        <div class="header-section">
          <div class="info-group">
            <div class="info-item">
              <h3>Jenjang</h3>
              <div class="info-detail">
                <i class="fas fa-graduation-cap"></i>
                <span><?php echo htmlspecialchars($lomba['level']); ?></span>
              </div>
            </div>

            <div class="info-item">
              <h3>Mulai</h3>
              <div class="info-detail">
                <i class="far fa-calendar-alt"></i>
                <span><?php echo (new DateTime($lomba['start_date']))->format('d M Y'); ?></span>
              </div>
            </div>

            <div class="info-item">
              <h3>Deadline</h3>
              <div class="info-detail">
                <i class="fas fa-clock"></i>
                <span><?php echo (new DateTime($lomba['deadline']))->format('d M Y'); ?></span>
              </div>
            </div>

            <div class="info-item">
              <h3>Penyelenggara</h3>
              <div class="info-detail">
                <i class="fas fa-building"></i>
                <span><?php echo htmlspecialchars($lomba['organizer']); ?></span>
              </div>
            </div>

            <div class="info-item">
              <h3>Biaya</h3>
              <div class="info-detail">
                <i class="fas fa-wallet"></i>
                <span><?php echo htmlspecialchars($lomba['cost']); ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content Section -->
        <div class="competition-content">
          <!-- Left: Image and Prize -->
          <div class="competition-image-prize">
            <img src="<?php echo htmlspecialchars($lomba['image_url']); ?>"  alt="Lomba Image" class="main-image" />
            <div class="prize-box">
              <p>Total Prize</p>
              <div class="prize"><?php echo htmlspecialchars($lomba['prizes']); ?></div>
            </div>
          </div>

          <!-- Right: Details -->
          <div class="competition-details">
            <h2><?php echo htmlspecialchars($lomba['title']); ?></h2>
            <div class="description-section">
              <h3>Deskripsi</h3>
              <p><?php echo nl2br(htmlspecialchars($lomba['description'])); ?></p>
            </div>

            <div class="timeline-box">
              <h3><i class="fas fa-calendar-week"></i> Timeline</h3>
              <ul class="timeline-list">
                <!-- Assume timeline data is available as an array -->
                <li>Workshop: <?php echo htmlspecialchars($lomba['start_date']); ?></li>
              </ul>
            </div>

            <div class="links-box">
              <div class="link-item">
                <span>Registration:</span>
                <a href="<?php echo htmlspecialchars($lomba['external_url']); ?>">Daftar Sekarang</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Sections like Requirements and Prizes if applicable -->
        <div class="requirements-section">
          <h3>Persyaratan</h3>
          <ul>
            <li><?php echo htmlspecialchars($lomba['requirements']); ?></li>
          </ul>
        </div>
      </div>
    </main>
    <!-- MAIN CONTENT END -->

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->
    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/detailLomba.js"></script>
  </body>
</html>
