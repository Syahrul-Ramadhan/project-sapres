<?php
    require_once 'php/check_login.php';
    // Get user info from session
    // $user_name = $_SESSION['fullname'];
    $user_id = $_SESSION['user_id'];

    include 'php/koneksi.php'; 

    $jumlahKategori = [
        'beasiswa' => 0,
        'lomba' => 0,
        'cari tim' => 0,
        'umum' => 0
    ];

    $sql_counts = "SELECT kategori, COUNT(*) as total FROM forum GROUP BY kategori";
    $stmt_counts = $koneksi->prepare($sql_counts);
    $stmt_counts->execute();
    $result_counts = $stmt_counts->fetchAll(PDO::FETCH_ASSOC);

    if (count($result_counts) > 0) {
        foreach ($result_counts as $row) {
            if (isset($jumlahKategori[$row['kategori']])) {
                $jumlahKategori[$row['kategori']] = $row['total'];
            }
        }
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
    <link rel="stylesheet" href="../assets/css/forum.css" />
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
        <?php if (isset($_SESSION['user_id'])): ?>
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

    <!-- FORUM START -->
    <div class="forum-container">
      <div class="forum-header">
        <div class="header-content">
          <img src="../assets/img/icons/forum.png" alt="Forum image" />
          <div class="tittle">
            <h5>Selamat Datang di</h5>
            <h4>Forum Samudra Prestasi</h4>
          </div>
        </div>
      </div>
      <div class="forum-body">
        <div class="container-button">
          <!-- <button
            class="how-to btn-chat-forum"
            href="forum-chat.php"
            data-category="how-to"
          >
            Cara Menggunakan Forum
          </button> -->
          <button class="how-to-btn" data-topic-id="how-to">Cara Menggunakan Forum</button>
          <button class="how-to-btn btn-chat-forum openModalBtn">Ajukan Pertanyaan</button>
        </div>
        <div class="forum-content">
          <div class="category-container">
            <h5>Kategori</h5>
            <div class="category-content">
              <a
                href="detailForum.php"
                class="beasiswa-forum"
                data-category="beasiswa"
              >
                <div class="tittle-forum">
                  <h4>Beasiswa</h4>
                  <span><?php echo $jumlahKategori['beasiswa']; ?></span>
                </div>
                <div class="desc-forum">
                  <img
                    src="../assets/img/icons/forum_beasiswa.png"
                    alt="Forum Beasiswa"
                  />
                  <p>
                    Tanya, diskusikan, dan bagikan pengalaman tentang beasiswa
                    yang tersedia!
                  </p>
                </div>
              </a>
              <a
                href="detailForum.php"
                class="lomba-forum"
                data-category="lomba"
              >
                <div class="tittle-forum">
                  <h4>Lomba</h4>
                  <span><?php echo $jumlahKategori['lomba']; ?></span>
                </div>
                <div class="desc-forum">
                  <img
                    src="../assets/img/icons/forum_lomba.png"
                    alt="Forum Lomba"
                  />
                  <p>
                    Bagikan pengalaman, cari rekomendasi, dan temukan peluang
                    kompetisi yang sesuai!
                  </p>
                </div>
              </a>
              <a href="detailForum.php" class="tim-forum" data-category="tim">
                <div class="tittle-forum">
                  <h4>Cari Tim</h4>
                  <span><?php echo $jumlahKategori['cari tim']; ?></span>
                </div>
                <div class="desc-forum">
                  <img
                    src="../assets/img/icons/forum_tim.png"
                    alt="Forum Tim"
                  />
                  <p>
                    Butuh tim untuk proyek, hackathon, atau startup? Posting di
                    sini dan temukan rekan yang tepat!
                  </p>
                </div>
              </a>
              <a href="detailForum.php" class="umum-forum" data-category="umum">
                <div class="tittle-forum">
                  <h4>Umum</h4>
                  <span><?php echo $jumlahKategori['umum']; ?></span>
                </div>
              </a>
            </div>
          </div>
          <div class="recently-container">
            <h5>Terbaru</h5>
            <div class="recently-content">
              <?php
                  $sql = "SELECT f.forum_id, f.pesan, f.tanggal_pesan, f.kategori, u.fullname, f.waktu_postingan 
                          FROM forum AS f 
                          JOIN users AS u ON f.user_id = u.user_id
                          WHERE f.parent_id IS NULL
                          ORDER BY f.waktu_postingan DESC";
                  $stmt = $koneksi->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  if (count($result) > 0) {
                      foreach($result as $row) {
                          $tanggal_formatted = date('d M Y', strtotime($row['tanggal_pesan']));
              ?>
                          <div class="question-items clickable-row" data-topic-id="<?php echo $row['forum_id']; ?>">
                              <span class="question"><?php echo htmlspecialchars($row['pesan']); ?></span>
                              <span class="date"><?php echo $tanggal_formatted; ?></span>
                          </div>
              <?php
                      } // Akhir loop
                  } else {
                      echo "<p style='text-align: center; color: #888;'>Belum ada pertanyaan terbaru di forum.</p>";
                  }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ajukan pertanyaan  -->
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

    <!-- FORUM END -->

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/forum.js"></script>
    <script src="../assets/js/auth.js"></script>
  </body>
</html>
