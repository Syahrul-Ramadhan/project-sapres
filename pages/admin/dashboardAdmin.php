<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sapres - Admin Dashboard</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../../assets/css/admin/sidenav.css">
    <link rel="stylesheet" href="../../assets/css/admin/dashboardAdmin.css">
    
    <style>
        /* Memberi jarak bawah pada kontainer utama */
        .main-container {
            padding-bottom: 40px;
        }

        /* Menimpa properti dari dashboardAdmin.css agar elemen rata kiri */
        .dashboard-container {
            align-items: flex-start; /* Mengubah dari 'center' menjadi 'flex-start' (rata kiri) */
            padding-left: 30px; /* Menyesuaikan padding agar sejajar dengan judul */
            padding-right: 30px;
        }
        
        /* Menghapus margin kiri agar konsisten dengan padding parent */
        .dashboard-container .card-list {
            margin-left: 0;
        }

        .chart-container {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-top: 30px;
            
            /* Grafik akan mengisi lebar parent, tapi tidak akan melebihi 900px */
            width: 100%;
            max-width: 900px;
            
            height: 420px; /* Tinggi pasti untuk wadah grafik */
            position: relative;
        }

        .chart-container h3 {
            margin-bottom: 20px;
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <?php
        include "../php/koneksi.php";
        session_start();
        $user_id = $_SESSION['user_id'] ?? 0;
        if ($user_id > 0) {
            $stmt = $koneksi->prepare("SELECT fullname FROM users WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();
            $fullname = $user ? $user['fullname'] : 'User Not Found';
        } else {
            $fullname = 'Guest';
        }
        
        // Kueri untuk Statistik
        $stmt_beasiswa = $koneksi->prepare("SELECT COUNT(*) AS total_beasiswa FROM beasiswa");
        $stmt_beasiswa->execute();
        $jumlah_beasiswa = $stmt_beasiswa->fetch()['total_beasiswa'];

        $stmt_lomba = $koneksi->prepare("SELECT COUNT(*) AS total_lomba FROM lomba");
        $stmt_lomba->execute();
        $jumlah_lomba = $stmt_lomba->fetch()['total_lomba'];

        $stmt_tim = $koneksi->prepare("SELECT COUNT(*) AS total_tim FROM tim");
        $stmt_tim->execute();
        $jumlah_tim = $stmt_tim->fetch()['total_tim'];

        $stmt_forum = $koneksi->prepare("SELECT COUNT(*) AS total_forum FROM forum WHERE parent_id IS NULL");
        $stmt_forum->execute();
        $jumlah_forum = $stmt_forum->fetch()['total_forum'];
    ?>

    <div class="side-nav">
        <div class="container">
            <div class="nav-header">
                <div class="title"><h2>Sapres</h2></div>
                <div class="nav-list">
                    <ul>
                        <li><img src="../../assets/img/icons/dashboard-admin/pie-chart.png" alt="chart-icon"><a href="dashboardAdmin.php" style="font-weight: 600; color: var(--Primary-color);">Dashboard</a></li>
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
    <div class="main-container">
        <h2 class="tittle">Dashboard</h2>

        <div class="dashboard-container">
            <div class="card-list">
                <div class="card">
                    <div class="card-title"><img src="../../assets/img/icons/dashboard-admin/dollar-currency-symbol (1).png" alt="dollar-icon"></div>
                    <div class="card-info">
                        <h3>Jumlah Beasiswa</h3>
                        <p><?php echo $jumlah_beasiswa; ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title"><img src="../../assets/img/icons/dashboard-admin/trophy (1).png" alt="lomba-icon"></div>
                    <div class="card-info">
                        <h3>Jumlah Lomba</h3>
                        <p><?php echo $jumlah_lomba; ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title"><img src="../../assets/img/icons/dashboard-admin/group-users (1).png" alt="team-icon"></div>
                    <div class="card-info">
                        <h3>Jumlah Tim</h3>
                        <p><?php echo $jumlah_tim; ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title"><img src="../../assets/img/icons/dashboard-admin/chat (1).png" alt="forum-icon"></div>
                    <div class="card-info">
                        <h3>Topik Forum</h3>
                        <p><?php echo $jumlah_forum; ?></p>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <h3>Visualisasi Total Data</h3>
                <canvas id="sapresChart"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('sapresChart').getContext('2d');

            const totalBeasiswa = <?php echo $jumlah_beasiswa; ?>;
            const totalLomba = <?php echo $jumlah_lomba; ?>;
            const totalForum = <?php echo $jumlah_forum; ?>;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Beasiswa', 'Lomba', 'Topik Forum'],
                    datasets: [{
                        label: 'Total Data',
                        data: [totalBeasiswa, totalLomba, totalForum],
                        backgroundColor: [
                            'rgba(32, 87, 129, 0.8)',
                            'rgba(79, 149, 157, 0.8)',
                            'rgba(255, 193, 7, 0.8)'
                        ],
                        borderColor: [
                            '#205781',
                            '#4f959d',
                            '#ffc107'
                        ],
                        borderWidth: 1.5,
                        borderRadius: 5,
                        hoverBackgroundColor: ['#205781','#4f959d','#ffc107']
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { color: '#eee' },
                            ticks: { precision: 0 }
                        },
                        y: {
                             grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            enabled: true,
                            backgroundColor: '#333',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 10,
                            cornerRadius: 6,
                            displayColors: false
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        });
    </script>
</body>
</html>