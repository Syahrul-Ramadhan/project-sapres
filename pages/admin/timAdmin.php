<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapres</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/admin/sidenav.css">
    <link rel="stylesheet" href="../../assets/css/admin/timAdmin.css">
</head>
<body>

    <?php
      include "../php/koneksi.php";

      session_start();

    // Ambil user_id dari sesi
    $user_id = $_SESSION['user_id'] ?? 0; // Pastikan session sudah di-set sebelumnya

    // Cek apakah user_id ada
    if ($user_id > 0) {
        // Ambil data pengguna dari database (misalnya 'users' tabel)
        // Ganti dengan query yang sesuai dengan struktur database Anda
        $stmt = $koneksi->prepare("SELECT fullname FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        $fullname = $user ? $user['fullname'] : 'User Not Found'; // Jika data ditemukan
    } else {
        $fullname = 'Guest';  // Jika user_id tidak ada (belum login)
    }

    // Menggunakan prepared statement untuk mengambil data
    $sql = "SELECT * FROM tim";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute();
    $hasil_query = $stmt->fetchAll(PDO::FETCH_ASSOC); // Menggunakan fetchAll untuk mengambil semua data

    if ($hasil_query && count($hasil_query) > 0) {
    ?>

<!-- SIDE NAV START -->
        <div class="side-nav">
        <div class="container">
            <div class="nav-header">
            <div class="title">
                <h2>Sapres</h2>
            </div>
            <div class="nav-list">
                <ul>
                    <li><img src="../../assets/img/icons/dashboard-admin/pie-chart.png" alt="chart-icon"><a href="dashboardAdmin.php">Dashboard</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/dollar-currency-symbol.png" alt="beasiswa-icon"><a href="beasiswaAdmin.php">Beasiswa</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/trophy.png" alt="lomba-icon"><a href="lombaAdmin.php">Lomba</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/group-users.png" alt="team-icon"><a href="timAdmin.php" style="font-weight: 600; color: var(--Primary-color);">Tim</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/chat.png" alt="forum-icon"><a href="forumAdmin.php">Forum</a></li>
                </ul>
            </div>
        </div>
        <div class="nav-footer">
            <div class="profile">
                <img src="../../assets/img/user_profile/default_profile.png" alt="Profile Picture">
                <div class="profile-info">
                    <h4><?php echo htmlspecialchars($fullname); ?></h4>
                    <p>Admin</p>
                </div>
            </div>
            <a href="../php/auth_handler.php?action=logout"  class="log-out">
                <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>
                Log out
            </a>
        </div>
        </div>
    </div>
    <!-- SIDE NAV END -->

    <div class="main-container">
        <h2 class="tittle">Manajemen Tim</h2>

        <div class="tim-container">
            <div class="tim-content-header">
                <input type="text" placeholder="Cari Tim..." id="searchTim" oninput="searchTim()">
            </div>

            <div class="tim-content">
                <table class="tim-table">
                    <thead>
                        <tr>
                            <th>Id Tim</th>
                            <th>Nama Tim</th>
                            <th>Jumlah Anggota</th>
                            <th>Jenjang Tim</th>
                            <th>Kategori</th>
                            <th>Judul Lomba</th>
                            <th>Asal Instansi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data beasiswa akan dimasukkan di sini -->
                        <?php
                            foreach ($hasil_query as $data): 
                                    echo "<tr class='table-content' data-id='{$data['tim_id']}' 
                                            data-nama='{$data['nama_tim']}' 
                                            data-anggota='{$data['jumlah_anggota']}' 
                                            data-jenjang='{$data['jenjang_tim']}' 
                                            data-kategori='{$data['kategori_lomba']}' 
                                            data-judul='{$data['judul_lomba']}' 
                                            data-asal='{$data['asal_instansi']}' 
                                            data-deskripsi='{$data['deskripsi']}' 
                                            data-syarat='{$data['syarat_ketentuan']}' 
                                            data-ktm='{$data['cek_ktm']}' 
                                            data-link='{$data['link']}' 
                                            data-tanggal='{$data['created_at']}'> 
                                            <td class='first-col'>{$data['tim_id']}</td>
                                            <td>{$data['nama_tim']}</td>
                                            <td>{$data['jumlah_anggota']}</td>
                                            <td>{$data['jenjang_tim']}</td>
                                            <td>{$data['kategori_lomba']}</td>
                                            <td>{$data['judul_lomba']}</td>
                                            <td>{$data['asal_instansi']}</td>
                                            <td class = 'last-col'><a href=proses/deleteTim.php?id=".$data['tim_id']." class='deletebtn'>Delete</a></td>
                                          </tr>";
                            endforeach;
                        ?>
                    </tbody>
                </table>

                <!-- detail Pop-up -->
                <div class="tim-pop-up detail-pop-up" style="display: none;">
                    <div class="pop-up-content">
                        <span id="detail-closeBtn" class="close"><img src="../../assets/img/icons/dashboard-admin/close.png" alt="close" width="24px"></span>
                        <h2>Data Tim</h2>
                                <table class="table-detail">
                                    <tr>
                                    <td>Nama Tim</td>
                                    <td>:</td>
                                    <td>
                                        <div class="detail-nama"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jumlah Anggota</td>
                                    <td>:</td>
                                    <td>
                                        <div class="detail-jumlah"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenjang Tim</td>
                                    <td>:</td>
                                    <td><div class="detail-jenjang"></div></td>
                                </tr>
                                <tr>
                                    <td>Kategori Lomba</td>
                                    <td>:</td>
                                    <td><div class="detail-kategori"></div></td>
                                </tr>
                                <tr>
                                    <td>Judul Lomba</td>
                                    <td>:</td>
                                    <td><div class="detail-judul"></div></td>
                                </tr>
                                <tr>
                                    <td>Asal Instansi</td>
                                    <td>:</td>
                                    <td><div class="detail-asal-instansi"></div></td>
                                </tr>
                                <tr>
                                    <td>Daskripsi Tim</td>
                                    <td>:</td>
                                    <td>
                                        <div class="detail-deskripsi"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Syarat Ketentuan</td>
                                    <td>:</td>
                                    <td><div class="detail-syarat"></div></td>
                                </tr>
                                <tr>
                                    <td>KTM</td>
                                    <td>:</td>
                                    <td><div class="detail-ktm"></div></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td><div class="detail-tanggal"></div></td>
                                </tr>
                                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <?php 
    } else {
        echo "Data tidak ditemukan.";
      }
      ?>
    <script src="../../assets/js/admin/timAdmin.js"></script>

</body>
</html>