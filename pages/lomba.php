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

    <!-- DAFTAR LOMBA START -->
    <main class="main-content">
      <div class="page-title">
        <h1>Lomba</h1>
        <p>Temukan berbagai lomba sesuai dengan minat dan bakatmu</p>
      </div>

      <div class="content-wrapper">
        <aside class="filter-sidebar">
          <div class="filter-header">
            <i class="fas fa-filter filter-icon"></i>
            <h2>Filter</h2>
            <button class="filter-toggle" aria-label="Toggle filter">
              <i class="fas fa-chevron-down"></i>
            </button>
          </div>

          <div class="filter-content">
            <div class="filter-section jenjang-section">
              <div class="section-header">
                <h3>Jenjang</h3>
              </div>
              <div class="checkbox-group">
                <div class="checkbox-item">
                  <input type="checkbox" id="smp" />
                  <label for="smp">SMP</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="sma" />
                  <label for="sma">SMA</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="d3" />
                  <label for="d3">D3</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="d4" />
                  <label for="d4">D4</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="s1" checked />
                  <label for="s1">S1</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="s2" />
                  <label for="s2">S2</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="s3" />
                  <label for="s3">S3</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="non-degree" />
                  <label for="non-degree">Non-Degree</label>
                </div>
              </div>
            </div>

            <div class="filter-section skala-section">
              <div class="section-header">
                <h3>Skala Lomba</h3>
              </div>
              <div class="checkbox-group">
                <div class="checkbox-item">
                  <input type="checkbox" id="nasional" checked />
                  <label for="nasional">Nasional</label>
                </div>
                <div class="checkbox-item">
                  <input type="checkbox" id="internasional" />
                  <label for="internasional">Internasional</label>
                </div>
              </div>
            </div>

            <div class="filter-section bidang-section">
              <div class="section-header">
                <h3>Bidang Lomba</h3>
              </div>
              <div class="search-box bidang-search">
                <input type="text" placeholder="Cari Bidang" />
              </div>
              <div class="popular-tags">
                <span class="tag">Bisnis</span>
                <span class="tag">Teknologi</span>
                <span class="tag">Sains</span>
                <span class="tag">Seni</span>
              </div>
            </div>

            <div class="filter-actions">
              <button class="btn-reset">Reset Filter</button>
              <button class="btn-apply">Terapkan</button>
            </div>
          </div>
        </aside>

        <div class="content-area">
          <div class="month-selector-container">
            <h2 class="section-title">Pilih Bulan</h2>
            <div class="month-selector">
              <div class="month-button">
                <span>Jan</span>
              </div>
              <div class="month-button">
                <span>Feb</span>
              </div>
              <div class="month-button active">
                <span>Mar</span>
              </div>
              <div class="month-button">
                <span>Apr</span>
              </div>
              <div class="month-button">
                <span>Mei</span>
              </div>
              <div class="month-button">
                <span>Jun</span>
              </div>
              <div class="month-button">
                <span>Jul</span>
              </div>
              <div class="month-button">
                <span>Agu</span>
              </div>
              <div class="month-button">
                <span>Sep</span>
              </div>
              <div class="month-button">
                <span>Okt</span>
              </div>
              <div class="month-button">
                <span>Nov</span>
              </div>
              <div class="month-button">
                <span>Des</span>
              </div>
            </div>
          </div>

          <div class="competition-container">
            <div class="competition-header">
              <h2 class="section-title">Lomba Bulan Maret</h2>
              <div class="competition-sort">
                <label for="sort-by">Urutkan:</label>
                <select id="sort-by" class="sort-select">
                  <option value="deadline">Deadline Terdekat</option>
                  <option value="newest">Terbaru</option>
                  <option value="popular">Terpopuler</option>
                </select>
              </div>
            </div>

            <div class="competition-grid">
              <!-- Card 1 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                  <div class="card-badge">Populer</div>
                </div>
                <div class="card-content">
                  <h3>Business Case Competition IYREF 2025 by SRE ITB</h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> SRE ITB</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 06 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 23 Maret 2025
                      </p>
                    </div>
                    <button class="bookmark-btn" aria-label="Bookmark">
                      <i class="far fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="detailLomba.html" class="card-link"></a>
              </div>

              <!-- Card 2 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                </div>
                <div class="card-content">
                  <h3>UI/UX Design Competition 2025 by Telkom University</h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> Telkom University</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 10 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 25 Maret 2025
                      </p>
                    </div>
                    <button
                      class="bookmark-btn bookmarked"
                      aria-label="Bookmark"
                    >
                      <i class="fas fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="detailLomba.html" class="card-link"></a>
              </div>

              <!-- Card 3 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                  <div class="card-badge">Baru</div>
                </div>
                <div class="card-content">
                  <h3>Data Science Challenge 2025 by Universitas Indonesia</h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> Universitas Indonesia</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 15 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 30 Maret 2025
                      </p>
                    </div>
                    <button class="bookmark-btn" aria-label="Bookmark">
                      <i class="far fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="detailLomba.html" class="card-link"></a>
              </div>

              <!-- Card 4 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                </div>
                <div class="card-content">
                  <h3>Hackathon Nasional 2025 by Dicoding</h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> Dicoding Indonesia</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 20 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 05 April 2025
                      </p>
                    </div>
                    <button class="bookmark-btn" aria-label="Bookmark">
                      <i class="far fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="#" class="card-link"></a>
              </div>

              <!-- Card 5 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                  <div class="card-badge">Populer</div>
                </div>
                <div class="card-content">
                  <h3>
                    Mobile App Development Competition by Google Developer
                  </h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> Google Developer</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 12 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 28 Maret 2025
                      </p>
                    </div>
                    <button class="bookmark-btn" aria-label="Bookmark">
                      <i class="far fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="detailLomba.html" class="card-link"></a>
              </div>

              <!-- Card 6 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                </div>
                <div class="card-content">
                  <h3>Competitive Programming Contest by ICPC</h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> ICPC Foundation</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 18 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 02 April 2025
                      </p>
                    </div>
                    <button class="bookmark-btn" aria-label="Bookmark">
                      <i class="far fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="detailLomba.html" class="card-link"></a>
              </div>

              <!-- Card 7 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                  <div class="card-badge">Baru</div>
                </div>
                <div class="card-content">
                  <h3>IoT Innovation Challenge 2025 by Schneider Electric</h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> Schneider Electric</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 22 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 10 April 2025
                      </p>
                    </div>
                    <button class="bookmark-btn" aria-label="Bookmark">
                      <i class="far fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="detailLomba.html" class="card-link"></a>
              </div>

              <!-- Card 8 -->
              <div class="competition-card">
                <div class="card-image">
                  <img
                    src="../assets/img/lomba/BCC-IYREF 2025.jpg"
                    alt="Competition"
                  />
                </div>
                <div class="card-content">
                  <h3>
                    Artificial Intelligence Competition by Microsoft Indonesia
                  </h3>
                  <div class="organizer">
                    <p><i class="fas fa-building"></i> Microsoft Indonesia</p>
                    <p><i class="fas fa-globe"></i> Tingkat Nasional</p>
                    <p>
                      <i class="fas fa-graduation-cap"></i> untuk D3, D4, S1
                    </p>
                  </div>
                  <div class="date-bookmark">
                    <div class="dates">
                      <p>
                        <i class="far fa-calendar-alt"></i> Mulai: 25 Maret 2025
                      </p>
                      <p class="deadline">
                        <i class="fas fa-clock"></i> Deadline: 15 April 2025
                      </p>
                    </div>
                    <button class="bookmark-btn" aria-label="Bookmark">
                      <i class="far fa-bookmark"></i>
                    </button>
                  </div>
                </div>
                <a href="detailLomba.html" class="card-link"></a>
              </div>
            </div>

            <div class="pagination">
              <button class="pagination-btn active" data-page="1">1</button>
              <button class="pagination-btn" data-page="2">2</button>
              <button class="pagination-btn" data-page="3">3</button>
              <button class="pagination-btn next" id="next-page">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- DAFTAR LOMBA END -->

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->
    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/filter.js"></script>
  </body>
</html>
