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
    <link rel="stylesheet" href="../assets/css/detailLomba.css" />
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

    <main class="main-content">
      <!-- Title Section with Bookmark and Share -->
      <div class="competition-title-container">
        <div class="competition-title-content">
          <h1>Business Case Competition IYREF 2025 by SRE ITB</h1>
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

      <!-- Competition Detail Content - More compact design -->
      <div class="competition-detail-container">
        <!-- Header Section with Key Info -->
        <div class="header-section">
          <div class="info-group">
            <div class="info-item">
              <h3>Jenjang</h3>
              <div class="info-detail">
                <i class="fas fa-graduation-cap"></i>
                <span>D3, D4, S1</span>
              </div>
            </div>

            <div class="info-item">
              <h3>Mulai</h3>
              <div class="info-detail">
                <i class="far fa-calendar-alt"></i>
                <span>06 Mar 2025</span>
              </div>
            </div>

            <div class="info-item">
              <h3>Deadline</h3>
              <div class="info-detail">
                <i class="fas fa-clock"></i>
                <span>23 Mar 2025</span>
              </div>
            </div>

            <div class="info-item">
              <h3>Penyelenggara</h3>
              <div class="info-detail">
                <i class="fas fa-building"></i>
                <span>SRE ITB</span>
              </div>
            </div>

            <div class="info-item">
              <h3>Biaya</h3>
              <div class="info-detail">
                <i class="fas fa-wallet"></i>
                <span>Gratis</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content Section -->
        <div class="competition-content">
          <!-- Left: Image and Prize -->
          <div class="competition-image-prize">
            <img
              src="https://dashboard.codeparrot.ai/api/image/Z9-g5_8PKu40N2Jy/image-4.png"
              alt="Business Case Competition"
              class="main-image"
            />
            <div class="prize-box">
              <p>Total Prize</p>
              <div class="prize">Rp35,000,000</div>
              <p class="prize-sub">equal to USD2,128</p>
            </div>
          </div>

          <!-- Right: Details -->
          <div class="competition-details">
            <h2>Business Case Competition</h2>

            <!-- Timeline -->
            <div class="timeline-box">
              <h3><i class="fas fa-calendar-week"></i> Timeline</h3>
              <ul class="timeline-list">
                <li>Workshop BGC 101: March 1-7, 2025</li>
                <li>Preliminary Phase: March 6 - April 5, 2025</li>
                <li>Semifinalist Announcement: April 1, 2025</li>
              </ul>
            </div>

            <!-- Links -->
            <div class="links-box">
              <div class="link-item">
                <span>Registration:</span>
                <a href="#">bit.ly/AdekBCCDuluYa</a>
              </div>
              <div class="link-item">
                <span>Guidebook:</span>
                <a href="#">bit.ly/yukBCCCyuk</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Description Section -->
        <div class="description-section">
          <h2 class="section-title">Deskripsi</h2>
          <div class="description-content">
            <p>
              BCC merupakan kompetisi yang menantang mahasiswa D3, D4, dan S1
              untuk mengembangkan model bisnis yang mendukung transisi energi
              berkelanjutan. Fokus utamanya adalah strategi pembiayaan untuk
              energi hijau agar lebih viable dan scalable.
            </p>

            <div class="theme-box">
              <h3>Tema & Sub-Tema</h3>
              <p class="theme-main">
                "Financing the Green Future to Make Business Models for
                Sustainable Energy"
              </p>
              <ul class="theme-list">
                <li>Green Economy</li>
                <li>Sustainable Liquidity Management</li>
                <li>Monetary and Financial Stability</li>
                <li>Low-Carbon Economy</li>
                <li>Central Bank Strategy</li>
              </ul>
            </div>

            <div class="prizes-box">
              <h3>Hadiah</h3>
              <ul class="prizes-list">
                <li>Juara 1: IDR 5.000.000 (~USD 306.28)</li>
                <li>Juara 2: IDR 3.000.000 (~USD 183.77)</li>
                <li>Juara 3: IDR 1.500.000 (~USD 91.88)</li>
                <li>
                  Penghargaan lain: Most Innovative Solution, Best Speaker, Best
                  Pitch Deck
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Requirements Section -->
        <div class="requirements-section">
          <h2 class="section-title">Persyaratan</h2>
          <div class="requirements-content">
            <ul class="requirements-list">
              <li>Warga Negara Indonesia (WNI)</li>
              <li>
                Mahasiswa aktif D3, D4, atau S1 (tidak dalam status cuti
                akademik)
              </li>
              <li>
                Penerima beasiswa pemerintah maupun swasta diperbolehkan
                mendaftar
              </li>
              <li>Tidak ada minimal IPK</li>
              <li>Berkomitmen untuk mengikuti seluruh tahapan lomba</li>
            </ul>

            <div class="guidebook-box">
              <h3>Booklet</h3>
              <p>Panduan dan Alur Pendaftaran</p>
              <a href="#" class="btn-download">
                <i class="fas fa-download"></i> Download
              </a>
            </div>
          </div>

          <div class="action-buttons">
            <button class="btn search-team">CARI TIM</button>
            <button class="btn register-now">DAFTAR SEKARANG</button>
          </div>
        </div>
      </div>
    </main>

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->
    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/detailLomba.js"></script>
  </body>
</html>
