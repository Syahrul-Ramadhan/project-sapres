<?php
require_once 'php/session_manager.php';
require_once 'php/check_login.php';
include "php/koneksi.php";

// Ambil parameter GET untuk filter dan search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$jenjang = isset($_GET['jenjang']) ? explode(',', $_GET['jenjang']) : [];
$tipe = isset($_GET['tipe']) ? explode(',', $_GET['tipe']) : [];
$negara = isset($_GET['negara']) ? trim($_GET['negara']) : '';
$univ = isset($_GET['univ']) ? trim($_GET['univ']) : '';

// Bulan dan Tahun default
$currentMonth = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
$currentYear = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

// Validasi nilai
if ($currentMonth < 1 || $currentMonth > 12) $currentMonth = (int)date('m');
if ($currentYear < 2000) $currentYear = (int)date('Y');

// Pagination
$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Filter WHERE clause dinamis
$where = [
  "MONTH(mulai_beasiswa) = $currentMonth",
  "YEAR(mulai_beasiswa) = $currentYear"
];

if ($search !== '') $where[] = "judul_beasiswa LIKE '%$search%'";

if (!empty($jenjang)) {
  $jenjangLike = array_map(fn($j) => "jenjang_beasiswa LIKE '%$j%'", $jenjang);
  $where[] = '(' . implode(' OR ', $jenjangLike) . ')';
}
if (!empty($tipe)) {
  $tipeLike = array_map(fn($t) => "tipe_pendanaan LIKE '%$t%'", $tipe);
  $where[] = '(' . implode(' OR ', $tipeLike) . ')';
}
if ($negara !== '') $where[] = "lokasi_beasiswa LIKE '%$negara%'";
if ($univ !== '') $where[] = "asal_instansi LIKE '%$univ%'";

$whereClause = implode(' AND ', $where);

// Query utama
$sql = "SELECT * FROM beasiswa 
        WHERE $whereClause 
        ORDER BY mulai_beasiswa DESC 
        LIMIT $limit OFFSET $offset";
$result = $koneksi->query($sql);

// Hitung total data untuk pagination
$countQuery = "SELECT COUNT(*) as total FROM beasiswa WHERE $whereClause";
$totalResult = $koneksi->query($countQuery);
$totalData = $totalResult->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalData / $limit);
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
    <link rel="stylesheet" href="../assets/css/beasiswa.css" />
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
            placeholder="Ketik nama beasiswa yang ingin kamu cari" id="searchBeasiswa" oninput="searchBeasiswa()"
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
        <div class="auth-buttons" style="display: none;">
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
                  <input type="checkbox" value="SMP"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >SMA
                  <input type="checkbox" value="SMA"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >D3
                  <input type="checkbox" value="D3"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >D4
                  <input type="checkbox" value="D4"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S1
                  <input type="checkbox" value="S1"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S2
                  <input type="checkbox" value="S2"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >S3
                  <input type="checkbox" value="S3"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Non Degree
                  <input type="checkbox" value="Non Degree"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Gap Year
                  <input type="checkbox" value="Gap Year"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Profesi
                  <input type="checkbox" value="Profesi"/>
                  <span class="custom-checkbox"></span
                ></label>
              </div>
            </div>
            <div class="filter-tipe">
              <h4>Tipe</h4>
              <div class="checkbox-filter">
                <label class="checkbox-label"
                  >Fully Funded
                  <input type="checkbox" value="Fully Funded"/>
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Partially Funded
                  <input type="checkbox" value="Partially Funded"/>
                  <span class="custom-checkbox"></span
                ></label>
              </div>
            </div>
            <div class="filter-negara">
              <h4>Negara</h4>
              <input type="text" id="filter-negara" placeholder="Cari negara" />
            </div>
            <div class="filter-univ">
              <h4>Universitas</h4>
              <input type="text" id="filter-univ" placeholder="Cari universitas" />
            </div>
            <div class="filter-footer">
              <button id="applyFilter" class="btn btn-apply-filter">Terapkan</button>
              <button class="btn btn-clear-filter">Bersihkan</button>
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
                <label class="checkbox-label"
                  >Gap Year
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Profesi
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
              </div>
            </div>
            <div class="filter-tipe">
              <h4>Tipe</h4>
              <div class="checkbox-filter">
                <label class="checkbox-label"
                  >Fully Funded
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
                <label class="checkbox-label"
                  >Partially Funded
                  <input type="checkbox" />
                  <span class="custom-checkbox"></span
                ></label>
              </div>
            </div>
            <div class="filter-negara">
              <h4>Negara</h4>
              <input type="text" placeholder="Cari negara" />
            </div>
            <div class="filter-univ">
              <h4>Universitas</h4>
              <input type="text" placeholder="Cari universitas" />
            </div>
            <div class="filter-footer">
              <button id="applyFilter" class="btn btn-apply-filter">Terapkan</button>
              <button class="btn btn-clear-filter">Bersihkan</button>
            </div>
          </div>
        </div>
      </div>
      <div class="close-filter"></div>
      <!-- FILTER END -->

      <!-- MAIN CONTENT START -->
      <div class="main-content">
        <!-- YEAR SET START -->
        <div class="year-container">
          <h1 id="selected-year"><?= $currentYear ?></h1>
          <div class="arrow-btn">
            <div class="prev-btn">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="32"
                height="32"
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
            <div class="next-btn">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="32"
                height="32"
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
        </div>
        <!-- YEAR SET END -->

        <!-- MONTH SET START -->
        <div class="month-container">
          <ul class="month-list">
          <?php 
            $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            for ($i = 1; $i <= 12; $i++): 
          ?>
            <li class="month-item <?= $i === $currentMonth ? 'active' : '' ?>" 
                data-month="<?= $i ?>"
                onclick="changeMonth(<?= $i ?>)">
                <?= $months[$i - 1] ?>
            </li>
          <?php endfor; ?>
          </ul>
        </div>
        <!-- MONTH SET END -->

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

          <!-- DAFTAR BEASISWA START -->
          <div class="beasiswa-container">
            <h3>Daftar Beasiswa</h3>
            <div class="beasiswa-list">
              <?php if ($result->rowCount() === 0): ?>
                <div class="empty-state">
                  <div class="empty-icon">
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
                  <h3>Belum ada beasiswa yang sesuai pencarianmu</h3>
                  <p>Cek kembali nanti ya!</p>
                </div>
                <?php else: ?>
              <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <a
                  href="detailBeasiswa.php?id=<?= $row['beasiswa_id'] ?>"
                  class="beasiswa-card-md btn-detail-beasiswa" data-jenjang="<?= $row['jenjang_beasiswa'] ?>" data-tipe="<?= $row['tipe_pendanaan'] ?>" data-negara="<?= $row['lokasi_beasiswa'] ?>" data-univ="<?= $row['asal_instansi'] ?>">
                >
                  <div class="card-content">
                    <div class="head-card">
                          <div class="degrees">
                        <?php 
                        $jenjang = explode(',', $row['jenjang_beasiswa']); 
                        foreach ($jenjang as $j): ?>
                            <span class="degree"><?= htmlspecialchars(trim($j)) ?></span>
                            <?php endforeach; ?>
                          </div>
                      <div class="bookmark">
                        <div class="bookmark-btn">
                          <!-- SVG bookmark icon -->
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#333332" fill="none">
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
                      <h2 class="title"><?= htmlspecialchars($row['judul_beasiswa']) ?></h2>
                      <p class="location"><?= htmlspecialchars($row['lokasi_beasiswa']) ?></p>
                    </div>

                    <div class="dates">
                      <p class="start-date">Mulai: <?= date("d M Y", strtotime($row['mulai_beasiswa'])) ?></p>
                      <p class="deadline">Deadline: <?= date("d M Y", strtotime($row['penutupan_beasiswa'])) ?></p>
                    </div>
                  </div>
                </a>
            </div>
            <div class="beasiswa-list">
              <a
                    href="detailBeasiswa.php?id=<?= $row['beasiswa_id'] ?>"
                    class="beasiswa-card btn-detail-beasiswa" data-jenjang="<?= $row['jenjang_beasiswa'] ?>" data-tipe="<?= $row['tipe_pendanaan'] ?>" data-negara="<?= $row['lokasi_beasiswa'] ?>" data-univ="<?= $row['asal_instansi'] ?>"
                  >
                    <div class="card-info">
                          <div class="degrees">
                        <?php 
                        $jenjang = explode(',', $row['jenjang_beasiswa']); 
                        foreach ($jenjang as $j): ?>
                            <span class="degree"><?= htmlspecialchars(trim($j)) ?></span>
                            <?php endforeach; ?>
                          </div>
                      <div class="dates">
                        <p class="start-date">Mulai: <?= date("d M Y", strtotime($row['mulai_beasiswa'])) ?></p>
                        <p class="deadline">Deadline: <?= date("d M Y", strtotime($row['penutupan_beasiswa'])) ?></p>
                      </div>
                    </div>
                    <div class="card-content">
                      <div class="head-card">
                        <h2 class="title"><?= htmlspecialchars($row['judul_beasiswa']) ?></h2>
                        <p class="location"><?= htmlspecialchars($row['lokasi_beasiswa']) ?></p>
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
              <?php endwhile; ?>
              <?php endif; ?>
            </div>

            <div class="pagination">
            <?php if ($page > 1): ?>
              <a href="?page=<?= $page - 1 ?>" class="pagination-btn">&laquo;</a>
            <?php endif; ?>

            <?php $queryString = http_build_query(array_merge($_GET, ['page' => null])); 
              for ($i = 1; $i <= $totalPages; $i++): ?>
              <a href="?page=<?= $i ?>" <?= $i === $page ? 'style="font-weight: bold; background-color: #205781; color: white;"' : '' ?> class="pagination-btn"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
              <a href="?page=<?= $page + 1 ?>" class="pagination-btn">&raquo;</a>
            <?php endif; ?>
          </div>
          </div>
          <!-- DAFTAR BEASISWA END -->
        </div>
        <!-- MAIN CONTENT END -->
      </div>
      <!-- MAIN END -->

      <!-- FOOTER START -->
      <?php include 'php/footer.php'; ?>
      <!-- FOOTER END -->

      <!-- Java Script -->
      <script src="../assets/js/main.js"></script>
      <script src="../assets/js/filter.js"></script>
      <script src="../assets/js/beasiswa.js"></script>
      <script src="../assets/js/auth.js"></script>
    </body>
  </html>
