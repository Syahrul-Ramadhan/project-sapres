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
          <a
            href="detailBeasiswa.html"
            class="card btn-detail-beasiswa"
            data-category="sweden"
          >
            <div class="card-info">
              <div class="degrees">
                <span class="degree">S3</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />17 Mar 2025</p>
                <p class="deadline">Deadline: <br />02 Jun 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Swedish Collegium Advanced Study Fellowship Pro...
              </h2>
              <p class="location">Swedia</p>
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
          <a
            href="detailBeasiswa.html"
            class="card btn-detail-beasiswa"
            data-category="NTU"
          >
            <div class="card-info">
              <div class="degrees">
                <span class="degree">S1</span>
                <span class="degree">S2</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />21 Jan 2025</p>
                <p class="deadline">Deadline: <br />11 Feb 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">NTU Singapore Global Connect Fellowship</h2>
              <p class="location">Singapura</p>
              <div class="bookmark">
                <button class="bookmark-btn">
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
                </button>
              </div>
            </div>
          </a>
          <a
            href="detailBeasiswa.html"
            class="card btn-detail-beasiswa"
            data-category="gyeongsang"
          >
            <div class="card-info">
              <div class="degrees">
                <span class="degree">S2</span>
                <span class="degree">S3</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />01 Mar 2025</p>
                <p class="deadline">Deadline: <br />28 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">Gyeongsang National University Scholarship</h2>
              <p class="location">Korea Selatan</p>
              <div class="bookmark">
                <button class="bookmark-btn">
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
                </button>
              </div>
            </div>
          </a>
          <a
            href="detailBeasiswa.html"
            class="card btn-detail-beasiswa"
            data-category="fulbright"
          >
            <div class="card-info">
              <div class="degrees">
                <span class="degree">S1</span>
                <span class="degree">S2</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />10 Mar 2025</p>
                <p class="deadline">Deadline: <br />15 Apr 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Fulbright Foreign Language Teaching Assistant (FLTA)
              </h2>
              <p class="location">Amerika Serikat</p>
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
          <a
            href="detailBeasiswa.html"
            class="card btn-detail-beasiswa"
            data-category="matsumae"
          >
            <div class="card-info">
              <div class="degrees">
                <span class="degree">S3</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />01 Mar 2025</p>
                <p class="deadline">Deadline: <br />30 Jun 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Matsumae International Foundation Research S3 Fellowship 2026
              </h2>
              <p class="location">Jepang</p>
              <div class="bookmark">
                <button class="bookmark-btn">
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
                </button>
              </div>
            </div>
          </a>
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
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
          <a href="detailLomba.html" class="card">
            <div class="card-info">
              <div class="degrees">
                <span class="degree">D3</span>
                <span class="degree">2+</span>
              </div>
              <div class="dates">
                <p class="start-date">Mulai: <br />06 Mar 2025</p>
                <p class="deadline">Deadline: <br />23 Mar 2025</p>
              </div>
            </div>
            <div class="card-content">
              <h2 class="title">
                Business Case Competition IYREF 2025 by SRE ITB
              </h2>
              <p class="location">Indonesia</p>
              <div class="bookmark">
                <button class="bookmark-btn">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32"
                    width="32"
                    height="32"
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
                </button>
              </div>
            </div>
          </a>
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
        <div class="card-fteam">
          <div class="head-card">
            <h3>UI/UX Designer</h3>
            <p>Techcomfest Competition 2026</p>
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
              <span>Universitas Pendidikan Indonesia</span>
            </div>
          </div>
          <div class="body-card">
            <p>
              Saya membutuhkan seseorang yang mahir dalam merancang desain
              antarmuka, untuk bergabung dalam mengikuti lomba Techomfest di
              Semarang
            </p>
          </div>
          <div class="foot-card">
            <div class="profile-team">
              <img
                src="../assets/img/Foto profile tim/hexa.png"
                alt="tim the hexa"
              />
              <div class="detail-info">
                <span class="team-name">The Hexa</span>
                <span class="date-team">20 Okt 2025</span>
              </div>
            </div>
            <div class="card-btn">Bergabung</div>
          </div>
        </div>
        <div class="card-fteam">
          <div class="head-card">
            <h3>UI/UX Designer</h3>
            <p>Techcomfest Competition 2026</p>
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
              <span>Universitas Pendidikan Indonesia</span>
            </div>
          </div>
          <div class="body-card">
            <p>
              Saya membutuhkan seseorang yang mahir dalam merancang desain
              antarmuka, untuk bergabung dalam mengikuti lomba Techomfest di
              Semarang
            </p>
          </div>
          <div class="foot-card">
            <div class="profile-team">
              <img
                src="../assets/img/Foto profile tim/hexa.png"
                alt="tim the hexa"
              />
              <div class="detail-info">
                <span class="team-name">The Hexa</span>
                <span class="date-team">20 Okt 2025</span>
              </div>
            </div>
            <div class="card-btn">Bergabung</div>
          </div>
        </div>
        <div class="card-fteam">
          <div class="head-card">
            <h3>UI/UX Designer</h3>
            <p>Techcomfest Competition 2026</p>
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
              <span>Universitas Pendidikan Indonesia</span>
            </div>
          </div>
          <div class="body-card">
            <p>
              Saya membutuhkan seseorang yang mahir dalam merancang desain
              antarmuka, untuk bergabung dalam mengikuti lomba Techomfest di
              Semarang
            </p>
          </div>
          <div class="foot-card">
            <div class="profile-team">
              <img
                src="../assets/img/Foto profile tim/hexa.png"
                alt="tim the hexa"
              />
              <div class="detail-info">
                <span class="team-name">The Hexa</span>
                <span class="date-team">20 Okt 2025</span>
              </div>
            </div>
            <div class="card-btn">Bergabung</div>
          </div>
        </div>
        <div class="card-fteam">
          <div class="head-card">
            <h3>UI/UX Designer</h3>
            <p>Techcomfest Competition 2026</p>
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
              <span>Universitas Pendidikan Indonesia</span>
            </div>
          </div>
          <div class="body-card">
            <p>
              Saya membutuhkan seseorang yang mahir dalam merancang desain
              antarmuka, untuk bergabung dalam mengikuti lomba Techomfest di
              Semarang
            </p>
          </div>
          <div class="foot-card">
            <div class="profile-team">
              <img
                src="../assets/img/Foto profile tim/hexa.png"
                alt="tim the hexa"
              />
              <div class="detail-info">
                <span class="team-name">The Hexa</span>
                <span class="date-team">20 Okt 2025</span>
              </div>
            </div>
            <div class="card-btn">Bergabung</div>
          </div>
        </div>
        <div class="card-fteam">
          <div class="head-card">
            <h3>UI/UX Designer</h3>
            <p>Techcomfest Competition 2026</p>
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
              <span>Universitas Pendidikan Indonesia</span>
            </div>
          </div>
          <div class="body-card">
            <p>
              Saya membutuhkan seseorang yang mahir dalam merancang desain
              antarmuka, untuk bergabung dalam mengikuti lomba Techomfest di
              Semarang
            </p>
          </div>
          <div class="foot-card">
            <div class="profile-team">
              <img
                src="../assets/img/Foto profile tim/hexa.png"
                alt="tim the hexa"
              />
              <div class="detail-info">
                <span class="team-name">The Hexa</span>
                <span class="date-team">20 Okt 2025</span>
              </div>
            </div>
            <div class="card-btn">Bergabung</div>
          </div>
        </div>
        <div class="card-fteam">
          <div class="head-card">
            <h3>UI/UX Designer</h3>
            <p>Techcomfest Competition 2026</p>
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
              <span>Universitas Pendidikan Indonesia</span>
            </div>
          </div>
          <div class="body-card">
            <p>
              Saya membutuhkan seseorang yang mahir dalam merancang desain
              antarmuka, untuk bergabung dalam mengikuti lomba Techomfest di
              Semarang
            </p>
          </div>
          <div class="foot-card">
            <div class="profile-team">
              <img
                src="../assets/img/Foto profile tim/hexa.png"
                alt="tim the hexa"
              />
              <div class="detail-info">
                <span class="team-name">The Hexa</span>
                <span class="date-team">20 Okt 2025</span>
              </div>
            </div>
            <div class="card-btn">Bergabung</div>
          </div>
        </div>
        <div class="card-fteam">
          <div class="head-card">
            <h3>UI/UX Designer</h3>
            <p>Techcomfest Competition 2026</p>
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
              <span>Universitas Pendidikan Indonesia</span>
            </div>
          </div>
          <div class="body-card">
            <p>
              Saya membutuhkan seseorang yang mahir dalam merancang desain
              antarmuka, untuk bergabung dalam mengikuti lomba Techomfest di
              Semarang
            </p>
          </div>
          <div class="foot-card">
            <div class="profile-team">
              <img
                src="../assets/img/Foto profile tim/hexa.png"
                alt="tim the hexa"
              />
              <div class="detail-info">
                <span class="team-name">The Hexa</span>
                <span class="date-team">20 Okt 2025</span>
              </div>
            </div>
            <div class="card-btn">Bergabung</div>
          </div>
        </div>
      </div>
    </div>
    <!-- CARI TIM END -->

    <!-- POP UP TEAM START -->
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
        <img src="../assets/img/Foto profile tim/hexa.png" alt="Hexa" />
        <div class="detail-info-team">
          <span class="title">UI/UX Designer</span>
          <span class="lomba">Techcomfest 2026</span>
          <span class="univ">Universitas Pendidikan Indonesia</span>
        </div>
        <div class="req">
          <h4>Syarat dan Ketentuan:</h4>
          <ul>
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
    <!-- POP UP TEAM END -->
    <?php include 'php/footer.php'; ?>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/cariTim.js"></script>
</body>
</html>