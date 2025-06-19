<?php
require_once 'php/check_login.php';
include "php/koneksi.php";
require_once 'php/session_manager.php';
// Get user info from session
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];

// Ambil bookmark beasiswa
$stmt = $koneksi->prepare("SELECT b.* FROM bookmarks bm JOIN beasiswa b ON bm.item_id = b.beasiswa_id WHERE bm.user_id = ? AND bm.item_type = 'beasiswa'");
$stmt->execute([$user_id]);
$bookmarkedBeasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil bookmark lomba
$stmt = $koneksi->prepare("SELECT l.* FROM bookmarks bm JOIN lomba l ON bm.item_id = l.id WHERE bm.user_id = ? AND bm.item_type = 'lomba'");
$stmt->execute([$user_id]);
$bookmarkedLomba = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - <?php echo htmlspecialchars($user_name); ?></title>
    <link
      rel="icon"
      type="image/png"
      href="../assets/img/icons/forum_beasiswa.png"
    />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
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

    <!-- DASHBOARD START -->
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h2><?php echo htmlspecialchars($user_name); ?></h2>
        <div class="dashboard-links">
          <a data-category="beasiswa" class="active">Beasiswa Tersimpan</a>
          <a data-category="lomba">Lomba Tersimpan</a>
          <a data-category="tim">Tim yang Diikuti</a>
          <a data-category="notifikasi">Notifikasi</a>
        </div>
      </div>
      <div class="dashboard-content">
        <div
          class="content-section"
          data-category="beasiswa"
          style="display: flex"
        >
          <div class="dashboard-sidebar">
            <ul>
              <li class="active">Semua</li>
            </ul>
          </div>
          <div class="beasiswa-list">
            <?php foreach ($bookmarkedBeasiswa as $beasiswa): ?>
            <a href="detailBeasiswa.php?id=<?= $beasiswa['beasiswa_id'] ?>" class="beasiswa-card-md">
              <div class="card-content">
                <div class="head-card">
                  <div class="degrees">
                    <?php 
                        $jenjang = explode(',', $beasiswa['jenjang_beasiswa']); 
                        foreach ($jenjang as $j): ?>
                        <span class="degree"><?= htmlspecialchars(trim($j)) ?></span>
                    <?php endforeach; ?>
                  </div>
                  <div class="bookmark">
                    <div class="bookmark-btn">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                        color="#333332"
                        fill="none"
                      >
                        <path
                          d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                          stroke="currentColor"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="body-card">
                  <h2 class="title">
                    <?= htmlspecialchars($beasiswa['judul_beasiswa']) ?>
                  </h2>
                  <p class="location"><?= htmlspecialchars($beasiswa['lokasi_beasiswa']) ?></p>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: <?= date('d M Y', strtotime($beasiswa['mulai_beasiswa'])) ?></p>
                  <p class="deadline">Deadline: <?= date('d M Y', strtotime($beasiswa['penutupan_beasiswa'])) ?></p>
                </div>
              </div>
            </a>
            <a href="detailBeasiswa.php?id=<?= $beasiswa['beasiswa_id'] ?>" class="beasiswa-card">
              <div class="card-info">
                <div class="degrees">
                    <?php 
                        $jenjang = explode(',', $beasiswa['jenjang_beasiswa']); 
                        foreach ($jenjang as $j): ?>
                        <span class="degree"><?= htmlspecialchars(trim($j)) ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: <?= date('d M Y', strtotime($beasiswa['mulai_beasiswa'])) ?></p>
                  <p class="deadline">Deadline: <?= date('d M Y', strtotime($beasiswa['penutupan_beasiswa'])) ?></p>
                </div>
              </div>
              <div class="card-content">
                <div class="head-card">
                  <h2 class="title">
                    <?= htmlspecialchars($beasiswa['judul_beasiswa']) ?>
                  </h2>
                  <p class="location"><?= htmlspecialchars($beasiswa['lokasi_beasiswa']) ?></p>
                </div>
                <div class="bookmark">
                  <div class="bookmark-btn">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      width="24"
                      height="24"
                      color="#333332"
                      fill="none"
                    >
                      <path
                        d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <div
          class="content-section"
          data-category="lomba"
          style="display: none"
        >
          <div class="dashboard-sidebar">
            <ul>
              <li class="active">Semua</li>
            </ul>
          </div>
          <div class="beasiswa-list">
            <?php foreach ($bookmarkedLomba as $lomba): ?>
            <a href="detailLomba.php?id=<?= $lomba['id'] ?>" class="beasiswa-card-md">
              <div class="card-content">
                <div class="head-card">
                  <div class="degrees">
                    <?php 
                        $jenjang = explode(',', $lomba['level']); 
                        foreach ($jenjang as $j): ?>
                        <span class="degree"><?= htmlspecialchars(trim($j)) ?></span>
                    <?php endforeach; ?>
                  </div>
                  <div class="bookmark">
                    <div class="bookmark-btn">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                        color="#333332"
                        fill="none"
                      >
                        <path
                          d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                          stroke="currentColor"
                          stroke-width="1.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="body-card">
                  <h2 class="title">
                    <?= htmlspecialchars($lomba['title']) ?>
                  </h2>
                  <p class="location"><?= htmlspecialchars($lomba['scope']) ?></p>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: <?= date('d M Y', strtotime($lomba['start_date'])) ?></p>
                  <p class="deadline">Deadline: <?= date('d M Y', strtotime($lomba['deadline'])) ?></p>
                </div>
              </div>
            </a>
            <a href="detailLomba.php?id=<?= $lomba['id'] ?>" class="beasiswa-card">
              <div class="card-info">
                <div class="degrees">
                    <?php 
                        $jenjang = explode(',', $lomba['level']); 
                        foreach ($jenjang as $j): ?>
                        <span class="degree"><?= htmlspecialchars(trim($j)) ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: <?= date('d M Y', strtotime($lomba['start_date'])) ?></p>
                  <p class="deadline">Deadline: <?= date('d M Y', strtotime($lomba['deadline'])) ?></p>
                </div>
              </div>
              <div class="card-content">
                <div class="head-card">
                  <h2 class="title">
                    <?= htmlspecialchars($lomba['title']) ?>
                  </h2>
                  <p class="location"><?= htmlspecialchars($lomba['scope']) ?></p>
                </div>
                <div class="bookmark">
                  <div class="bookmark-btn">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      width="24"
                      height="24"
                      color="#333332"
                      fill="none"
                    >
                      <path
                        d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="content-section" data-category="tim" style="display: none">
          <div class="dashboard-sidebar">
            <ul>
              <li class="active" data-status="Semua">Semua</li>
            </ul>
          </div>
          <div class="team-list">
            <?php 

    try {
        // Menjalankan stored procedure untuk mendapatkan daftar tim yang terkait dengan user
        $stmt = $koneksi->prepare("CALL GetTimByUserId(?)");
        $stmt->execute([$user_id]);

        // Mendapatkan hasil daftar tim
        $timData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Memeriksa apakah ada data tim yang ditemukan
        if (count($timData) > 0) {
            foreach ($timData as $tim) {
                ?>
                <div class="card-fteam" data-id="<?= $tim['tim_id'] ?>"
                     data-nama="<?= $tim['nama_tim'] ?>"
                     data-judul="<?= $tim['judul_lomba'] ?>"
                     data-link="<?= $tim['link'] ?>"
                     data-instansi="<?= $tim['asal_instansi'] ?>"
                     data-created="<?= date('d M Y', strtotime($tim['created_at'])) ?>"
                     data-status="<?= $tim['status'] ?>">
                    <div class="head-card">
                        <h3><?= htmlspecialchars($tim['kategori_lomba']) ?></h3>
                        <p><?= htmlspecialchars($tim['judul_lomba']) ?></p>
                        <p><strong><?= htmlspecialchars($tim['status']) ?></strong></p>
                        <div class="info-uni">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#333332" fill="none">
                                <path d="M6.57757 15.4816C5.1628 16.324 1.45336 18.0441 3.71266 20.1966C4.81631 21.248 6.04549 22 7.59087 22H16.4091C17.9545 22 19.1837 21.248 20.2873 20.1966C22.5466 18.0441 18.8372 16.324 17.4224 15.4816C14.1048 13.5061 9.89519 13.5061 6.57757 15.4816Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            <span><?= htmlspecialchars($tim['asal_instansi']) ?></span>
                        </div>
                    </div>
                    <div class="body-card">
                        <p><?= htmlspecialchars($tim['deskripsi']) ?></p>
                    </div>
                    <div class="foot-card">
                        <div class="profile-team">
                            <div class="detail-info">
                                <span class="team-name"><?= htmlspecialchars($tim['nama_tim']) ?></span>
                                <span class="date-team"><?= htmlspecialchars(date("d M Y", strtotime($tim['created_at']))) ?></span>
                            </div>
                        </div>
                        <div class="card-btn" onclick="openPopUp(<?= $tim['tim_id'] ?>)">Detail Info</div>
                    </div>
                </div>
                <?php 
            }
        } else {
            // Jika tidak ada data tim yang ditemukan
            echo "<p>No data found for the selected status filter.</p>";
        }
    } catch (Exception $e) {
        // Menangani error jika terjadi
        echo "Error: " . $e->getMessage();
    }
    ?>
              
          </div>
        </div>
        <div class="content-section" data-category="notifikasi" style="display: none">
  <div class="dashboard-sidebar">
    <ul>
      <li class="active">Semua</li>
    </ul>
  </div>

  <div class="notifikasi-list">
    <?php
      // Ambil status notifikasi yang dipilih
      $status_baca = isset($_GET['status_baca']) ? $_GET['status_baca'] : 'belum_dibaca'; // Default ke 'belum_dibaca'

      // Query untuk mengambil notifikasi berdasarkan status_baca
      $stmt = $koneksi->prepare("SELECT * FROM notifikasi WHERE user_id = ? AND status_baca = ? ORDER BY created_at DESC");
      $stmt->execute([$user_id, $status_baca]);
      $notifs = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Menampilkan notifikasi
      foreach ($notifs as $notif):
    ?>
      <div class="notif-item">
        <p><?= htmlspecialchars($notif['pesan']) ?></p>
        <a href="proses/proses_respon_gabung.php?tim_id=<?= $notif['terkait_tim_id'] ?>&user_id=<?= $notif['dari_user_id'] ?>&aksi=terima" class="btn-accept">Terima</a>
        <a href="proses/proses_respon_gabung.php?tim_id=<?= $notif['terkait_tim_id'] ?>&user_id=<?= $notif['dari_user_id'] ?>&aksi=tolak" class="btn-reject">Tolak</a>
        <p><small>Waktu: <?= date('d M Y H:i', strtotime($notif['created_at'])) ?></small></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>
      </div>
    </div>
    
    <!-- Pop-up Modal -->
    <div id="popup-modal" class="popup-modal" style="display: none;">
      <div class="popup-content">
        <span class="popup-close" onclick="closePopUp()">×</span>
        <h3 id="modal-title">Judul Tim</h3>
        <p><strong>Instansi:</strong> <span id="modal-instansi"></span></p>
        <p><strong>Link Grup:</strong> <span id="modal-link"></span></p>
        <p><strong>Status:</strong> <span id="modal-status"></span></p>
        <p><strong>Created At:</strong> <span id="modal-created"></span></p>
      </div>
    </div>
    <!-- DASHBOARD END -->

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/auth.js"></script>
    <script src="../assets/js/dashboard.js"></script>
  </body>
</html>
