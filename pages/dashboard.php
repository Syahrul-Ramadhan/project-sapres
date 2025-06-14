<?php
require_once 'php/check_login.php';
// Get user info from session
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - <?php echo htmlspecialchars($user_name); ?></title>
    <link
      rel="icon"
      type="image/png"
      href="../assets/img/icons/forum_beasiswa.png"
    />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
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

    <!-- DASHBOARD START -->
    <div class="dashboard-container">
      <div class="dashboard-header">
        <h2>Syahrul Ramadhan</h2>
        <div class="dashboard-links">
          <a data-category="beasiswa" class="active">Beasiswa Tersimpan</a>
          <a data-category="lomba">Lomba Tersimpan</a>
          <a data-category="tim">Tim yang Diikuti</a>
        </div>
      </div>
      <div class="dashboard-content">
        <div
          class="content-section"
          data-category="beasiswa"
          style="display: flex"
        >
          <div class="dashboard-sidebar">
            <ul>
              <li class="active">Semua</li>
              <li>Beasiswa Dalam Negeri</li>
              <li>Beasiswa Luar Negeri</li>
            </ul>
          </div>
          <div class="beasiswa-list">
            <a href="detailBeasiswa.html" class="beasiswa-card-md">
              <div class="card-content">
                <div class="head-card">
                  <div class="degrees">
                    <span class="degree">S1</span>
                    <span class="degree">S2</span>
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
                <div class="body-card">
                  <h2 class="title">
                    Fulbright Foreign Language Teaching Assistant (FLTA)
                  </h2>
                  <p class="location">Amerika Serikat</p>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 10 Mar 2025</p>
                  <p class="deadline">Deadline: 15 Apr 2025</p>
                </div>
              </div>
            </a>
            <a href="detailBeasiswa.html" class="beasiswa-card-md">
              <div class="card-content">
                <div class="head-card">
                  <div class="degrees">
                    <span class="degree">S1</span>
                    <span class="degree">S2</span>
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
                <div class="body-card">
                  <h2 class="title">
                    Fulbright Foreign Language Teaching Assistant (FLTA)
                  </h2>
                  <p class="location">Amerika Serikat</p>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 10 Mar 2025</p>
                  <p class="deadline">Deadline: 15 Apr 2025</p>
                </div>
              </div>
            </a>
          </div>
          <div class="beasiswa-list">
            <a
              href="detailBeasiswa.html"
              class="beasiswa-card"
              data-category="sweden"
            >
              <div class="card-info">
                <div class="degrees">
                  <span class="degree">S3</span>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 17 Mar 2025</p>
                  <p class="deadline">Deadline: 02 Jun 2025</p>
                </div>
              </div>
              <div class="card-content">
                <div class="head-card">
                  <h2 class="title">
                    Swedish Collegium Advanced Study Fellowship Programme 2026
                  </h2>
                  <p class="location">Swedia</p>
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
            <a
              href="detailBeasiswa.html"
              class="beasiswa-card"
              data-category="NTU"
            >
              <div class="card-info">
                <div class="degrees">
                  <span class="degree">S1</span>
                  <span class="degree">S2</span>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 10 Mar 2025</p>
                  <p class="deadline">Deadline: 15 Apr 2025</p>
                </div>
              </div>
              <div class="card-content">
                <div class="head-card">
                  <h2 class="title">
                    Fulbright Foreign Language Teaching Assistant (FLTA)
                  </h2>
                  <p class="location">Amerika Serikat</p>
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
          </div>
        </div>
        <div
          class="content-section"
          data-category="lomba"
          style="display: none"
        >
          <div class="dashboard-sidebar">
            <ul>
              <li class="active">Semua</li>
              <li>Lomba Nasional</li>
              <li>Lomba Internasional</li>
            </ul>
          </div>
          <div class="beasiswa-list">
            <a href="detailLomba.html" class="beasiswa-card-md">
              <div class="card-content">
                <div class="head-card">
                  <div class="degrees">
                    <span class="degree">S1</span>
                    <span class="degree">S2</span>
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
                <div class="body-card">
                  <h2 class="title">
                    UI/UX Design Competition 2025 by Telkom University
                  </h2>
                  <p class="location">Amerika Serikat</p>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 10 Mar 2025</p>
                  <p class="deadline">Deadline: 15 Apr 2025</p>
                </div>
              </div>
            </a>
            <a href="detailLomba.html" class="beasiswa-card-md">
              <div class="card-content">
                <div class="head-card">
                  <div class="degrees">
                    <span class="degree">S1</span>
                    <span class="degree">S2</span>
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
                <div class="body-card">
                  <h2 class="title">
                    Business Case Competition IYREF 2025 by SRE ITB
                  </h2>
                  <p class="location">Indonesia</p>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 10 Mar 2025</p>
                  <p class="deadline">Deadline: 15 Apr 2025</p>
                </div>
              </div>
            </a>
          </div>
          <div class="beasiswa-list">
            <a href="detailLomba.html" class="beasiswa-card">
              <div class="card-info">
                <div class="degrees">
                  <span class="degree">S1</span>
                  <span class="degree">S2</span>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 10 Mar 2025</p>
                  <p class="deadline">Deadline: 15 Apr 2025</p>
                </div>
              </div>
              <div class="card-content">
                <div class="head-card">
                  <h2 class="title">
                    Business Case Competition IYREF 2025 by SRE ITB
                  </h2>
                  <p class="location">Indonesia</p>
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
            <a href="detailLomba.html" class="beasiswa-card">
              <div class="card-info">
                <div class="degrees">
                  <span class="degree">S1</span>
                  <span class="degree">S2</span>
                </div>
                <div class="dates">
                  <p class="start-date">Mulai: 10 Mar 2025</p>
                  <p class="deadline">Deadline: 15 Apr 2025</p>
                </div>
              </div>
              <div class="card-content">
                <div class="head-card">
                  <h2 class="title">
                    UI/UX Design Competition 2025 by Telkom University
                  </h2>
                  <p class="location">Indonesia</p>
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
          </div>
        </div>
        <div class="content-section" data-category="tim" style="display: none">
          <div class="dashboard-sidebar">
            <ul>
              <li class="active">Semua</li>
              <li>Menunggu Persetujuan</li>
              <li>Sudah Disetujui</li>
            </ul>
          </div>
          <div class="team-list">
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
                <div class="card-btn">Detail Info</div>
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
                <div class="card-btn">Detail Info</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- DASHBOARD END -->

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/dashboard.js"></script>
  </body>
</html>
