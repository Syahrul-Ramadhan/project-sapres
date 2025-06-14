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
    <link rel="stylesheet" href="../assets/css/detailBeasiswa.css" />
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

    <section data-type="sweden" class="beasiswa-section">
      <!-- HEADER START -->
      <header>
        <h2>Swedish Collegium Advanced Study Fellowship Programme 2026</h2>
        <div class="head-btn">
          <div class="bookmark">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              fill="none"
            >
              <path
                d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            BOOKMARK
          </div>
          <div class="share">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#205781"
              fill="none"
            >
              <path
                d="M21 6.5C21 8.15685 19.6569 9.5 18 9.5C16.3431 9.5 15 8.15685 15 6.5C15 4.84315 16.3431 3.5 18 3.5C19.6569 3.5 21 4.84315 21 6.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M9 12C9 13.6569 7.65685 15 6 15C4.34315 15 3 13.6569 3 12C3 10.3431 4.34315 9 6 9C7.65685 9 9 10.3431 9 12Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M21 17.5C21 19.1569 19.6569 20.5 18 20.5C16.3431 20.5 15 19.1569 15 17.5C15 15.8431 16.3431 14.5 18 14.5C19.6569 14.5 21 15.8431 21 17.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M8.72852 10.7495L15.2285 7.75M8.72852 13.25L15.2285 16.2495"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
            </svg>
            SALIK LINK
          </div>
        </div>
      </header>
      <!-- HEADER END -->

      <!-- INFO START -->
      <div class="info-container">
        <div class="info-content">
          <h4>Jenjang Pendidikan</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 8C2 9.34178 10.0949 13 11.9861 13C13.8772 13 21.9722 9.34178 21.9722 8C21.9722 6.65822 13.8772 3 11.9861 3C10.0949 3 2 6.65822 2 8Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5.99414 11L6.23925 16.6299C6.24415 16.7426 6.25634 16.8555 6.28901 16.9635C6.38998 17.2973 6.57608 17.6006 6.86 17.8044C9.08146 19.3985 14.8901 19.3985 17.1115 17.8044C17.3956 17.6006 17.5816 17.2973 17.6826 16.9635C17.7152 16.8555 17.7274 16.7426 17.7324 16.6299L17.9774 11"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M20.4734 9.5V16.5M20.4734 16.5C19.6814 17.9463 19.3312 18.7212 18.9755 20C18.8983 20.455 18.9596 20.6843 19.2732 20.8879C19.4006 20.9706 19.5537 21 19.7055 21H21.2259C21.3876 21 21.5507 20.9663 21.6838 20.8745C21.9753 20.6735 22.0503 20.453 21.9713 20C21.6595 18.8126 21.2623 18.0008 20.4734 16.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>S3</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Mulai Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M17 2V5M7 2V5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M13 3.5H11C7.22876 3.5 5.34315 3.5 4.17157 4.67157C3 5.84315 3 7.72876 3 11.5V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C21 19.6569 21 17.7712 21 14V11.5C21 7.72876 21 5.84315 19.8284 4.67157C18.6569 3.5 16.7712 3.5 13 3.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3.5 8.5H20.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9 15.5C9 15.5 10.5 16 11 17.5C11 17.5 13.1765 13.5 16 12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>17 Mar 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Penutupan Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M18 2V4M6 2V4"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 8H21"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2.5 12.2432C2.5 7.88594 2.5 5.70728 3.75212 4.35364C5.00424 3 7.01949 3 11.05 3H12.95C16.9805 3 18.9958 3 20.2479 4.35364C21.5 5.70728 21.5 7.88594 21.5 12.2432V12.7568C21.5 17.1141 21.5 19.2927 20.2479 20.6464C18.9958 22 16.9805 22 12.95 22H11.05C7.01949 22 5.00424 22 3.75212 20.6464C2.5 19.2927 2.5 17.1141 2.5 12.7568V12.2432Z"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 12.5L12 15M12 15L14.5 17.5M12 15L14.5 12.5M12 15L9.5 17.5"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>02 Jun 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Pemberi Beasiswa</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="4 4 20 20"
              width="35"
              height="35"
              color="#333332"
              fill="none"
            >
              <path
                d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M14 14H10C7.23858 14 5 16.2386 5 19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19C19 16.2386 16.7614 14 14 14Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              />
            </svg>
            <span>Swedish Collegium for Advanced Study</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Asal instansi</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 22H21.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 13V22M21 13V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M7.5 8V22M16.5 8V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2 13H7M22 13H17"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M6.5 8H17.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 8V4.98221M12 4.98221V2.97035C12 2.49615 12 2.25905 12.1464 2.11173C12.6061 1.64939 14.5 2.74303 15.2203 3.18653C15.8285 3.56105 16 4.30914 16 4.98221H12Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 22L12 20"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 12L10.5 12.5M13.5 12V12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 16L10.5 16.5M13.5 16V16.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Semua Universitas</span>
          </div>
        </div>
      </div>
      <!-- INFO END -->

      <!-- TIPE START -->
      <div class="tipe-container">
        <h3>Tipe Pendanaan</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Fully Funded</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Riset</span>
          </div>
        </div>
      </div>
      <!-- TIPE END -->

      <!-- BENEFIT START -->
      <div class="tipe-container">
        <h3>Benefit</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Tunjangan perbulan (tergantung pada ketersediaan dana dan
              pengalaman penelitian)</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Peserta yang berdomisili di luar wilayah Stockholm ditanggung
              biaya penginapannya</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Akses ke fasilitas penelitian terbaik SCAS</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Studi otonom yang dilakukan penuh waktu dengan peluang kerja sama
              multidisiplin</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Keterlibatan dalam jaringan ilmiah, ceramah, dan seminar</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Kerjasama dengan akademisi terkemuka dalam ilmu sosial dan
              humaniora</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Tidak ada tugas administratif atau mengajar, menjamin bahwa semua
              perhatian terfokus pada penelitian</span
            >
          </div>
        </div>
      </div>
      <!-- BENEFIT END -->

      <!-- PERSYARATAN START -->
      <div class="condition-container">
        <h3>Persyaratan</h3>
        <div class="condition-list">
          <div class="condition-items">
            <div class="point">
              <h4>Kriteria Kelayakan</h4>
            </div>
            <ol class="desc">
              <li>
                Gelar PhD (atau setaranya) harus telah dimiliki selama minimal
                tiga tahun pada saat melamar.
              </li>
              <li>
                Harus memiliki rekam jejak yang solid dalam melakukan penelitian
                independen setelah menyelesaikan postdoc.
              </li>
              <li>
                Diperlukan partisipasi aktif dalam penelitian global dan
                jaringan akademis.
              </li>
              <li>
                Peneliti senior yang telah menyandang gelar PhD selama sepuluh
                tahun atau lebih diharuskan menunjukkan rekam jejak yang stabil
                atas kontribusi penelitian inovatif.
              </li>
              <li>Pada saat melamar, koneksi universitas tidak diperlukan.</li>
            </ol>
          </div>
          <div class="condition-items">
            <div class="point">
              <h4>Booklet</h4>
            </div>
            <ul class="desc">
              <li>
                <a
                  href="https://uu.varbi.com/?jobtoken=15a2b6edfa9b26c959e9ceb435f087fb678ad995a"
                  target="_blank"
                  >Informasi Selengkapnya</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- PERSYARATAN END -->

      <!-- BUTTON DAFTAR START -->
      <div class="button-container">
        <a
          href="https://uu.varbi.com/se/what:login/jobID:792027/type:job/apply:1/?token=595dce1e23b2c650808f0212957d1a93"
          class="daftar-btn"
          target="_blank"
          >DAFTAR SEKARANG</a
        >
      </div>
      <!-- BUTTON DAFTAR END -->
    </section>
    <section data-type="NTU" class="beasiswa-section">
      <!-- HEADER START -->
      <header>
        <h2>NTU Singapore Global Connect Fellowship</h2>
        <div class="head-btn">
          <div class="bookmark">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              fill="none"
            >
              <path
                d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            BOOKMARK
          </div>
          <div class="share">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#205781"
              fill="none"
            >
              <path
                d="M21 6.5C21 8.15685 19.6569 9.5 18 9.5C16.3431 9.5 15 8.15685 15 6.5C15 4.84315 16.3431 3.5 18 3.5C19.6569 3.5 21 4.84315 21 6.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M9 12C9 13.6569 7.65685 15 6 15C4.34315 15 3 13.6569 3 12C3 10.3431 4.34315 9 6 9C7.65685 9 9 10.3431 9 12Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M21 17.5C21 19.1569 19.6569 20.5 18 20.5C16.3431 20.5 15 19.1569 15 17.5C15 15.8431 16.3431 14.5 18 14.5C19.6569 14.5 21 15.8431 21 17.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M8.72852 10.7495L15.2285 7.75M8.72852 13.25L15.2285 16.2495"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
            </svg>
            SALIK LINK
          </div>
        </div>
      </header>
      <!-- HEADER END -->

      <!-- INFO START -->
      <div class="info-container">
        <div class="info-content">
          <h4>Jenjang Pendidikan</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 8C2 9.34178 10.0949 13 11.9861 13C13.8772 13 21.9722 9.34178 21.9722 8C21.9722 6.65822 13.8772 3 11.9861 3C10.0949 3 2 6.65822 2 8Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5.99414 11L6.23925 16.6299C6.24415 16.7426 6.25634 16.8555 6.28901 16.9635C6.38998 17.2973 6.57608 17.6006 6.86 17.8044C9.08146 19.3985 14.8901 19.3985 17.1115 17.8044C17.3956 17.6006 17.5816 17.2973 17.6826 16.9635C17.7152 16.8555 17.7274 16.7426 17.7324 16.6299L17.9774 11"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M20.4734 9.5V16.5M20.4734 16.5C19.6814 17.9463 19.3312 18.7212 18.9755 20C18.8983 20.455 18.9596 20.6843 19.2732 20.8879C19.4006 20.9706 19.5537 21 19.7055 21H21.2259C21.3876 21 21.5507 20.9663 21.6838 20.8745C21.9753 20.6735 22.0503 20.453 21.9713 20C21.6595 18.8126 21.2623 18.0008 20.4734 16.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>S1</span>
            <span>S2</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Mulai Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M17 2V5M7 2V5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M13 3.5H11C7.22876 3.5 5.34315 3.5 4.17157 4.67157C3 5.84315 3 7.72876 3 11.5V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C21 19.6569 21 17.7712 21 14V11.5C21 7.72876 21 5.84315 19.8284 4.67157C18.6569 3.5 16.7712 3.5 13 3.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3.5 8.5H20.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9 15.5C9 15.5 10.5 16 11 17.5C11 17.5 13.1765 13.5 16 12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>21 Jan 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Penutupan Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M18 2V4M6 2V4"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 8H21"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2.5 12.2432C2.5 7.88594 2.5 5.70728 3.75212 4.35364C5.00424 3 7.01949 3 11.05 3H12.95C16.9805 3 18.9958 3 20.2479 4.35364C21.5 5.70728 21.5 7.88594 21.5 12.2432V12.7568C21.5 17.1141 21.5 19.2927 20.2479 20.6464C18.9958 22 16.9805 22 12.95 22H11.05C7.01949 22 5.00424 22 3.75212 20.6464C2.5 19.2927 2.5 17.1141 2.5 12.7568V12.2432Z"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 12.5L12 15M12 15L14.5 17.5M12 15L14.5 12.5M12 15L9.5 17.5"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>11 Feb 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Pemberi Beasiswa</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="4 4 20 20"
              width="35"
              height="35"
              color="#333332"
              fill="none"
            >
              <path
                d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M14 14H10C7.23858 14 5 16.2386 5 19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19C19 16.2386 16.7614 14 14 14Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              />
            </svg>
            <span>Nanyang Technological University</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Asal instansi</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 22H21.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 13V22M21 13V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M7.5 8V22M16.5 8V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2 13H7M22 13H17"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M6.5 8H17.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 8V4.98221M12 4.98221V2.97035C12 2.49615 12 2.25905 12.1464 2.11173C12.6061 1.64939 14.5 2.74303 15.2203 3.18653C15.8285 3.56105 16 4.30914 16 4.98221H12Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 22L12 20"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 12L10.5 12.5M13.5 12V12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 16L10.5 16.5M13.5 16V16.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Semua Universitas</span>
          </div>
        </div>
      </div>
      <!-- INFO END -->

      <!-- TIPE START -->
      <div class="tipe-container">
        <h3>Tipe Pendanaan</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Fully Funded</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Riset</span>
          </div>
        </div>
      </div>
      <!-- TIPE END -->

      <!-- BENEFIT START -->
      <div class="tipe-container">
        <h3>Benefit</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Pendanaan sebesar SGD $5.000/ Rp.60.184.500.000,- dan pengalaman
              penelitian 2 bulan</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Perumahan di Kampus yang Sepenuhnya Tercakup</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Bimbingan oleh Fakultas Terkemuka Dunia</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Tinggal di Singapura yang Inovatif, Semarak, &
              Multikultural</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Riset di Salah Satu dari 15 Kampus Terindah di Dunia</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Kelas Master untuk Pengembangan Keterampilan</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Seminar Pengembangan Profesi</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Peluang Keterlibatan Sosial dan Jaringan</span>
          </div>
        </div>
      </div>
      <!-- BENEFIT END -->

      <!-- PERSYARATAN START -->
      <div class="condition-container">
        <h3>Persyaratan</h3>
        <div class="condition-list">
          <div class="condition-items">
            <div class="point">
              <h4>Lainnya</h4>
            </div>
            <ol class="desc">
              <li>
                Mahasiswa Sarjana/Magister yang lulus pada tahun 2025 atau 2026
              </li>
              <li>
                Berada di jurusan STEM (science, technology, engineer,
                mathematics)
              </li>
              <li>Minat Kuat untuk Melakukan Penelitian & PhD di NTU</li>
              <li>Memiliki riwayat IPK yang memuaskan</li>
            </ol>
          </div>

          <div class="condition-items">
            <div class="point">
              <h4>Berkas</h4>
            </div>
            <ol class="desc">
              <li>
                Satu Transkrip Universitas asli (versi bahasa Inggris). IPK
                pelamar harus lebih tinggi dari 3,0 (dari 4,0).
              </li>
              <li>Sertifikat Pendaftaran.</li>
              <li>
                Halaman informasi paspor yang dipindai minimal berlaku satu
                tahun per Juli 2025.
              </li>
              <li>
                Nilai Tes Kemampuan Bahasa Inggris yang masih berlaku (asli).
                TOEFL iBT atau ITP/IELTS/TOEIC/DET (Anda dapat menggunakan TEFL
                dengan nilai minimal 500).
              </li>
              <li>Satu surat rekomendasi dari penasihat akademis.</li>
              <li>Surat Pernyataan.</li>
              <li>Riwayat Hidup.</li>
              <li>Rencana Penelitian.</li>
              <li>
                Sertifikat GCW Non Gelar (minimal C) atau Hasil Tes GCW Non
                Gelar min 80 (Pelamar S2 dapat menggantinya dengan sertifikat
                R2SEP).
              </li>
              <li>
                Mahasiswa ITS wajib berkonsultasi dengan orang tua terkait aspek
                keuangan dan mohon melampirkan surat pernyataan dari orang tua
                yang menyatakan bahwa orang tua mendukung (secara finansial dan
                mental) untuk mengikuti program ini. (Tidak perlu format).
              </li>
            </ol>
          </div>
          <div class="condition-items">
            <div class="point">
              <h4>Booklet</h4>
            </div>
            <ul class="desc">
              <li>
                <a
                  href="https://www.its.ac.id/international/its-goes-global/students/student-exchange-for-its-students/"
                  target="_blank"
                  >Template Surat Pernyataan</a
                >
              </li>
              <li>
                <a
                  href="https://www.its.ac.id/international/2025/01/21/ntu-singapore-global-connect-fellowship-summer-2025/"
                  target="_blank"
                  >Informasi Selengkapnya</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- PERSYARATAN END -->

      <!-- BUTTON DAFTAR START -->
      <div class="button-container">
        <a
          href="https://docs.google.com/forms/d/e/1FAIpQLSfj602kNbqzgeOI0etFoLtTW5qXpmMPD3M_q66WnOf9mGa-9w/viewform"
          class="daftar-btn"
          target="_blank"
          >DAFTAR SEKARANG</a
        >
      </div>
      <!-- BUTTON DAFTAR END -->
    </section>
    <section data-type="gyeongsang" class="beasiswa-section">
      <!-- HEADER START -->
      <header>
        <h2>Gyeongsang National University Scholarship</h2>
        <div class="head-btn">
          <div class="bookmark">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              fill="none"
            >
              <path
                d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            BOOKMARK
          </div>
          <div class="share">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#205781"
              fill="none"
            >
              <path
                d="M21 6.5C21 8.15685 19.6569 9.5 18 9.5C16.3431 9.5 15 8.15685 15 6.5C15 4.84315 16.3431 3.5 18 3.5C19.6569 3.5 21 4.84315 21 6.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M9 12C9 13.6569 7.65685 15 6 15C4.34315 15 3 13.6569 3 12C3 10.3431 4.34315 9 6 9C7.65685 9 9 10.3431 9 12Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M21 17.5C21 19.1569 19.6569 20.5 18 20.5C16.3431 20.5 15 19.1569 15 17.5C15 15.8431 16.3431 14.5 18 14.5C19.6569 14.5 21 15.8431 21 17.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M8.72852 10.7495L15.2285 7.75M8.72852 13.25L15.2285 16.2495"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
            </svg>
            SALIK LINK
          </div>
        </div>
      </header>
      <!-- HEADER END -->

      <!-- INFO START -->
      <div class="info-container">
        <div class="info-content">
          <h4>Jenjang Pendidikan</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 8C2 9.34178 10.0949 13 11.9861 13C13.8772 13 21.9722 9.34178 21.9722 8C21.9722 6.65822 13.8772 3 11.9861 3C10.0949 3 2 6.65822 2 8Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5.99414 11L6.23925 16.6299C6.24415 16.7426 6.25634 16.8555 6.28901 16.9635C6.38998 17.2973 6.57608 17.6006 6.86 17.8044C9.08146 19.3985 14.8901 19.3985 17.1115 17.8044C17.3956 17.6006 17.5816 17.2973 17.6826 16.9635C17.7152 16.8555 17.7274 16.7426 17.7324 16.6299L17.9774 11"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M20.4734 9.5V16.5M20.4734 16.5C19.6814 17.9463 19.3312 18.7212 18.9755 20C18.8983 20.455 18.9596 20.6843 19.2732 20.8879C19.4006 20.9706 19.5537 21 19.7055 21H21.2259C21.3876 21 21.5507 20.9663 21.6838 20.8745C21.9753 20.6735 22.0503 20.453 21.9713 20C21.6595 18.8126 21.2623 18.0008 20.4734 16.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>S2, S3</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Mulai Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M17 2V5M7 2V5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M13 3.5H11C7.22876 3.5 5.34315 3.5 4.17157 4.67157C3 5.84315 3 7.72876 3 11.5V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C21 19.6569 21 17.7712 21 14V11.5C21 7.72876 21 5.84315 19.8284 4.67157C18.6569 3.5 16.7712 3.5 13 3.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3.5 8.5H20.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9 15.5C9 15.5 10.5 16 11 17.5C11 17.5 13.1765 13.5 16 12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>01 Mar 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Penutupan Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M18 2V4M6 2V4"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 8H21"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2.5 12.2432C2.5 7.88594 2.5 5.70728 3.75212 4.35364C5.00424 3 7.01949 3 11.05 3H12.95C16.9805 3 18.9958 3 20.2479 4.35364C21.5 5.70728 21.5 7.88594 21.5 12.2432V12.7568C21.5 17.1141 21.5 19.2927 20.2479 20.6464C18.9958 22 16.9805 22 12.95 22H11.05C7.01949 22 5.00424 22 3.75212 20.6464C2.5 19.2927 2.5 17.1141 2.5 12.7568V12.2432Z"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 12.5L12 15M12 15L14.5 17.5M12 15L14.5 12.5M12 15L9.5 17.5"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>28 Mar 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Pemberi Beasiswa</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="4 4 20 20"
              width="35"
              height="35"
              color="#333332"
              fill="none"
            >
              <path
                d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M14 14H10C7.23858 14 5 16.2386 5 19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19C19 16.2386 16.7614 14 14 14Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              />
            </svg>
            <span>Gyeongsang National University</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Asal instansi</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 22H21.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 13V22M21 13V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M7.5 8V22M16.5 8V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2 13H7M22 13H17"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M6.5 8H17.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 8V4.98221M12 4.98221V2.97035C12 2.49615 12 2.25905 12.1464 2.11173C12.6061 1.64939 14.5 2.74303 15.2203 3.18653C15.8285 3.56105 16 4.30914 16 4.98221H12Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 22L12 20"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 12L10.5 12.5M13.5 12V12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 16L10.5 16.5M13.5 16V16.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Semua Universitas</span>
          </div>
        </div>
      </div>
      <!-- INFO END -->

      <!-- TIPE START -->
      <div class="tipe-container">
        <h3>Tipe Pendanaan</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Fully Funded</span>
          </div>
        </div>
      </div>
      <!-- TIPE END -->

      <!-- BENEFIT START -->
      <div class="tipe-container">
        <h3>Benefit</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Beasiswa Tahunan sebesar 12.000.000 KRW (Rp.135.285.349)</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Periode Beasiswa selama 2 tahun (4 semester)</span>
          </div>
        </div>
      </div>
      <!-- BENEFIT END -->

      <!-- PERSYARATAN START -->
      <div class="condition-container">
        <h3>Persyaratan</h3>
        <div class="condition-list">
          <div class="condition-items">
            <div class="point">
              <h4>Kelayakan</h4>
            </div>
            <ol class="desc">
              <li>
                Pelamar dan kedua orang tua mereka harus memiliki
                kewarganegaraan non-Korea
              </li>
              <li>
                Pelamar yang telah menyelesaikan (atau dijadwalkan
                menyelesaikan) program sarjana
              </li>
              <li>
                Pelamar yang nilai keseluruhannya di semua mata kuliah sarjana
                harus memenuhi salah satu kondisi berikut: 2,64/4,0, 2,80/4,3,
                2,91/4,5, 3,23/5,0 atau lebih tinggi
              </li>
              <li>
                TOPIK Level 3 atau lebih tinggi / Sertifikat kelas menengah
                Korea Sejong 2 atau lebih tinggi dan untuk departemen yang
                menawarkan English Track, sertakan sertifikat kemampuan bahasa
                Inggris: TOEFL (PBT 530, CBT 197, iBT 71), IELTS 5.5, CEFR B2,
                TEPS 600 (TEPS Baru 327) atau lebih tinggi
              </li>
              <li>
                Pelamar harus memiliki kondisi kesehatan yang baik, baik secara
                fisik maupun mental, untuk belajar di Korea.
              </li>
            </ol>
          </div>

          <div class="condition-items">
            <div class="point">
              <h4>Berkas</h4>
            </div>
            <ol class="desc">
              <li>Formulir Aplikasi</li>
              <li>Pernyataan Pribadi dan Perkenalan Diri</li>
              <li>⁠Rencana Studi dan Penelitian</li>
              <li>Persetujuan Penggunaan dan Pengalihan Data Pribadi</li>
              <li>⁠Kuesioner</li>
              <li>⁠Sertifikat Gelar atau Kelulusan yang Diharapkan</li>
              <li>⁠Transkrip Akademik - Sertifikat Tes Bahasa</li>
              <li>⁠Fotokopi Paspor Pemohon</li>
              <li>⁠Sertifikat Kewarganegaraan Pemohon dan Orang Tua</li>
              <li>⁠Surat Keterangan Hubungan Keluarga</li>
            </ol>
          </div>
          <div class="condition-items">
            <div class="point">
              <h4>Lainnya</h4>
            </div>
            <ul class="desc">
              <li>
                Dokumen persyaratan dapat dikirim ke email: oiec@gnu.ac.kr
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- PERSYARATAN END -->

      <!-- BUTTON DAFTAR START -->
      <div class="button-container">
        <a
          href="https://www.gnu.ac.kr/eng/main.do"
          class="daftar-btn"
          target="_blank"
          >DAFTAR SEKARANG</a
        >
      </div>
      <!-- BUTTON DAFTAR END -->
    </section>
    <section data-type="fulbright" class="beasiswa-section">
      <!-- HEADER START -->
      <header>
        <h2>Fulbright Foreign Language Teaching Assistant (FLTA)</h2>
        <div class="head-btn">
          <div class="bookmark">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              fill="none"
            >
              <path
                d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            BOOKMARK
          </div>
          <div class="share">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#205781"
              fill="none"
            >
              <path
                d="M21 6.5C21 8.15685 19.6569 9.5 18 9.5C16.3431 9.5 15 8.15685 15 6.5C15 4.84315 16.3431 3.5 18 3.5C19.6569 3.5 21 4.84315 21 6.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M9 12C9 13.6569 7.65685 15 6 15C4.34315 15 3 13.6569 3 12C3 10.3431 4.34315 9 6 9C7.65685 9 9 10.3431 9 12Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M21 17.5C21 19.1569 19.6569 20.5 18 20.5C16.3431 20.5 15 19.1569 15 17.5C15 15.8431 16.3431 14.5 18 14.5C19.6569 14.5 21 15.8431 21 17.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M8.72852 10.7495L15.2285 7.75M8.72852 13.25L15.2285 16.2495"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
            </svg>
            SALIK LINK
          </div>
        </div>
      </header>
      <!-- HEADER END -->

      <!-- INFO START -->
      <div class="info-container">
        <div class="info-content">
          <h4>Jenjang Pendidikan</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 8C2 9.34178 10.0949 13 11.9861 13C13.8772 13 21.9722 9.34178 21.9722 8C21.9722 6.65822 13.8772 3 11.9861 3C10.0949 3 2 6.65822 2 8Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5.99414 11L6.23925 16.6299C6.24415 16.7426 6.25634 16.8555 6.28901 16.9635C6.38998 17.2973 6.57608 17.6006 6.86 17.8044C9.08146 19.3985 14.8901 19.3985 17.1115 17.8044C17.3956 17.6006 17.5816 17.2973 17.6826 16.9635C17.7152 16.8555 17.7274 16.7426 17.7324 16.6299L17.9774 11"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M20.4734 9.5V16.5M20.4734 16.5C19.6814 17.9463 19.3312 18.7212 18.9755 20C18.8983 20.455 18.9596 20.6843 19.2732 20.8879C19.4006 20.9706 19.5537 21 19.7055 21H21.2259C21.3876 21 21.5507 20.9663 21.6838 20.8745C21.9753 20.6735 22.0503 20.453 21.9713 20C21.6595 18.8126 21.2623 18.0008 20.4734 16.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>S1, S2</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Mulai Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M17 2V5M7 2V5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M13 3.5H11C7.22876 3.5 5.34315 3.5 4.17157 4.67157C3 5.84315 3 7.72876 3 11.5V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C21 19.6569 21 17.7712 21 14V11.5C21 7.72876 21 5.84315 19.8284 4.67157C18.6569 3.5 16.7712 3.5 13 3.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3.5 8.5H20.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9 15.5C9 15.5 10.5 16 11 17.5C11 17.5 13.1765 13.5 16 12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>10 Mar 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Penutupan Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M18 2V4M6 2V4"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 8H21"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2.5 12.2432C2.5 7.88594 2.5 5.70728 3.75212 4.35364C5.00424 3 7.01949 3 11.05 3H12.95C16.9805 3 18.9958 3 20.2479 4.35364C21.5 5.70728 21.5 7.88594 21.5 12.2432V12.7568C21.5 17.1141 21.5 19.2927 20.2479 20.6464C18.9958 22 16.9805 22 12.95 22H11.05C7.01949 22 5.00424 22 3.75212 20.6464C2.5 19.2927 2.5 17.1141 2.5 12.7568V12.2432Z"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 12.5L12 15M12 15L14.5 17.5M12 15L14.5 12.5M12 15L9.5 17.5"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>15 Apr 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Pemberi Beasiswa</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="4 4 20 20"
              width="35"
              height="35"
              color="#333332"
              fill="none"
            >
              <path
                d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M14 14H10C7.23858 14 5 16.2386 5 19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19C19 16.2386 16.7614 14 14 14Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              />
            </svg>
            <span>Departemen Luar Negeri AS</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Asal instansi</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 22H21.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 13V22M21 13V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M7.5 8V22M16.5 8V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2 13H7M22 13H17"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M6.5 8H17.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 8V4.98221M12 4.98221V2.97035C12 2.49615 12 2.25905 12.1464 2.11173C12.6061 1.64939 14.5 2.74303 15.2203 3.18653C15.8285 3.56105 16 4.30914 16 4.98221H12Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 22L12 20"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 12L10.5 12.5M13.5 12V12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 16L10.5 16.5M13.5 16V16.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Semua Universitas</span>
          </div>
        </div>
      </div>
      <!-- INFO END -->

      <!-- TIPE START -->
      <div class="tipe-container">
        <h3>Tipe Pendanaan</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Fully Funded</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Pelatihan/Studi Singkat</span>
          </div>
        </div>
      </div>
      <!-- TIPE END -->

      <!-- BENEFIT START -->
      <div class="tipe-container">
        <h3>Benefit</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Tunjangan hidup</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Biaya perjalanan</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Asuransi Kesehatan</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Akomodasi</span>
          </div>
        </div>
      </div>
      <!-- BENEFIT END -->

      <!-- PERSYARATAN START -->
      <div class="condition-container">
        <h3>Persyaratan</h3>
        <div class="condition-list">
          <div class="condition-items">
            <div class="point">
              <h4>
                Persyaratan Pengajuan (harus diberikan dalam bahasa Inggris)
              </h4>
            </div>
            <ol class="desc">
              <li>Formulir aplikasi</li>
              <li>
                Salinan skor TOEFL ITP, TOEFL iBT, IELTS, atau Duolingo terbaru
                Anda (berusia kurang dari dua tahun)
              </li>
              <li>
                Tiga surat referensi dari atasan/atasan kerja Anda saat ini,
                instruktur, profesor yang mengenal Anda dengan baik
              </li>
              <li>
                Salinan transkrip akademik dan ijazah yang dilegalisir (dalam
                bahasa asli dan terjemahan bahasa Inggris)
              </li>
              <li>
                Salinan dokumen identitas yang masih berlaku (KTP atau paspor)
              </li>
              <li>Daftar Riwayat Hidup</li>
            </ol>
          </div>

          <div class="condition-items">
            <div class="point">
              <h4>Pemohon harus</h4>
            </div>
            <ol class="desc">
              <li>
                Menjadi seorang pendidik di tahap awal karier mereka (dengan
                minimal satu tahun pengalaman sebagai guru bahasa Inggris atau
                bahasa Indonesia sebagai bahasa asing penuh waktu di tingkat
                sekolah menengah atau tinggi)
              </li>
              <li>
                Mampu berhasil dalam peran ganda sebagai asisten pengajar dan
                mahasiswa di institusi tuan rumah sarjana atau pascasarjana
              </li>
              <li>Memiliki gelar sarjana (S1) , atau gelar master (S2)</li>
              <li>
                Memiliki skor TOEFL ITP minimal 550, atau skor TOEFL iBT minimal
                80, atau skor IELTS minimal 6,5, atau skor Duolingo minimal 110
              </li>
            </ol>
          </div>
          <div class="condition-items">
            <div class="point">
              <h4>Booklet</h4>
            </div>
            <ul class="desc">
              <li>
                <a
                  href="https://luarkampus.id/storage/scholarship-attachments/vWOJTGLOkIIkyOZPO51eIHT3DxqTS4-metaMjAyNS0yMDI2LUZ1bGJyaWdodC1Gb3JlaWduLUxhbmd1YWdlLVRlYWNoaW5nLUFzc2lzdGFudC1Qcm9ncmFtLUFwcGxpY2F0aW9uLUNoZWNrbGlzdC5kb2N4-.docx"
                  target="_blank"
                  >Application Checklist</a
                >
              </li>
              <li>
                <a
                  href="https://www.its.ac.id/international/2025/01/21/ntu-singapore-global-connect-fellowship-summer-2025/"
                  target="_blank"
                  >https://www.aminef.or.id/grants-for-indonesians/fulbright-programs/foreign-language-teaching-assistant-flta-2/</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- PERSYARATAN END -->

      <!-- BUTTON DAFTAR START -->
      <div class="button-container">
        <a
          href="https://stu.aminef.or.id/grantee/auth/register"
          class="daftar-btn"
          target="_blank"
          >DAFTAR SEKARANG</a
        >
      </div>
      <!-- BUTTON DAFTAR END -->
    </section>
    <section data-type="matsumae" class="beasiswa-section">
      <!-- HEADER START -->
      <header>
        <h2>Matsumae International Foundation Research S3 Fellowship 2026</h2>
        <div class="head-btn">
          <div class="bookmark">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              fill="none"
            >
              <path
                d="M4 17.9808V9.70753C4 6.07416 4 4.25748 5.17157 3.12874C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.12874C20 4.25748 20 6.07416 20 9.70753V17.9808C20 20.2867 20 21.4396 19.2272 21.8523C17.7305 22.6514 14.9232 19.9852 13.59 19.1824C12.8168 18.7168 12.4302 18.484 12 18.484C11.5698 18.484 11.1832 18.7168 10.41 19.1824C9.0768 19.9852 6.26947 22.6514 4.77285 21.8523C4 21.4396 4 20.2867 4 17.9808Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            BOOKMARK
          </div>
          <div class="share">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#205781"
              fill="none"
            >
              <path
                d="M21 6.5C21 8.15685 19.6569 9.5 18 9.5C16.3431 9.5 15 8.15685 15 6.5C15 4.84315 16.3431 3.5 18 3.5C19.6569 3.5 21 4.84315 21 6.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M9 12C9 13.6569 7.65685 15 6 15C4.34315 15 3 13.6569 3 12C3 10.3431 4.34315 9 6 9C7.65685 9 9 10.3431 9 12Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M21 17.5C21 19.1569 19.6569 20.5 18 20.5C16.3431 20.5 15 19.1569 15 17.5C15 15.8431 16.3431 14.5 18 14.5C19.6569 14.5 21 15.8431 21 17.5Z"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M8.72852 10.7495L15.2285 7.75M8.72852 13.25L15.2285 16.2495"
                color="currentColor"
                stroke="currentColor"
                stroke-width="1.5"
              />
            </svg>
            SALIK LINK
          </div>
        </div>
      </header>
      <!-- HEADER END -->

      <!-- INFO START -->
      <div class="info-container">
        <div class="info-content">
          <h4>Jenjang Pendidikan</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 8C2 9.34178 10.0949 13 11.9861 13C13.8772 13 21.9722 9.34178 21.9722 8C21.9722 6.65822 13.8772 3 11.9861 3C10.0949 3 2 6.65822 2 8Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M5.99414 11L6.23925 16.6299C6.24415 16.7426 6.25634 16.8555 6.28901 16.9635C6.38998 17.2973 6.57608 17.6006 6.86 17.8044C9.08146 19.3985 14.8901 19.3985 17.1115 17.8044C17.3956 17.6006 17.5816 17.2973 17.6826 16.9635C17.7152 16.8555 17.7274 16.7426 17.7324 16.6299L17.9774 11"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M20.4734 9.5V16.5M20.4734 16.5C19.6814 17.9463 19.3312 18.7212 18.9755 20C18.8983 20.455 18.9596 20.6843 19.2732 20.8879C19.4006 20.9706 19.5537 21 19.7055 21H21.2259C21.3876 21 21.5507 20.9663 21.6838 20.8745C21.9753 20.6735 22.0503 20.453 21.9713 20C21.6595 18.8126 21.2623 18.0008 20.4734 16.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>S3</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Mulai Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M17 2V5M7 2V5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M13 3.5H11C7.22876 3.5 5.34315 3.5 4.17157 4.67157C3 5.84315 3 7.72876 3 11.5V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C21 19.6569 21 17.7712 21 14V11.5C21 7.72876 21 5.84315 19.8284 4.67157C18.6569 3.5 16.7712 3.5 13 3.5Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3.5 8.5H20.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9 15.5C9 15.5 10.5 16 11 17.5C11 17.5 13.1765 13.5 16 12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>01 Mar 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Penutupan Pendaftaran</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M18 2V4M6 2V4"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 8H21"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2.5 12.2432C2.5 7.88594 2.5 5.70728 3.75212 4.35364C5.00424 3 7.01949 3 11.05 3H12.95C16.9805 3 18.9958 3 20.2479 4.35364C21.5 5.70728 21.5 7.88594 21.5 12.2432V12.7568C21.5 17.1141 21.5 19.2927 20.2479 20.6464C18.9958 22 16.9805 22 12.95 22H11.05C7.01949 22 5.00424 22 3.75212 20.6464C2.5 19.2927 2.5 17.1141 2.5 12.7568V12.2432Z"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9.5 12.5L12 15M12 15L14.5 17.5M12 15L14.5 12.5M12 15L9.5 17.5"
                stroke="#D0352A"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>30 Jun 2025</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Pemberi Beasiswa</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="4 4 20 20"
              width="35"
              height="35"
              color="#333332"
              fill="none"
            >
              <path
                d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                stroke="currentColor"
                stroke-width="1.5"
              />
              <path
                d="M14 14H10C7.23858 14 5 16.2386 5 19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19C19 16.2386 16.7614 14 14 14Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              />
            </svg>
            <span>Matsumae International Foundation</span>
          </div>
        </div>
        <div class="info-content">
          <h4>Asal instansi</h4>
          <div class="info-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="32"
              height="32"
              color="#333332"
              fill="none"
            >
              <path
                d="M2 22H21.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M3 13V22M21 13V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M7.5 8V22M16.5 8V22"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M2 13H7M22 13H17"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M6.5 8H17.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 8V4.98221M12 4.98221V2.97035C12 2.49615 12 2.25905 12.1464 2.11173C12.6061 1.64939 14.5 2.74303 15.2203 3.18653C15.8285 3.56105 16 4.30914 16 4.98221H12Z"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 22L12 20"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 12L10.5 12.5M13.5 12V12.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10.5 16L10.5 16.5M13.5 16V16.5"
                stroke="#205781"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Semua Universitas</span>
          </div>
        </div>
      </div>
      <!-- INFO END -->

      <!-- TIPE START -->
      <div class="tipe-container">
        <h3>Tipe Pendanaan</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Fully Funded</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Riset</span>
          </div>
        </div>
      </div>
      <!-- TIPE END -->

      <!-- BENEFIT START -->
      <div class="tipe-container">
        <h3>Benefit</h3>
        <div class="tipe-list">
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Bantuan bulanan sebesar JPY 220.000 (Rp24.301.200)</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Dana kedatangan sebesar JPY 120.000 (Rp13.237.200)</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Disediakan tiket kelas ekonomi dari negara asal penerima ke
              Jepang</span
            >
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span>Asuransi perjalanan yang komprehensif</span>
          </div>
          <div class="tipe-items">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z"
                stroke="white"
                stroke-width="1.5"
              />
              <path
                d="M8 12.5L10.5 15L16 9"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >Kesempatan untuk meningkatkan keterlibatan penelitian dengan
              mempelajari budaya dan teknologi Jepang</span
            >
          </div>
        </div>
      </div>
      <!-- BENEFIT END -->

      <!-- PERSYARATAN START -->
      <div class="condition-container">
        <h3>Persyaratan</h3>
        <div class="condition-list">
          <div class="condition-items">
            <div class="point">
              <h4>Kriteria Kelayakan</h4>
            </div>
            <ol class="desc">
              <li>
                Kewarganegaraan Non-Jepang: Kandidat tidak boleh menjadi warga
                negara Jepang.
              </li>
              <li>
                Persyaratan Gelar Doktor: Pada saat melamar, kandidat harus
                memiliki gelar Ph.D.
              </li>
              <li>
                Kandidat harus lahir pada atau setelah tahun 1980 dan berusia 45
                tahun atau lebih muda.
              </li>
              <li>
                Kemampuan Bahasa: Diperlukan kemampuan bahasa Jepang atau
                Inggris.
              </li>
              <li>
                Penerimaan oleh Institusi Tuan Rumah: Sebelum melamar, kandidat
                harus memperoleh penerimaan dari institusi tuan rumah Jepang.
              </li>
              <li>
                Pengalaman Terbatas Sebelumnya di Jepang: Selain konferensi
                singkat atau perjalanan terkait pariwisata, seseorang tidak
                boleh memiliki pengalaman jangka panjang sebelumnya di Jepang.
              </li>
              <li>
                Komitmen terhadap Negara Asal: Penerima harus bekerja di negara
                asal dan berjanji untuk kembali ke sana untuk mendukung
                pembangunan nasional setelah menyelesaikan beasiswa.
              </li>
            </ol>
          </div>
          <div class="condition-items">
            <div class="point">
              <h4>Booklet</h4>
            </div>
            <ul class="desc">
              <li>
                <a
                  href="https://www.mif-japan.org/en/fellowship/announcement/"
                  target="_blank"
                  >Informasi Selengkapnya</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- PERSYARATAN END -->

      <!-- BUTTON DAFTAR START -->
      <div class="button-container">
        <a
          href="https://www.mif-japan.org/en/login/"
          class="daftar-btn"
          target="_blank"
          >DAFTAR SEKARANG</a
        >
      </div>
      <!-- BUTTON DAFTAR END -->
    </section>

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->
    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/beasiswa.js"></script>
  </body>
</html>
