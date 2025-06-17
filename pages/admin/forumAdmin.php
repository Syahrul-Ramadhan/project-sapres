<?php
include "../php/koneksi.php";
session_start();

$sql = "SELECT 
            f.forum_id,
            f.pesan,
            f.kategori,
            f.waktu_postingan,
            u.fullname,
            (SELECT COUNT(*) FROM forum WHERE parent_id = f.forum_id) AS jumlah_balasan
        FROM forum AS f
        JOIN users AS u ON f.user_id = u.user_id
        WHERE f.parent_id IS NULL
        ORDER BY f.waktu_postingan DESC";

$stmt = $koneksi->prepare($sql);
$stmt->execute();

$forumData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Forum - Sapres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="../../assets/css/admin/sidenav.css">
    <link rel="stylesheet" href="../../assets/css/admin/beasiswaAdmin.css"> 
    <style>
        .discussion-detail-content { max-height: 400px; overflow-y: auto; margin-bottom: 20px; border: 1px solid #eee; padding: 15px; border-radius: 8px; }
        .main-post, .reply-post { margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #f0f0f0; }
        .post-header { font-weight: bold; }
        .post-meta { font-size: 12px; color: #888; }
        .post-body { margin-top: 5px; }
        .reply-form textarea { width: 100%; height: 80px; }
        .delete-message-btn { color: red; cursor: pointer; font-size: 14px; margin-left: 10px; }

        #pengumuman-pop-up .pop-up-content {
            width: auto;
            height: auto;
            max-width: 600px;
        }

        #searchForum {
            width: 400px;
            padding: 8px 12px;
            border: 1px solid #cdcbc8;
            border-radius: 12px;
            font-size: 16px;
        }

        #searchForum:focus {
            outline: none;
            border-color: #777776;
        }
    </style>
</head>
<body>

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
    <div class="main-container">
        <h2 class="tittle">Manajemen Forum</h2>

        <div class="beasiswa-container">
            <div class="beasiswa-content-header">
                <input type="text" placeholder="Cari ID, isi pesan, kategori, atau pengirim..." id="searchForum" oninput="searchForum()">
                <button class="btn-crud btn-add" id="buatPengumumanBtn">Berikan Pengumuman</button>
            </div>
            <div class="beasiswa-content">
                <table class="beasiswa-table">
                    <thead>
                        <tr>
                            <th>ID Topik</th>
                            <th>Isi Pesan (Topik Utama)</th>
                            <th>Kategori</th>
                            <th>Pengirim</th>
                            <th>Jumlah Balasan</th>
                            <th>Waktu Post</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($forumData) > 0): ?>
                            <?php foreach ($forumData as $data): ?>
                                <tr class='table-content' data-id='<?php echo $data['forum_id']; ?>' style="cursor: pointer;">
                                    <td><?php echo $data['forum_id']; ?></td>
                                    <td><?php echo htmlspecialchars(substr($data['pesan'], 0, 50)) . '...'; ?></td>
                                    <td><?php echo htmlspecialchars($data['kategori']); ?></td>
                                    <td><?php echo htmlspecialchars($data['fullname']); ?></td>
                                    <td><?php echo $data['jumlah_balasan']; ?></td>
                                    <td><?php echo date('d M Y H:i', strtotime($data['waktu_postingan'])); ?></td>
                                    <td>
                                        <a href="#" class='deletebtn delete-discussion-btn' data-id='<?php echo $data['forum_id']; ?>'>Hapus Diskusi</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" style="text-align: center;">Belum ada diskusi.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="pengumuman-pop-up" class="beasiswa-pop-up" style="display: none;">
        <div class="pop-up-content">
            <span class="close" id="pengumuman-closeBtn">&times;</span>
            <h2>Berikan Pengumuman</h2>
            <form id="pengumumanForm">
                <table class="table-add">
                    <tr>
                        <td>Pilih Kategori</td>
                        <td>:</td>
                        <td>
                            <select name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="beasiswa">Beasiswa</option>
                                <option value="lomba">Lomba</option>
                                <option value="cari tim">Cari Tim</option>
                                <option value="umum">Umum</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Isi Pengumuman</td>
                        <td>:</td>
                        <td><textarea name="pesan" required placeholder="Tulis pengumuman Anda di sini..."></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;"><button type="submit">Kirim</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <div id="detail-diskusi-pop-up" class="beasiswa-pop-up" style="display: none;">
        <div class="pop-up-content">
            <span class="close" id="detail-closeBtn">&times;</span>
            <h2>Rincian Diskusi</h2>
            <div id="discussion-detail-content" class="discussion-detail-content"></div>
            
            <form id="adminReplyForm" class="reply-form">
                <h4>Balas Diskusi</h4>
                <input type="hidden" name="parent_id">
                <textarea name="pesan" placeholder="Tulis balasan Anda sebagai admin..."></textarea>
                <button type="submit">Kirim Balasan</button>
            </form>
        </div>
    </div>

    <script src="../../assets/js/forumAdmin.js"></script>
</body>
</html>