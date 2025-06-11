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

    <main>
      <button
        class="how-to btn-chat-forum"
        href="forum-chat.html"
        data-category="how-to"
      >
        Cara Menggunakan Forum
      </button>

      <section class="post-section" data-type="beasiswa-full-funded">
        <div class="post-container">
          <div class="post-header">
            <img
              src="../assets/img/profile-forum/user-aditya.png"
              alt="Avatar Aditya Pratama"
            />
            <div class="post-desc">
              <h2>Aditya Pratama</h2>
              <span class="date">13 Jan 2025</span>
            </div>
          </div>
          <div class="post-content">
            <p>
              Apa saja beasiswa full funding untuk mahasiswa S1 di Indonesia?
            </p>
          </div>
          <div class="post-footer">
            <svg
              class="like"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
            </svg>
            <svg
              class="link"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M9.14339 10.691L9.35031 10.4841C11.329 8.50532 14.5372 8.50532 16.5159 10.4841C18.4947 12.4628 18.4947 15.671 16.5159 17.6497L13.6497 20.5159C11.671 22.4947 8.46279 22.4947 6.48405 20.5159C4.50532 18.5372 4.50532 15.329 6.48405 13.3503L6.9484 12.886"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
              <path
                d="M17.0516 11.114L17.5159 10.6497C19.4947 8.67095 19.4947 5.46279 17.5159 3.48405C15.5372 1.50532 12.329 1.50532 10.3503 3.48405L7.48405 6.35031C5.50532 8.32904 5.50532 11.5372 7.48405 13.5159C9.46279 15.4947 12.671 15.4947 14.6497 13.5159L14.8566 13.309"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
            </svg>
            <div class="reply">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
                color="#333332"
                fill="none"
              >
                <path
                  d="M4.80823 9.44118L6.77353 7.46899C8.18956 6.04799 8.74462 5.28357 9.51139 5.55381C10.4675 5.89077 10.1528 8.01692 10.1528 8.73471C11.6393 8.73471 13.1848 8.60259 14.6502 8.87787C19.4874 9.78664 21 13.7153 21 18C19.6309 17.0302 18.2632 15.997 16.6177 15.5476C14.5636 14.9865 12.2696 15.2542 10.1528 15.2542C10.1528 15.972 10.4675 18.0982 9.51139 18.4351C8.64251 18.7413 8.18956 17.9409 6.77353 16.5199L4.80823 14.5477C3.60275 13.338 3 12.7332 3 11.9945C3 11.2558 3.60275 10.6509 4.80823 9.44118Z"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <span>Jawab</span>
            </div>
          </div>
        </div>
        <div class="post-container">
          <div class="post-header">
            <img
              src="../assets/img/profile-forum/user-aditya.png"
              alt="Avatar Aditya Pratama"
            />
            <div class="post-desc">
              <h2>Abdullah</h2>
              <span class="date">15 Jan 2025</span>
            </div>
          </div>
          <div class="post-content">
            <p>
              Banyak kak, ada Beasiswa Indonesia Bangkit, Beasiswa Indonesia
              Maju, Beasiswa Pendidikan Indonesia, Beasiswa ITSB Sinar Mas,
              Beasiswa BCA, Beasiswa Djarum Plus, Beasiswa Bank Indonesia,
              Beasiswa LPDP, Beasiswa Mahaghora, Beasiswa Sea Scholarship, dan
              Beasiswa APERTI BUMN.
            </p>
          </div>
          <div class="post-footer">
            <svg
              class="like"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
            </svg>
            <svg
              class="link"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M9.14339 10.691L9.35031 10.4841C11.329 8.50532 14.5372 8.50532 16.5159 10.4841C18.4947 12.4628 18.4947 15.671 16.5159 17.6497L13.6497 20.5159C11.671 22.4947 8.46279 22.4947 6.48405 20.5159C4.50532 18.5372 4.50532 15.329 6.48405 13.3503L6.9484 12.886"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
              <path
                d="M17.0516 11.114L17.5159 10.6497C19.4947 8.67095 19.4947 5.46279 17.5159 3.48405C15.5372 1.50532 12.329 1.50532 10.3503 3.48405L7.48405 6.35031C5.50532 8.32904 5.50532 11.5372 7.48405 13.5159C9.46279 15.4947 12.671 15.4947 14.6497 13.5159L14.8566 13.309"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
            </svg>
            <div class="reply">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
                color="#333332"
                fill="none"
              >
                <path
                  d="M4.80823 9.44118L6.77353 7.46899C8.18956 6.04799 8.74462 5.28357 9.51139 5.55381C10.4675 5.89077 10.1528 8.01692 10.1528 8.73471C11.6393 8.73471 13.1848 8.60259 14.6502 8.87787C19.4874 9.78664 21 13.7153 21 18C19.6309 17.0302 18.2632 15.997 16.6177 15.5476C14.5636 14.9865 12.2696 15.2542 10.1528 15.2542C10.1528 15.972 10.4675 18.0982 9.51139 18.4351C8.64251 18.7413 8.18956 17.9409 6.77353 16.5199L4.80823 14.5477C3.60275 13.338 3 12.7332 3 11.9945C3 11.2558 3.60275 10.6509 4.80823 9.44118Z"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <span>Jawab</span>
            </div>
          </div>
        </div>
      </section>
      <section class="post-section" data-type="how-to">
        <div class="post-container">
          <div class="post-header">
            <img
              src="../assets/img/profile-forum/user-aditya.png"
              alt="Avatar Aditya Pratama"
            />
            <div class="post-desc">
              <h2>Admin Sapres</h2>
              <span class="date">13 Jan 2025</span>
            </div>
          </div>
          <div class="post-content">
            <p>Halo Sobat SAPRES!</p>

            <p>
              Selamat datang di Forum SAPRES, tempat untuk berbagi informasi dan
              berdiskusi seputar beasiswa, lomba, dan mencari tim. Di forum ini
              terdapat beberapa kategori, seperti Beasiswa, Lomba, dan Cari Tim.
            </p>

            <p>
              Di kategori Beasiswa, kamu dapat berbagi dan mencari informasi
              terkait peluang beasiswa terbaru. Pada kategori Lomba, kamu bisa
              menemukan informasi lomba dari berbagai bidang. Sementara itu, di
              kategori Cari Tim, kamu bisa mencari rekan satu tim untuk
              berkompetisi bersama.
            </p>

            <p>
              Namun, perlu dicatat bahwa jika kamu ingin mengajukan pertanyaan
              yang bersifat teknis atau detail, mohon sesuaikan dengan kategori
              masing-masing. Misalnya, apabila pertanyaan kamu mengenai syarat
              beasiswa tertentu, tuliskan di kategori Beasiswa.
            </p>

            <p>
              Sebelum menggunakan forum ini untuk memperdalam pengetahuan kamu,
              yuk simak cara menggunakannya:
            </p>

            <ul>
              <li>Gunakan Bahasa Indonesia yang baik dan sopan.</li>
              <li>Saling mendukung dan menyemangati satu sama lain.</li>
              <li>
                Sebelum bertanya, coba cari solusi sendiri terlebih dahulu. Ini
                akan melatih ketekunan kamu.
              </li>
              <li>Pastikan pertanyaan yang diajukan sudah jelas.</li>
              <li>
                Lampirkan screenshot yang jelas mengenai permasalahan jika
                diperlukan.
              </li>
              <li>
                Mohon bersabar jika pertanyaan kamu belum dijawab, karena waktu
                respon mungkin terbatas.
              </li>
              <li>
                Jika pertanyaan kamu terkait kode atau teknis lainnya, sertakan
                detail yang cukup agar lebih mudah dibantu.
              </li>
              <li>
                Pastikan kamu sudah mencari pertanyaan serupa sebelum bertanya.
              </li>
            </ul>

            <p>Contoh pertanyaan yang baik:</p>

            <p>
              "Halo semua, saya sedang mencari beasiswa yang cocok untuk
              mahasiswa semester 4 jurusan Teknik Informatika. Apakah ada
              rekomendasi? Saya sudah mencoba mencari di beberapa situs tetapi
              masih bingung dengan syaratnya."
            </p>

            <p>
              Moderator berhak untuk mencabut akses pengguna apabila pengguna:
            </p>

            <ul>
              <li>Menggunakan kata-kata kasar dan tidak sopan.</li>
              <li>Posting hal berbau SARA, politik, dan pornografi.</li>
              <li>
                Memperdagangkan hal-hal ilegal atau tidak berhubungan dengan
                forum.
              </li>
              <li>Menyebarkan hoax atau berita palsu.</li>
              <li>Melakukan bullying terhadap siapa pun.</li>
            </ul>

            <p>
              Moderator juga berhak untuk menghapus kategori, topik, maupun
              komentar yang tidak sesuai dengan ketentuan penggunaan forum ini.
            </p>

            <p>
              Bagaimana Sobat SAPRES? Sudah siap untuk menggunakan forum ini dan
              berkembang bersama?
            </p>
          </div>
          <div class="post-footer">
            <svg
              class="like"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
            </svg>
            <svg
              class="link"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
              color="#333332"
              fill="none"
            >
              <path
                d="M9.14339 10.691L9.35031 10.4841C11.329 8.50532 14.5372 8.50532 16.5159 10.4841C18.4947 12.4628 18.4947 15.671 16.5159 17.6497L13.6497 20.5159C11.671 22.4947 8.46279 22.4947 6.48405 20.5159C4.50532 18.5372 4.50532 15.329 6.48405 13.3503L6.9484 12.886"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
              <path
                d="M17.0516 11.114L17.5159 10.6497C19.4947 8.67095 19.4947 5.46279 17.5159 3.48405C15.5372 1.50532 12.329 1.50532 10.3503 3.48405L7.48405 6.35031C5.50532 8.32904 5.50532 11.5372 7.48405 13.5159C9.46279 15.4947 12.671 15.4947 14.6497 13.5159L14.8566 13.309"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
              />
            </svg>
            <div class="reply">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
                color="#333332"
                fill="none"
              >
                <path
                  d="M4.80823 9.44118L6.77353 7.46899C8.18956 6.04799 8.74462 5.28357 9.51139 5.55381C10.4675 5.89077 10.1528 8.01692 10.1528 8.73471C11.6393 8.73471 13.1848 8.60259 14.6502 8.87787C19.4874 9.78664 21 13.7153 21 18C19.6309 17.0302 18.2632 15.997 16.6177 15.5476C14.5636 14.9865 12.2696 15.2542 10.1528 15.2542C10.1528 15.972 10.4675 18.0982 9.51139 18.4351C8.64251 18.7413 8.18956 17.9409 6.77353 16.5199L4.80823 14.5477C3.60275 13.338 3 12.7332 3 11.9945C3 11.2558 3.60275 10.6509 4.80823 9.44118Z"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <span>Jawab</span>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- FOOTER START -->
    <?php include 'php/footer.php'; ?>
    <!-- FOOTER END -->

    <!-- Java Script -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/forum.js"></script>
  </body>
</html>
