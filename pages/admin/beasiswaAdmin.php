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

        // Pagination setup
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        // Menggunakan PDO untuk query
        $sql = "SELECT * FROM beasiswa LIMIT :limit OFFSET :offset";
        $stmt = $koneksi->prepare($sql);
        
        // Mengikat parameter untuk pagination
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        // Menjalankan query
        $stmt->execute();
        
        // Mengambil hasil
        $hasil_query = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query untuk hitung total data
        $totalStmt = $koneksi->prepare("SELECT COUNT(*) as total FROM beasiswa");
        $totalStmt->execute();
        $totalData = $totalStmt->fetch()['total'];
        $totalPages = ceil($totalData / $limit); // Menghitung total halaman
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
                    <li><img src="../../assets/img/icons/dashboard-admin/group-users.png" alt="team-icon"><a href="timAdmin.php">Tim</a></li>
                    <li><img src="../../assets/img/icons/dashboard-admin/chat.png" alt="forum-icon"><a href="forumAdmin.php">Forum</a></li>
                </ul>
            </div>
        </div>
        <div class="nav-footer">
            <div class="profile">
                <img src="../../assets/img/user_profile/default_profile.png" alt="Profile Picture">
                <div class="profile-info">
                    <h4>Icibos</h4>
                    <p>Admin</p>
                </div>
            </div>
            <a href="" class="log-out">
                <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>
                Log out
            </a>
        </div>
        </div>
    </div>
    <!-- SIDE NAV END -->

    <div class="main-container">
        <h2 class="tittle">Manajemen Beasiswa</h2>

        <div class="beasiswa-container">
            <div class="beasiswa-content-header">
                <input type="text" placeholder="Cari beasiswa..." id="searchBeasiswa" oninput="searchBeasiswa()">
                <div class="crud-btn">
                    <button class="btn-crud btn-add" >Tambah</button>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data beasiswa akan dimasukkan di sini -->
                        <?php
                            if ($hasil_query) {
                                foreach ($hasil_query as $data):
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
                                            <td class = 'last-col'><a  class='editbtn'>Edit</a> | <a href=proses/deleteBeasiswa.php?id=".$data['beasiswa_id']." class='deletebtn'>Delete</a></td>
                                          </tr>";
                                endforeach;
                        ?>
                    </tbody>
                </table>

                <!-- add Pop-up -->
                <div class="beasiswa-pop-up add-pop-up" style="display: none;">
                    <div class="pop-up-content">
                        <span id="add-closeBtn" class="close"><img src="../../assets/img/icons/dashboard-admin/close.png" alt="close" width="24px"></span>
                        <h2>Tambah Data Beasiswa</h2>
                            <form id="add-beasiswaForm" method="POST" action="proses/prosesInsertBeasiswa.php">
                                <table class="table-add">
                                <div class="form-part-1">
                                    <tr>
                                    <td>Nama Beasiswa</td>
                                    <td>:</td>
                                    <td><input type="text" name="judul_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td>Jenjang</td>
                                    <td>:</td>
                                    <td>
                                        <!-- //menggunakan checkbox untuk memilih lebih dari satu jenjang -->
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="SMP"> SMP
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="SMA"> SMA
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="S1"> S1
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="S2"> S2
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="S3"> S3 
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="D3"> D3 <br>
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="D4"> D4
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="Non-degree"> Non-Degree
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="Gap-year"> Gap Year <br>
                                        <input type="checkbox" name="jenjang_beasiswa[]" value="Profesi"> Profesi
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Dibuka</td>
                                    <td>:</td>
                                    <td><input type="date" name="mulai_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Ditutup</td>
                                    <td>:</td>
                                    <td><input type="date" name="penutupan_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td>Pemberi Beasiswa</td>
                                    <td>:</td>
                                    <td><input type="text" name="pemberi_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td><label for="asal_instansi">Asal Instansi</label></td>
                                    <td>:</td>
                                    <td><input type="text" id="asal_instansi" name="asal_instansi" required></td>
                                </tr>
                                <tr>
                                    <td><label for="tipe_pendanaan">Tipe Pendanaan</label></td>
                                    <td>:</td>
                                    <td><select name="tipe_pendanaan" required>
                                        <option value="">-- Pilih Tipe Pendanaan --</option>
                                        <option value="Fully Funded">Fully Funded</option>
                                        <option value="Partially Funded">Partially Funded</option>
                                    </td>
                                </tr>
                                </div>
                                </table>
                                <table class="table-add">
                                <div class="form-part-2">
                                    <tr class="note">
                                    <td colspan="3">
                                        *Pada benefit dan syarat beasiswa, gunakan "|" sebagai pemisah antar poin.
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="benefit_beasiswa">Benefit Beasiswa</label></td>
                                    <td>:</td>
                                    <td><textarea id="benefit_beasiswa" name="benefit_beasiswa" required></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="syarat_beasiswa">Syarat Beasiswa</label></td>
                                    <td>:</td>
                                    <td><textarea id="syarat_beasiswa" name="syarat_beasiswa" required></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="booklet_beasiswa">Booklet Beasiswa</label></td>
                                    <td>:</td>
                                    <td><input type="url" id="booklet_beasiswa" name="booklet_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td><label for="lokasi_beasiswa">Lokasi Beasiswa</label></td>
                                    <td>:</td>
                                    <td><input type="text" id="lokasi_beasiswa" name="lokasi_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td><label for="link_pendaftaran">Link Pendaftaran</label></td>
                                    <td>:</td>
                                    <td><input type="url" id="link_pendaftaran" name="link_pendaftaran" required></td>
                                </tr>
                                </div>
                                
                                <tr>
                                    <td colspan="3" style="text-align:start;">
                                        <button type="submit">Submit</button>
                                    </td>
                                </tr>
                                </table>
                            </form>
                    </div>
                </div>

                <!-- edit Pop-up -->
                <div class="beasiswa-pop-up edit-pop-up" style="display: none;">
                    <div class="pop-up-content">
                        <span id="edit-closeBtn" class="close"><img src="../../assets/img/icons/dashboard-admin/close.png" alt="close" width="24px"></span>
                        <h2>Edit Data Beasiswa</h2>
                            <form id="edit-beasiswaForm" method="POST" action="proses/prosesUpdateBeasiswa.php">
                                <input type="hidden" name="edit-beasiswa_id">
                                <table class="table-add">
                                <div class="form-part-1">
                                    <tr>
                                    <td>Nama Beasiswa</td>
                                    <td>:</td>
                                    <td><input type="text" name="edit-judul_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td>Jenjang</td>
                                    <td>:</td>
                                    <td>
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="SMP" id="edit-jenjang-SMP"> SMP
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="SMA" id="edit-jenjang-SMA"> SMA
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="S1" id="edit-jenjang-S1"> S1
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="S2" id="edit-jenjang-S2"> S2
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="S3" id="edit-jenjang-S3"> S3
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="D3" id="edit-jenjang-D3"> D3 <br>
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="D4" id="edit-jenjang-D4"> D4
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="Non-degree" id="edit-jenjang-Non-degree"> Non-Degree
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="Gap-year" id="edit-jenjang-Gap-year"> Gap Year <br>
                                        <input type="checkbox" name="edit-jenjang_beasiswa[]" value="Profesi" id="edit-jenjang-Profesi"> Profesi
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Dibuka</td>
                                    <td>:</td>
                                    <td><input type="date" name="edit-mulai_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Ditutup</td>
                                    <td>:</td>
                                    <td><input type="date" name="edit-penutupan_beasiswa" required ></td>
                                </tr>
                                <tr>
                                    <td>Pemberi Beasiswa</td>
                                    <td>:</td>
                                    <td><input type="text" name="edit-pemberi_beasiswa" required ></td>
                                </tr>
                                <tr>
                                    <td><label for="asal_instansi">Asal Instansi</label></td>
                                    <td>:</td>
                                    <td><input type="text" id="asal_instansi" name="edit-asal_instansi" required></td>
                                </tr>
                                <tr>
                                    <td><label for="tipe_pendanaan">Tipe Pendanaan</label></td>
                                    <td>:</td>
                                    <td><select name="edit-tipe_pendanaan" required id="tipe_pendanaan">
                                        <option value="">-- Pilih Tipe Pendanaan --</option>
                                        <option value="Fully Funded">Fully Funded</option>
                                        <option value="Partially Funded">Partially Funded</option>
                                    </td>
                                </tr>
                                </div>
                                </table>
                                <table class="table-add">
                                <div class="form-part-2">
                                    <tr class="note">
                                    <td colspan="3">
                                        *Pada benefit dan syarat beasiswa, gunakan "|" sebagai pemisah antar poin.
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="benefit_beasiswa">Benefit Beasiswa</label></td>
                                    <td>:</td>
                                    <td><textarea id="benefit_beasiswa" name="edit-benefit_beasiswa" required></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="syarat_beasiswa">Syarat Beasiswa</label></td>
                                    <td>:</td>
                                    <td><textarea id="syarat_beasiswa" name="edit-syarat_beasiswa" required></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="booklet_beasiswa">Booklet Beasiswa</label></td>
                                    <td>:</td>
                                    <td><input type="url" id="booklet_beasiswa" name="edit-booklet_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td><label for="lokasi_beasiswa">Lokasi Beasiswa</label></td>
                                    <td>:</td>
                                    <td><input type="text" id="lokasi_beasiswa" name="edit-lokasi_beasiswa" required></td>
                                </tr>
                                <tr>
                                    <td><label for="link_pendaftaran">Link Pendaftaran</label></td>
                                    <td>:</td>
                                    <td><input type="url" id="link_pendaftaran" name="edit-link_pendaftaran" required></td>
                                </tr>
                                </div>
                                
                                <tr>
                                    <td colspan="3" style="text-align:start;">
                                        <button type="submit">Submit</button>
                                    </td>
                                </tr>
                                </table>
                            </form>
                    </div>
                </div>

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

        <?php 
    } else {
        echo "Data tidak ditemukan.";
      }
      ?>
    <script src="../../assets/js/beasiswaAdmin.js"></script>
</body>
</html>