  <?php
  session_start();

  include 'php/koneksi.php';
  require_once 'php/session_manager.php';

  $topicId = $_GET['topic'] ?? '';
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sapres</title>
    <link rel="icon" type="image/png" href="../assets/img/icons/forum_beasiswa.png" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/detailForum.css" />
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
  <main>
    <?php
    if (!$topicId) {
      echo "<p>Topik tidak ditemukan.</p>";
    } elseif ($topicId === 'how-to') {
      ?>
      <section class="post-section">
        <div class="post-container">
          <div class="post-header">
            <img src="../assets/img/profile-forum/user-aditya.png" alt="Avatar Admin Sapres" />
            <div class="post-desc">
              <h2>Admin Sapres</h2>
              <span class="date">13 Jan 2025</span>
            </div>
          </div>
          <div class="post-content">
            <p>Halo Sobat SAPRES! Selamat datang di Forum SAPRES, tempat berbagi informasi dan berdiskusi seputar beasiswa, lomba, dan mencari tim.</p>
            <ul>
              <li>Gunakan Bahasa Indonesia yang baik dan sopan.</li>
              <li>Saling mendukung satu sama lain.</li>
              <li>Sebelum bertanya, coba cari solusi terlebih dahulu.</li>
              <li>Pastikan pertanyaan jelas dan sesuai kategori.</li>
              <li>Laporkan konten yang melanggar aturan forum.</li>
            </ul>
            <p>Moderator berhak mencabut akses jika:</p>
            <ul>
              <li>Menggunakan bahasa kasar, menyebar hoax, atau melanggar hukum.</li>
              <li>Posting konten tidak pantas, seperti SARA atau pornografi.</li>
            </ul>
            <p>Selamat berdiskusi dan berkembang bersama di Forum SAPRES!</p>
          </div>
        </div>
      </section>
      <?php
    } else {
      $forum_id = intval($topicId);

      $queryTopik = "SELECT f.*, u.fullname
                    FROM forum f
                    JOIN users u ON f.user_id = u.user_id
                    WHERE f.forum_id = :forum_id";
      $stmtTopik = $koneksi->prepare($queryTopik);
      $stmtTopik->execute(['forum_id' => $forum_id]);
      $topik = $stmtTopik->fetch();

      if (!$topik) {
        echo "<p>Topik tidak ditemukan.</p>";
      } else {
      ?>
        <section class="post-section">
          <div class="post-container">
            <div class="post-header">
              <img src="../assets/img/profile-forum/user-aditya.png" alt="Avatar <?= htmlspecialchars($topik['fullname']) ?>" />
              <div class="post-desc">
                <h2><?= htmlspecialchars($topik['fullname']) ?></h2>
                <span class="date"><?= date('d M Y', strtotime($topik['waktu_postingan'])) ?></span>
              </div>
            </div>
            <div class="post-content">
              <p><?= htmlspecialchars($topik['pesan']) ?></p>
            </div>
            <div class="komentar-section">
              <?php
              $queryKomentar = "SELECT f.*, u.fullname
                FROM forum f 
                JOIN users u ON f.user_id = u.user_id
                WHERE f.parent_id = :forum_id
                ORDER BY f.waktu_postingan ASC";
              $stmtKomentar = $koneksi->prepare($queryKomentar);
              $stmtKomentar->execute(['forum_id' => $forum_id]);
              $komentarList = $stmtKomentar->fetchAll(PDO::FETCH_ASSOC);

              foreach ($komentarList as $kom) {
                echo "<div class='komentar'>
                        <p><strong>" . htmlspecialchars($kom['fullname']) . ":</strong> " . htmlspecialchars($kom['pesan']) . "</p>
                        <small>" . htmlspecialchars(date('d M Y, H:i', strtotime($kom['waktu_postingan']))) . "</small>
                      </div>";
              }
              ?>
            </div>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
              <form id="formKomentar" method="POST" action="kirim_komentar.php" autocomplete="off">
                <input type="hidden" name="parent_id" value="<?= $forum_id ?>">
                <input type="hidden" name="id_penanya" value="<?= $topik['user_id'] ?>">
                <textarea name="pesan" required></textarea>
                <button type="submit">Kirim Balasan</button>
              </form>
            <?php else: ?>
              <p><em>Login terlebih dahulu untuk mengirim komentar.</em></p>
            <?php endif; ?>
          </div>
        </section>
        <?php
      }
    }
    ?>
  </main>
  <?php include 'php/footer.php'; ?>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/forum.js"></script>
</body>
</html>
