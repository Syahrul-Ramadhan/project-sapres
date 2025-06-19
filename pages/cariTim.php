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
    <link rel="stylesheet" href="../assets/css/cariTim.css" />
  </head>
  <body>

    <?php
      require_once 'php/session_manager.php';
      include "php/koneksi.php";
      require_once 'php/check_login.php';
      $user_id = $_SESSION['user_id'];
      
      
      // Pagination setup
      $limit = 9;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      if ($page < 1) $page = 1;
      $offset = ($page - 1) * $limit;

      // Query SQL untuk mengambil data tim dengan ranking berdasarkan tanggal dibuat
      $sql = "
        SELECT * FROM (
          SELECT 
            t.*, 
            RANK() OVER (ORDER BY t.created_at DESC) AS ranking
          FROM tim t
        ) AS ranked_tim
        LIMIT :limit OFFSET :offset
      ";
      $stmt = $koneksi->prepare($sql); // Menyiapkan statement PDO

      // Mengikat parameter untuk pagination
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

      // Menjalankan query
      $stmt->execute();

      // Mengambil hasil
      $timData = $stmt->fetchAll();

      // Query untuk hitung total data
      $totalStmt = $koneksi->prepare("SELECT COUNT(*) as total FROM tim");
      $totalStmt->execute();

      // Mengambil total data
      $totalData = $totalStmt->fetch()['total'];
      $totalPages = ceil($totalData / $limit); // Menghitung total halaman
    ?>

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
    <!-- MAIN START -->
    <div class="main-container">

      <!-- MAIN CONTENT START -->
      <div class="main-content">
        <!-- DAFTAR TIM START -->
        <div class="team-container">
          <h3>Cari Tim yang Cocok untukmu!</h3>

          <div class="team-wrap">
            <div class="team-list">
              <?php foreach ($timData as $data): ?>
              <div class="card-fteam" data-id="<?= $data['tim_id'] ?>" data-nama="<?= $data['nama_tim'] ?>" data-judul="<?= $data['judul_lomba'] ?>"
                data-jenis="<?= $data['kategori_lomba'] ?>" data-instansi="<?= $data['asal_instansi'] ?>"
                data-deskripsi="<?= $data['deskripsi'] ?>" data-syarat="<?= $data['syarat_ketentuan'] ?>"
                data-created="<?= date('d M Y', strtotime($data['created_at'])) ?>"
                data-cekktm="<?= $data['cek_ktm'] ?>">
                <div class="head-card">
                  <h3><?= htmlspecialchars($data['kategori_lomba'])?></h3>
                  <p><?= htmlspecialchars($data['judul_lomba']) ?></p>
                  <div class="info-uni">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      width="24"
                      height="24"
                      color="#333332"
                      fill="none"
                    >
                      <path
                        d="M6.57757 15.4816C5.1628 16.324 1.45336 18.0441 3.71266 20.1966C4.81631 21.248 6.04549 22 7.59087 22H16.4091C17.9545 22 19.1837 21.248 20.2873 20.1966C22.5466 18.0441 18.8372 16.324 17.4224 15.4816C14.1048 13.5061 9.89519 13.5061 6.57757 15.4816Z"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z"
                        stroke="currentColor"
                        stroke-width="1.5"
                      />
                    </svg>
                    <span><?= htmlspecialchars($data['asal_instansi']) ?></span>
                  </div>
                </div>
                <div class="body-card">
                  <p>
                    <?= htmlspecialchars($data['deskripsi']) ?>
                  </p>
                </div>
                <div class="foot-card">
                  <div class="profile-team">
                    <div class="detail-info">
                      <span class="team-name"><?= htmlspecialchars($data['nama_tim']) ?></span>
                      <span class="date-team"><?= htmlspecialchars(date('d M Y', strtotime($data['created_at']))) ?></span>
                    </div>
                  </div>
                  <div class="card-btn" onclick="openPopUp(this)">Bergabung</div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="buat-tim">+ Buat Tim</div>
        <div class="pagination">
          <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="pagination-btn">&laquo;</a>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" <?= $i === $page ? 'style="font-weight: bold; background-color: #205781; color: white;"' : '' ?> class="pagination-btn"><?= $i ?></a>
          <?php endfor; ?>

          <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" class="pagination-btn">&raquo;</a>
          <?php endif; ?>
        </div>
        <!-- DAFTAR TIM END -->
      </div>

      <!-- MAIN CONTENT END -->
    </div>
    <!-- MAIN END -->

    <!-- POP UP JOIN TEAM START -->
    <div class="pop-up-container">
      <form class="pop-up-content" action="proses/prosesAjukanGabung.php" method="post">
        <div class="close-pop-up">
          <div class="close-pop-up-btn">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </div>
        </div>
        <div class="detail-info-team">
          <span class="title" id="pop-up-title">UI/UX Designer</span>
          <span class="lomba" id="pop-up-lomba">Techcomfest 2026</span>
          <span class="univ" id="pop-up-univ">Universitas Pendidikan Indonesia</span>
          <input type="hidden" name="tim_id" id="tim_id_input" />
        </div>
        <div class="req">
          <h4>Syarat dan Ketentuan:</h4>
          <ul id="pop-up-syarat">
            <li>Mahasiswa Universitas Pendidikan Indonesia</li>
            <li>Semester 1-5</li>
          </ul>
          <div class="file-up">
            <div class="ktm">
              <label for="ktm-upload" class="upload-label">Upload KTM</label>
              <input
                type="file"
                id="ktm-upload"
                accept=".jpg, .jpeg, .png, .pdf"
              />
            </div>
            <span id="file-name">Tidak ada file dipilih</span>
          </div>
        </div>
        <button type="submit" class="confirm-btn">Ajukan Permintaan Bergabung</button>
      </form>
    </div>
    <div class="background-pop-up"></div>
    <div class="custom-notification">
      Permintaan bergabung berhasil dikirim!
    </div>
    <!-- POP UP JOIN TEAM END -->

    <!-- CREATE TEAM START --> 
    <div class="create-team-container">
      <div class="create-team-content">
        <div class="close-create-team-btn">
          <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
          </svg>
        </div>
        <h3>Buat Tim Baru</h3>
    <form action="proses/prosesInsertTim.php" method="post" id="createTeamForm">
      <table>
        <tr>
          <td><label for="nama_tim">Nama Tim</label></td>
          <td><input type="text" id="nama_tim" name="nama_tim" required /></td>
        </tr>
        <tr>
          <td><label for="jumlah_anggota">Jumlah Anggota</label></td>
          <td><input type="text" id="jumlah_anggota" name="jumlah_anggota" required /></td>
        </tr>
        <tr>
          <td><label for="jenjang_tim">Jenjang Tim</label></td>
          <td>
            <input type="checkbox" name="jenjang_tim[]" value="SMP"> SMP
            <input type="checkbox" name="jenjang_tim[]" value="SMA"> SMA
            <input type="checkbox" name="jenjang_tim[]" value="S1"> S1
            <input type="checkbox" name="jenjang_tim[]" value="S2"> S2
            <input type="checkbox" name="jenjang_tim[]" value="S3"> S3
            <input type="checkbox" name="jenjang_tim[]" value="D3"> D3 <br>
            <input type="checkbox" name="jenjang_tim[]" value="D4"> D4
            <input type="checkbox" name="jenjang_tim[]" value="Non-degree"> Non-Degree
            <input type="checkbox" name="jenjang_tim[]" value="Gap-year"> Gap Year <br>
            <input type="checkbox" name="jenjang_tim[]" value="Profesi"> Profesi
          </td>
        </tr>
        <tr>
          <td><label for="judul_lomba">Judul Lomba</label></td>
          <td><input type="text" id="judul_lomba" name="judul_lomba" required /></td>
        </tr>
        <tr>
          <td><label for="tipe_lomba">Kategori Lomba</label></td>
          <td><input type="text" name="kategori_lomba" id="kategori_lomba" required /></td>
        </tr>
        <tr>
          <td><label for="asal_instansi">Asal Instansi</label></td>
          <td><input type="text" id="asal_instansi" name="asal_instansi" required /></td>
        </tr>
        <tr>
          <td><label for="deskripsi">Deskripsi Tim</label></td>
          <td><textarea id="deskripsi" name="deskripsi" rows="4" required></textarea></td>
        </tr>
        <tr>
          <td><label for="syarat_ketentuan">Syarat dan Ketentuan</label></td>
          <td><textarea id="syarat_ketentuan" name="syarat_ketentuan" rows="4" required></textarea></td>
        </tr>
        <tr>
          <td><label for="cek_ktm">Cek KTM</label></td>
          <td><input type="checkbox" name="cek_ktm" value="perlu_ktm"> Perlu KTM</td>
        </tr>
        <tr>
          <td><label for="link">Link Pendaftaran</label></td>
          <td><input type="text" id="link" name="link" required /></td>
        </tr>
        <tr>
          <td colspan="2">
            <button type="submit" name="create_team" class="btn btn-create-team">Buat Tim</button>
          </td>
        </tr>
      </table>
    </form>
      </div>
    </div>
    <!-- CREATE TEAM END -->

    <!-- FOOTER START -->
    <?php 
    include 'php/footer.php'; ?>
    <!-- FOOTER END -->
    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/cariTim.js"></script>
    <script src="../assets/js/filter.js"></script>
  </body>
</html>
