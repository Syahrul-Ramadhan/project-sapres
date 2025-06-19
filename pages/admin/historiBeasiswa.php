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
    <link rel="stylesheet" href="../../assets/css/admin/beasiswaAdmin.css">
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

        $stmtLog = $koneksi->prepare("SELECT * FROM log_beasiswa ORDER BY tanggal_penghapusan DESC");
        $stmtLog->execute();
        $logBeasiswa = $stmtLog->fetchAll(PDO::FETCH_ASSOC);
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
                    <li><img src="../../assets/img/icons/dashboard-admin/dollar-currency-symbol.png" alt="beasiswa-icon"><a href="beasiswaAdmin.php" style="font-weight: 600; color: var(--Primary-color);">Beasiswa</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/trophy.png" alt="lomba-icon"><a href="lombaAdmin.php">Lomba</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/group-users.png" alt="team-icon"><a href="timAdmin.php">Tim</a></li>
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
        <h2 class="tittle">Histori Beasiswa</h2>

        <div class="beasiswa-container">
            <div class="beasiswa-content-header">
                <input type="text" placeholder="Cari beasiswa..." id="searchBeasiswa" oninput="searchBeasiswa()">
                <div class="crud-btn">
                    <a class="btn-crud" href="beasiswaAdmin.php">Kembali</a>
                </div>
            </div>
            <div class="beasiswa-content">
                <table class="beasiswa-table">
                    <thead>
                        <tr>
                            <th>Id Beasiswa</th>
                            <th>Nama Beasiswa</th>
                            <th>Jenjang</th>
                            <th>Tanggal Dibuka</th>
                            <th>Tanggal Ditutup</th>
                            <th>Pemberi Beasiswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data beasiswa akan dimasukkan di sini -->
                        <?php
                                foreach ($logBeasiswa as $data):
                                    echo "<tr class='table-content' data-id='{$data['beasiswa_id']}' 
                                            data-judul='{$data['judul_beasiswa']}' 
                                            data-jenjang='{$data['jenjang_beasiswa']}' 
                                            data-mulai='{$data['mulai_beasiswa']}' 
                                            data-penutupan='{$data['penutupan_beasiswa']}' 
                                            data-pemberi='{$data['pemberi_beasiswa']}' 
                                            data-asal='{$data['asal_instansi']}' 
                                            data-tipe='{$data['tipe_pendanaan']}' 
                                            data-benefit='{$data['benefit_beasiswa']}' 
                                            data-syarat='{$data['syarat_beasiswa']}' 
                                            data-booklet='{$data['booklet_beasiswa']}' 
                                            data-lokasi='{$data['lokasi_beasiswa']}' 
                                            data-link='{$data['daftar_beasiswa']}'>
                                            <td class='first-col'>{$data['beasiswa_id']}</td>
                                            <td>{$data['judul_beasiswa']}</td>
                                            <td>{$data['jenjang_beasiswa']}</td>
                                            <td>" . date('d M Y', strtotime($data['mulai_beasiswa'])) . "</td>
                                            <td>" . date('d M Y', strtotime($data['penutupan_beasiswa'])) . "</td>
                                            <td>{$data['pemberi_beasiswa']}</td>
                                          </tr>";
                                endforeach;
                        ?>
                    </tbody>
                </table>

                <!-- detail Pop-up -->
                <div class="beasiswa-pop-up detail-pop-up" style="display: none;">
                    <div class="pop-up-content">
                        <span id="detail-closeBtn" class="close"><img src="../../assets/img/icons/dashboard-admin/close.png" alt="close" width="24px"></span>
                        <h2>Data Beasiswa</h2>
                                <table class="table-detail">
                                    <tr>
                                    <td>Nama Beasiswa</td>
                                    <td>:</td>
                                    <td>
                                        <div class="value-detail detail-judul"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenjang</td>
                                    <td>:</td>
                                    <td>
                                        <div class="value-detail detail-jenjang"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Dibuka</td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-pendaftaran"></div></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Ditutup</td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-penutupan"></div></td>
                                </tr>
                                <tr>
                                    <td>Pemberi Beasiswa</td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-pemberi"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="asal_instansi">Asal Instansi</label></td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-asal-instansi"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="tipe_pendanaan">Tipe Pendanaan</label></td>
                                    <td>:</td>
                                    <td>
                                        <div class="value-detail detail-tipe"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="benefit_beasiswa">Benefit Beasiswa</label></td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-benefit"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="syarat_beasiswa">Syarat Beasiswa</label></td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-syarat"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="booklet_beasiswa">Booklet Beasiswa</label></td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-booklet"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="lokasi_beasiswa">Lokasi Beasiswa</label></td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-lokasi"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="link_pendaftaran">Link Pendaftaran</label></td>
                                    <td>:</td>
                                    <td><div class="value-detail detail-link"></div></td>
                                </tr>
                                </table>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/beasiswaAdmin.js"></script>
</body>
</html>