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
        <button
          class="how-to btn-chat-forum"
          href="forum-chat.html"
          data-category="how-to"
        >
          Cara Menggunakan Forum
        </button>
        <div class="forum-content">
          <div class="category-container">
            <h5>Kategori</h5>
            <div class="category-content">
              <a
                href="detailForum.html"
                class="beasiswa-forum"
                data-category="beasiswa"
              >
                <div class="tittle-forum">
                  <h4>Beasiswa</h4>
                  <span>10</span>
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
                href="detailForum.html"
                class="lomba-forum"
                data-category="lomba"
              >
                <div class="tittle-forum">
                  <h4>Lomba</h4>
                  <span>15</span>
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
              <a href="detailForum.html" class="tim-forum" data-category="tim">
                <div class="tittle-forum">
                  <h4>Cari Tim</h4>
                  <span>25</span>
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
              <a href="detailForum.html" class="faq-forum" data-category="faq">
                <div class="tittle-forum">
                  <h4>FAQs</h4>
                  <span>35</span>
                </div>
              </a>
            </div>
          </div>
          <div class="recently-container">
            <h5>Terbaru</h5>
            <div class="recently-content">
              <div class="question-items">
                <span
                  class="question btn-chat-forum"
                  data-category="beasiswa-full-funded"
                  >Apa saja beasiswa full funding untuk mahasiswa S1 di
                  Indonesia?</span
                >
                <span class="date">10 Mar 2025</span>
              </div>
              <div class="question-items">
                <span
                  class="question btn-chat-forum"
                  data-category="beasiswa-full-funded"
                  >Apa saja beasiswa full funding untuk mahasiswa S1 di
                  Indonesia?</span
                >
                <span class="date">10 Mar 2025</span>
              </div>
              <div class="question-items">
                <span
                  class="question btn-chat-forum"
                  data-category="beasiswa-full-funded"
                  >Apa saja beasiswa full funding untuk mahasiswa S1 di
                  Indonesia?</span
                >
                <span class="date">10 Mar 2025</span>
              </div>
              <div class="question-items">
                <span
                  class="question btn-chat-forum"
                  data-category="beasiswa-full-funded"
                  >Apa saja beasiswa full funding untuk mahasiswa S1 di
                  Indonesia?</span
                >
                <span class="date">10 Mar 2025</span>
              </div>
              <div class="question-items">
                <span
                  class="question btn-chat-forum"
                  data-category="beasiswa-full-funded"
                  >Apa saja beasiswa full funding untuk mahasiswa S1 di
                  Indonesia?</span
                >
                <span class="date">10 Mar 2025</span>
              </div>
              <div class="question-items">
                <span
                  class="question btn-chat-forum"
                  data-category="beasiswa-full-funded"
                  >Apa saja beasiswa full funding untuk mahasiswa S1 di
                  Indonesia?</span
                >
                <span class="date">10 Mar 2025</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FORUM END -->

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/forum.js"></script>
  </body>
</html>
