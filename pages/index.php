<?php
require_once 'php/session_manager.php';
require_once 'php/check_login.php';
// Get user info from session
$user_name = $_SESSION['fullname'];
$user_id = $_SESSION['user_id'];

// Koneksi ke database
require_once 'php/koneksi.php';

// Mengambil data beasiswa
$stmt_beasiswa = $koneksi->prepare("SELECT * FROM beasiswa  LIMIT 5");
$stmt_beasiswa->execute();
$beasiswa = $stmt_beasiswa->fetchAll(PDO::FETCH_ASSOC);

// Mengambil data lomba
$stmt_lomba = $koneksi->prepare("SELECT * FROM lomba LIMIT 5");
$stmt_lomba->execute();
$lomba = $stmt_lomba->fetchAll(PDO::FETCH_ASSOC);

// Mengambil data tim
$stmt_tim = $koneksi->prepare("SELECT * FROM tim LIMIT 5");
$stmt_tim->execute();
$tim = $stmt_tim->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapres</title>
    <link
      rel="icon"
      type="image/png"
      href="../assets/img/icons/forum_beasiswa.png"
    />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/home.css" />
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
        <!-- CAROUSEL START -->
    <div class="carousel-container">
      <div class="prev-btn">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
          color="#333332"
          fill="none"
        >
          <path
            d="M15 6C15 6 9.00001 10.4189 9 12C8.99999 13.5812 15 18 15 18"
            stroke="currentColor"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </div>
      <div class="carousel">
        <div class="slide">
          <img
            src="../assets/img/Poster home/Beasiswa.png"
            alt="Poster Beasiswa"
          />
        </div>
        <div class="slide">
          <img src="../assets/img/Poster home/Lomba.png" alt="Poster Lomba" />
        </div>
        <div class="slide">
          <img
            src="../assets/img/Poster home/Cari Tim.png"
            alt="Poster Cari Tim"
          />
        </div>
        <div class="slide">
          <img src="../assets/img/Poster home/Forum.png" alt="Poster Forum" />
        </div>
      </div>
      <div class="next-btn">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
          color="#333332"
          fill="none"
        >
          <path
            d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18"
            stroke="currentColor"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </div>
    </div>
    <!-- CAROUSEL END -->

        <!-- BEASISWA START -->
    <div class="beasiswa-container">
      <div class="beasiswa-head">
        <h3>Beasiswa yang sedang dibuka</h3>
        <div class="line-head">
          <svg xmlns="http://www.w3.org/2000/svg">
            <line
              x1="0"
              y1="9"
              x2="900"
              y2="10"
              style="stroke: #205781; stroke-width: 10"
            />
          </svg>
        </div>
      </div>
      <div class="arrow-btn-beasiswa">
        <div class="prev-btn-beasiswa">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            color="#333332"
            fill="none"
          >
            <path
              d="M3.99982 11.9998L19.9998 11.9998"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M8.99963 17C8.99963 17 3.99968 13.3176 3.99966 12C3.99965 10.6824 8.99966 7 8.99966 7"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <div class="next-btn-beasiswa">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            color="#333332"
            fill="none"
          >
            <path
              d="M20.0001 11.9998L4.00012 11.9998"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M15.0003 17C15.0003 17 20.0002 13.3176 20.0002 12C20.0002 10.6824 15.0002 7 15.0002 7"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </div>

        <div class="beasiswa-content">
                        <div class="beasiswa-info">
          <h2>Akses Ribuan Program Beasiswa</h2>
          <p>
            Raih beasiswa impianmu! Temukan informasi lengkap dan daftar
            beasiswa yang sesuai untukmu.
          </p>
        </div>
        <div class="carousel-beasiswa">
          <?php foreach ($beasiswa as $b): ?>
              <a href="detailBeasiswa.php?id=<?= $b['beasiswa_id'] ?>" class="card btn-detail-beasiswa">
                <div class="card-info">
                    <div class="degrees">
                      <span class="degree"><?= $b['jenjang_beasiswa'] ?></span>
                    </div>
                    <div class="dates">
                      <p class="start-date">Mulai: <br /><?= date('d M Y', strtotime($b['mulai_beasiswa'])) ?></p>
                      <p class="deadline">Deadline: <br /><?= date('d M Y', strtotime($b['penutupan_beasiswa'])) ?></p>
                    </div>
                </div>
                <div class="card-content">
                    <h2 class="title"><?= $b['judul_beasiswa'] ?></h2>
                    <p class="location"><?= $b['lokasi_beasiswa'] ?></p>
                </div>
              </a>
          <?php endforeach; ?>
        </div>
        </div>
    </div>
    <!-- BEASISWA END -->

    <!-- LOMBA START -->
    <div class="lomba-container">
      <div class="lomba-head">
        <h3>Lomba yang sedang berlangsung</h3>
        <div class="line-head">
          <svg xmlns="http://www.w3.org/2000/svg">
            <line
              x1="0"
              y1="9"
              x2="900"
              y2="10"
              style="stroke: #205781; stroke-width: 10"
            />
          </svg>
        </div>
      </div>
      <div class="arrow-btn-lomba">
        <div class="prev-btn-lomba">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            color="#333332"
            fill="none"
          >
            <path
              d="M3.99982 11.9998L19.9998 11.9998"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M8.99963 17C8.99963 17 3.99968 13.3176 3.99966 12C3.99965 10.6824 8.99966 7 8.99966 7"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <div class="next-btn-lomba">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            color="#333332"
            fill="none"
          >
            <path
              d="M20.0001 11.9998L4.00012 11.9998"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M15.0003 17C15.0003 17 20.0002 13.3176 20.0002 12C20.0002 10.6824 15.0002 7 15.0002 7"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </div>
      <div class="lomba-content">
          <div class="lomba-info">
          <h2>Raih Peluang Peningkatan Prestasi Kamu Sekarang!</h2>
          <p>
            Temukan berbagai lomba sesuai minatmu, ikuti tantangan, dan raih
            prestasi terbaik!
          </p>
        </div>
        <div class="carousel-lomba">
   <?php foreach ($lomba as $l): ?>
      <a href="detailLomba.php?id=<?= $l['id'] ?>" class="card btn-detail-lomba">
         <div class="card-info">
            <div class="degrees">
               <span class="degree"><?= $l['level'] ?></span>
            </div>
            <div class="dates">
               <p class="start-date">Mulai: <br /><?= date('d M Y', strtotime($l['start_date'])) ?></p>
               <p class="deadline">Deadline: <br /><?= date('d M Y', strtotime($l['deadline'])) ?></p>
            </div>
         </div>
         <div class="card-content">
            <h2 class="title"><?= $l['title'] ?></h2>
            <p class="location"><?= $l['scope'] ?></p>
         </div>
      </a>
   <?php endforeach; ?>
   </div>
</div>

    </div>
    <!-- LOMBA END -->

    <!-- CARI TIM START -->
    <div class="container-find-team">
      <div class="find-team-head">
        <h2>Temukan Tim Terbaik</h2>
        <p>
          Gabung atau buat tim untuk mengikuti lomba, cari anggota yang sesuai,
          dan capai kemenangan bersama!
        </p>
      </div>

<div class="find-team-content">
   <?php foreach ($tim as $t): ?>
<div class="card-fteam"
     data-nama="<?= $t['nama_tim'] ?>"
     data-judul="<?= $t['judul_lomba'] ?>"
     data-instansi="<?= $t['asal_instansi'] ?>"
     data-syarat="<?= $t['syarat_ketentuan'] ?>"
     data-cekktm="<?= $t['cek_ktm'] ?>">
    <div class="head-card">
        <h3><?= $t['nama_tim'] ?></h3>
        <p><?= $t['judul_lomba'] ?></p>
    </div>
    <div class="body-card">
        <p><?= $t['deskripsi'] ?></p>
    </div>
    <div class="foot-card">
        <div class="profile-team">
            <div class="detail-info">
                <span class="team-name"><?= $t['nama_tim'] ?></span>
                <span class="date-team"><?= date('d M Y', strtotime($t['created_at'])) ?></span>
            </div>
        </div>
        <div class="card-btn">Bergabung</div>
    </div>
</div>

   <?php endforeach; ?>
</div>

    </div>
    <!-- CARI TIM END -->

    <!-- POP UP JOIN TEAM START -->
    <div class="pop-up-container">
      <div class="pop-up-content">
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
        <div class="confirm-btn">Ajukan Permintaan Bergabung</div>
      </div>
    </div>
    <div class="background-pop-up"></div>
    <div class="custom-notification">
      Permintaan bergabung berhasil dikirim!
    </div>
    <!-- POP UP JOIN TEAM END -->
    <?php include 'php/footer.php'; ?>

    <script></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/cariTim.js"></script>
    <script src="../assets/js/auth.js"></script>
    <script src="../assets/js/cariTim.js"></script>
</body>
</html>