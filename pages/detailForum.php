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
    <main class="section-container">
      <!-- SECTION BEASISWA START -->
      <section class="section-content" data-category="beasiswa">
        <div class="header-container beasiswa">
          <div class="header-content">
            <h3 class="tittle">BEASISWA</h3>
            <span class="desc"
              >Tanya, diskusikan, dan bagikan pengalaman tentang beasiswa yang
              ada!</span
            >
          </div>
        </div>

        <div class="body-container">
          <button
            class="how-to btn-chat-forum"
            href="forum-chat.html"
            data-category="how-to"
          >
            Cara Menggunakan Forum
          </button>
          <table class="question-table">
            <thead>
              <tr class="question-header">
                <th class="topic">Topik</th>
                <th>Jawaban</th>
                <th>Diperbarui</th>
              </tr>
            </thead>
            <tbody>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <!-- SECTION BEASISWA END -->
      <!-- SECTION LOMBA START -->
      <section class="section-content" data-category="lomba">
        <div class="header-container lomba">
          <div class="header-content">
            <h3 class="tittle">LOMBA</h3>
            <span class="desc"
              >Bagikan pengalaman, cari rekomendasi, dan temukan peluang
              kompetisi yang sesuai!</span
            >
          </div>
        </div>

        <div class="body-container">
          <button
            class="how-to btn-chat-forum"
            href="forum-chat.html"
            data-category="how-to"
          >
            Cara Menggunakan Forum
          </button>
          <table class="question-table">
            <thead>
              <tr class="question-header">
                <th class="topic">Topik</th>
                <th>Jawaban</th>
                <th>Diperbarui</th>
              </tr>
            </thead>
            <tbody>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <!-- SECTION LOMBA END -->
      <!-- SECTION CARI TIM START -->
      <section class="section-content" data-category="tim">
        <div class="header-container tim">
          <div class="header-content">
            <h3 class="tittle">CARI TIM</h3>
            <span class="desc"
              >Butuh tim untuk proyek, hackathon, atau startup? Posting di sini
              dan temukan rekan yang tepat!</span
            >
          </div>
        </div>

        <div class="body-container">
          <button
            class="how-to btn-chat-forum"
            href="forum-chat.html"
            data-category="how-to"
          >
            Cara Menggunakan Forum
          </button>
          <table class="question-table">
            <thead>
              <tr class="question-header">
                <th class="topic">Topik</th>
                <th>Jawaban</th>
                <th>Diperbarui</th>
              </tr>
            </thead>
            <tbody>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <!-- SECTION CARI TIM END -->
      <!-- SECTION FAQS START -->
      <section class="section-content" data-category="faq">
        <div class="header-container faq">
          <div class="header-content">
            <h3 class="tittle">FAQs</h3>
          </div>
        </div>

        <div class="body-container">
          <button
            class="how-to btn-chat-forum"
            href="forum-chat.html"
            data-category="how-to"
          >
            Cara Menggunakan Forum
          </button>
          <table class="question-table">
            <thead>
              <tr class="question-header">
                <th class="topic">Topik</th>
                <th>Jawaban</th>
                <th>Diperbarui</th>
              </tr>
            </thead>
            <tbody>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
              <tr class="question-content">
                <td class="question">
                  <a
                    href="forum-chat.html"
                    class="btn-chat-forum"
                    data-category="beasiswa-full-funded"
                  >
                    Apa saja beasiswa full funding untuk mahasiswa S1 di
                    Indonesia?</a
                  >
                </td>
                <td>10</td>
                <td>10 Mar 2025</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <!-- SECTION FAQS END -->
    </main>
    <!-- MAIN END -->

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/forum.js"></script>
  </body>
</html>
