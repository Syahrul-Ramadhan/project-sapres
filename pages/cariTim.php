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
      include "php/koneksi.php";
      
      // Pagination setup
      $limit = 9;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      if ($page < 1) $page = 1;
      $offset = ($page - 1) * $limit;

      // Query untuk mengambil data tim
      $sql = "SELECT * FROM tim LIMIT :limit OFFSET :offset";
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
    <!-- MAIN START -->
    <div class="main-container">
      <!-- FILTER START -->
      <div class="filter-wrap">
        <div class="filter-container">
          <div class="filter-head">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="28"
              height="28"
              color="#ffffff"
              fill="none"
            >
              <path
                d="M13 4L3 4"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11 19L3 19"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 19L17 19"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 11.5L11 11.5"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 4L19 4"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5 11.5L3 11.5"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M14.5 2C14.9659 2 15.1989 2 15.3827 2.07612C15.6277 2.17761 15.8224 2.37229 15.9239 2.61732C16 2.80109 16 3.03406 16 3.5L16 4.5C16 4.96594 16 5.19891 15.9239 5.38268C15.8224 5.62771 15.6277 5.82239 15.3827 5.92388C15.1989 6 14.9659 6 14.5 6C14.0341 6 13.8011 6 13.6173 5.92388C13.3723 5.82239 13.1776 5.62771 13.0761 5.38268C13 5.19891 13 4.96594 13 4.5L13 3.5C13 3.03406 13 2.80109 13.0761 2.61732C13.1776 2.37229 13.3723 2.17761 13.6173 2.07612C13.8011 2 14.0341 2 14.5 2Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12.5 17C12.9659 17 13.1989 17 13.3827 17.0761C13.6277 17.1776 13.8224 17.3723 13.9239 17.6173C14 17.8011 14 18.0341 14 18.5L14 19.5C14 19.9659 14 20.1989 13.9239 20.3827C13.8224 20.6277 13.6277 20.8224 13.3827 20.9239C13.1989 21 12.9659 21 12.5 21C12.0341 21 11.8011 21 11.6173 20.9239C11.3723 20.8224 11.1776 20.6277 11.0761 20.3827C11 20.1989 11 19.9659 11 19.5L11 18.5C11 18.0341 11 17.8011 11.0761 17.6173C11.1776 17.3723 11.3723 17.1776 11.6173 17.0761C11.8011 17 12.0341 17 12.5 17Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 9.5C9.96594 9.5 10.1989 9.5 10.3827 9.57612C10.6277 9.67761 10.8224 9.87229 10.9239 10.1173C11 10.3011 11 10.5341 11 11L11 12C11 12.4659 11 12.6989 10.9239 12.8827C10.8224 13.1277 10.6277 13.3224 10.3827 13.4239C10.1989 13.5 9.96594 13.5 9.5 13.5C9.03406 13.5 8.80109 13.5 8.61732 13.4239C8.37229 13.3224 8.17761 13.1277 8.07612 12.8827C8 12.6989 8 12.4659 8 12L8 11C8 10.5341 8 10.3011 8.07612 10.1173C8.17761 9.87229 8.37229 9.67761 8.61732 9.57612C8.80109 9.5 9.03406 9.5 9.5 9.5Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <h3>Filter</h3>
          </div>
          <div class="filter-content">
            <div class="filter-jenjang">
              <h4>Jenjang</h4>
              <div class="checkbox-filter">
                <label class="checkbox-label"
                  >SMP
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >SMA
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >D3
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >D4
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S1
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S2
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S3
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Non Degree
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
              </div>
            </div>
            <div class="filter-kategori">
              <h4>Kategori</h4>
              <input type="text" placeholder="Cari kategori" />
            </div>
            <div class="filter-univ">
              <h4>Universitas</h4>
              <input type="text" placeholder="Cari universitas" />
            </div>
          </div>
        </div>
      </div>
      <div class="filter-wrap-responsive">
        <div class="filter-container">
          <div class="filter-head">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="28"
              height="28"
              color="#ffffff"
              fill="none"
            >
              <path
                d="M13 4L3 4"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11 19L3 19"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 19L17 19"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 11.5L11 11.5"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 4L19 4"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5 11.5L3 11.5"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M14.5 2C14.9659 2 15.1989 2 15.3827 2.07612C15.6277 2.17761 15.8224 2.37229 15.9239 2.61732C16 2.80109 16 3.03406 16 3.5L16 4.5C16 4.96594 16 5.19891 15.9239 5.38268C15.8224 5.62771 15.6277 5.82239 15.3827 5.92388C15.1989 6 14.9659 6 14.5 6C14.0341 6 13.8011 6 13.6173 5.92388C13.3723 5.82239 13.1776 5.62771 13.0761 5.38268C13 5.19891 13 4.96594 13 4.5L13 3.5C13 3.03406 13 2.80109 13.0761 2.61732C13.1776 2.37229 13.3723 2.17761 13.6173 2.07612C13.8011 2 14.0341 2 14.5 2Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12.5 17C12.9659 17 13.1989 17 13.3827 17.0761C13.6277 17.1776 13.8224 17.3723 13.9239 17.6173C14 17.8011 14 18.0341 14 18.5L14 19.5C14 19.9659 14 20.1989 13.9239 20.3827C13.8224 20.6277 13.6277 20.8224 13.3827 20.9239C13.1989 21 12.9659 21 12.5 21C12.0341 21 11.8011 21 11.6173 20.9239C11.3723 20.8224 11.1776 20.6277 11.0761 20.3827C11 20.1989 11 19.9659 11 19.5L11 18.5C11 18.0341 11 17.8011 11.0761 17.6173C11.1776 17.3723 11.3723 17.1776 11.6173 17.0761C11.8011 17 12.0341 17 12.5 17Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 9.5C9.96594 9.5 10.1989 9.5 10.3827 9.57612C10.6277 9.67761 10.8224 9.87229 10.9239 10.1173C11 10.3011 11 10.5341 11 11L11 12C11 12.4659 11 12.6989 10.9239 12.8827C10.8224 13.1277 10.6277 13.3224 10.3827 13.4239C10.1989 13.5 9.96594 13.5 9.5 13.5C9.03406 13.5 8.80109 13.5 8.61732 13.4239C8.37229 13.3224 8.17761 13.1277 8.07612 12.8827C8 12.6989 8 12.4659 8 12L8 11C8 10.5341 8 10.3011 8.07612 10.1173C8.17761 9.87229 8.37229 9.67761 8.61732 9.57612C8.80109 9.5 9.03406 9.5 9.5 9.5Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <h3>Filter</h3>
          </div>
          <div class="filter-content">
            <div class="filter-jenjang">
              <h4>Jenjang</h4>
              <div class="checkbox-filter">
                <label class="checkbox-label"
                  >SMP
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >SMA
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >D3
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >D4
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S1
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S2
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S3
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Non Degree
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
              </div>
            </div>
            <div class="filter-kategori">
              <h4>Kategori</h4>
              <input type="text" placeholder="Cari kategori" />
            </div>
            <div class="filter-univ">
              <h4>Universitas</h4>
              <input type="text" placeholder="Cari universitas" />
            </div>
          </div>
        </div>
      </div>
      <div class="close-filter"></div>
      <!-- FILTER END -->

      <!-- MAIN CONTENT START -->
      <div class="main-content">
        <!-- DAFTAR TIM START -->
        <div class="team-container">
          <h3>Cari Tim yang Cocok untukmu!</h3>
          <!-- FILTER BTN START -->
          <div class="filter-btn">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#ffffff"
              fill="none"
            >
              <path
                d="M13 4L3 4"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11 19L3 19"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 19L17 19"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 11.5L11 11.5"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 4L19 4"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5 11.5L3 11.5"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M14.5 2C14.9659 2 15.1989 2 15.3827 2.07612C15.6277 2.17761 15.8224 2.37229 15.9239 2.61732C16 2.80109 16 3.03406 16 3.5L16 4.5C16 4.96594 16 5.19891 15.9239 5.38268C15.8224 5.62771 15.6277 5.82239 15.3827 5.92388C15.1989 6 14.9659 6 14.5 6C14.0341 6 13.8011 6 13.6173 5.92388C13.3723 5.82239 13.1776 5.62771 13.0761 5.38268C13 5.19891 13 4.96594 13 4.5L13 3.5C13 3.03406 13 2.80109 13.0761 2.61732C13.1776 2.37229 13.3723 2.17761 13.6173 2.07612C13.8011 2 14.0341 2 14.5 2Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12.5 17C12.9659 17 13.1989 17 13.3827 17.0761C13.6277 17.1776 13.8224 17.3723 13.9239 17.6173C14 17.8011 14 18.0341 14 18.5L14 19.5C14 19.9659 14 20.1989 13.9239 20.3827C13.8224 20.6277 13.6277 20.8224 13.3827 20.9239C13.1989 21 12.9659 21 12.5 21C12.0341 21 11.8011 21 11.6173 20.9239C11.3723 20.8224 11.1776 20.6277 11.0761 20.3827C11 20.1989 11 19.9659 11 19.5L11 18.5C11 18.0341 11 17.8011 11.0761 17.6173C11.1776 17.3723 11.3723 17.1776 11.6173 17.0761C11.8011 17 12.0341 17 12.5 17Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 9.5C9.96594 9.5 10.1989 9.5 10.3827 9.57612C10.6277 9.67761 10.8224 9.87229 10.9239 10.1173C11 10.3011 11 10.5341 11 11L11 12C11 12.4659 11 12.6989 10.9239 12.8827C10.8224 13.1277 10.6277 13.3224 10.3827 13.4239C10.1989 13.5 9.96594 13.5 9.5 13.5C9.03406 13.5 8.80109 13.5 8.61732 13.4239C8.37229 13.3224 8.17761 13.1277 8.07612 12.8827C8 12.6989 8 12.4659 8 12L8 11C8 10.5341 8 10.3011 8.07612 10.1173C8.17761 9.87229 8.37229 9.67761 8.61732 9.57612C8.80109 9.5 9.03406 9.5 9.5 9.5Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>FILTER</span>
          </div>
          <!-- FILTER BTN END -->

          <div class="team-wrap">
            <div class="team-list">
              <?php foreach ($timData as $data): ?>
              <div class="card-fteam" data-nama="<?= $data['nama_tim'] ?>" data-judul="<?= $data['judul_lomba'] ?>"
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
