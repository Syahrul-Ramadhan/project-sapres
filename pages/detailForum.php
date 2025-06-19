<?php
// =================================================================
// LANGKAH 1: PERSIAPAN DAN PENGAMBILAN DATA YANG DIOPTIMALKAN
// =================================================================
session_start();
include 'php/koneksi.php'; // Sesuaikan path jika perlu
require_once 'php/session_manager.php';

// Definisikan kategori dengan pemetaan ke nilai database
$categories = [
    'beasiswa' => ['title' => 'BEASISWA', 'desc' => 'Tanya, diskusikan, dan bagikan pengalaman tentang beasiswa yang ada!', 'db_value' => 'beasiswa'],
    'lomba' => ['title' => 'LOMBA', 'desc' => 'Bagikan pengalaman, cari rekomendasi, dan temukan peluang kompetisi yang sesuai!', 'db_value' => 'lomba'],
    'tim' => ['title' => 'CARI TIM', 'desc' => 'Butuh tim untuk proyek, hackathon, atau startup? Posting di sini dan temukan rekan yang tepat!', 'db_value' => 'cari tim'],
    'umum' => ['title' => 'UMUM', 'desc' => 'Pertanyaan umum, diskusi, dan berbagi pengalaman!', 'db_value' => 'umum']
];

$forumData = [];
foreach (array_keys($categories) as $kategori_key) {
    $forumData[$kategori_key] = [];
}

$sql = "SELECT 
            f.forum_id, f.pesan, f.kategori, f.waktu_postingan, u.fullname,
            (SELECT COUNT(*) FROM forum WHERE parent_id = f.forum_id) AS jumlah_jawaban
        FROM forum AS f 
        JOIN users AS u ON f.user_id = u.user_id
        WHERE f.parent_id IS NULL
        ORDER BY f.waktu_postingan DESC";

$stmt = $koneksi->query($sql);

if ($stmt && $stmt->rowCount() > 0) {
    // Gunakan logika pengelompokan yang sudah disesuaikan
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        foreach ($categories as $key => $details) {
            if ($details['db_value'] === $row['kategori']) {
                $forumData[$key][] = $row;
                break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Forum - Sapres</title>
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
    
    <main class="section-container">
      <?php
      // =================================================================
      // LANGKAH 2: GUNAKAN LOOP UNTUK MENAMPILKAN SEMUA KATEGORI
      // =================================================================
      foreach ($categories as $kategori_key => $details):
      ?>
        <section class="section-content" data-category="<?= $kategori_key ?>">
          <div class="header-container <?= str_replace(' ', '', $kategori_key) ?>">
            <div class="header-content">
              <h3 class="tittle"><?= $details['title'] ?></h3>
              <span class="desc"><?= $details['desc'] ?></span>
            </div>
          </div>
          <div class="body-container">
            <div class="container-button">
              <button class="how-to-btn" data-topic-id="how-to">Cara Menggunakan Forum</button>
              <button class="how-to-btn btn-chat-forum openModalBtn" data-kategori="<?= $kategori_key ?>">Ajukan Pertanyaan</button>
            </div>
            <table class="question-table">
              <thead>
                <tr class="question-header">
                  <th class="topic">Topik</th>
                  <th>Jawaban</th>
                  <th>Diperbarui</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($forumData[$kategori_key])): ?>
                  <tr>
                    <td colspan="3" style="text-align: center; padding: 20px;">Belum ada topik di kategori ini.</td>
                  </tr>
                <?php else: ?>
                    <?php foreach ($forumData[$kategori_key] as $post): ?>
                      <tr class="question-content" data-topic-id="<?= $post['forum_id']; ?>">
                        <td class="question"><?= htmlspecialchars($post['pesan']); ?></td>
                        <td><?= $post['jumlah_jawaban']; // Data sudah siap, tidak perlu query lagi ?></td>
                        <td><?= date('d M Y', strtotime($post['waktu_postingan'])); ?></td>
                      </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>
      <?php endforeach; ?>
        
      <div id="ajukanModal" class="modal-overlay">
          <div class="form-container">
            <span class="close-modal" id="closeModalBtn">&times;</span>
            <h2>Ajukan Pertanyaan</h2>
            <form method="POST" id="formAjukan">
              <label for="kategori">Pilih Kategori:</label>
              <select name="kategori" id="kategori" required>
                <option value="">-- Pilih --</option>
                <option value="beasiswa">Beasiswa</option>
                <option value="lomba">Lomba</option>
                <option value="cari tim">Cari Tim</option>
                <option value="umum">Umum</option>
              </select>

              <label for="pesan">Isi Pertanyaan:</label>
              <textarea name="pesan" id="pesan" rows="5" required placeholder="Tulis pertanyaanmu..."></textarea>

              <button type="submit">Kirim Pertanyaan</button>
            </form>
          </div>
        </div>
    </main>

    <?php include 'php/footer.php'; ?>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/forum.js"></script>
  </body>
</html>
